<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class OrderController extends Controller
{
    //电脑支付
    public function merpay()
    {
        //require_once dirname(dirname(__FILE__)).'/config.php';
        $config=config('pay');
        //dd(app_path('libs\alipay\pagepay\service\AlipayTradeService.php'));
        require_once app_path('libs\alipay\pagepay\service\AlipayTradeService.php');
        require_once app_path('libs\alipay\pagepay\buildermodel\AlipayTradePagePayContentBuilder.php');

        //商户订单号，商户网站订单系统中唯一订单号，必填
        $out_trade_no = 111111;

        //订单名称，必填
        $subject = 1;

        //付款金额，必填
        $total_amount = 100;

        //商品描述，可空
        $body = 111;

        //构造参数
        $payRequestBuilder = new \AlipayTradePagePayContentBuilder();
        $payRequestBuilder->setBody($body);
        $payRequestBuilder->setSubject($subject);
        $payRequestBuilder->setTotalAmount($total_amount);
        $payRequestBuilder->setOutTradeNo($out_trade_no);

        $aop = new \AlipayTradeService($config);

        /**
         * pagePay 电脑网站支付请求
         * @param $builder 业务参数，使用buildmodel中的对象生成。
         * @param $return_url 同步跳转地址，公网可以访问
         * @param $notify_url 异步通知地址，公网可以访问
         * @return $response 支付宝返回的信息
         */
        $response = $aop->pagePay($payRequestBuilder,$config['return_url'],$config['notify_url']);

        //输出表单
        var_dump($response);
    }

    public function returnpay()
    {
        echo 'ok';
    }


    //手机支付
    public function pay()
    {

    }

    //提交订单
    public function confirmOrder(){
        $goods_id = request()->goods_id;
        $goods_id = explode(',',$goods_id);
        $address_id = request()->address_id;
        $pay_type = request()->pay_type;
        $u_id = session('u_id');
        //开启事务
        DB::beginTransaction();
        try{
            if(empty($goods_id)){
                throw new \Exception('商品id不能为空');
            }
            if(empty($address_id)){
                throw new \Exception('收货地址不能为空');
            }
            if(empty($pay_type)){
                throw new \Exception('支付方式不能为空');
            }
            //获取订单号
            $order_no = time().rand(100,999).$u_id;
            // dd($order);
            //获取总价
            $where = [
                ['u_id','=',$u_id],
                ['is_del','=',1]
            ];
            // dd($where);
            $cartInfo = DB::table('cart')
                        ->join('goods','cart.goods_id','=','goods.goods_id')
                        ->where($where)
                        ->whereIn('goods.goods_id',$goods_id)
                        ->select('cart.goods_id','shop_price','goods_img','buy_number','goods_name','goods_number','create_time')
                        ->get();
            // dd($cartInfo);
            //总价
            $count = 0;
            foreach($cartInfo as $k=>$v){
                $count += $v->buy_number*$v->shop_price;
            }
            //给订单表添加数据
            $order['order_no'] = $order_no;
            $order['order_acount']= $count;
            $order['u_id']=$u_id;
            $order['pay_type']=$pay_type;
            $order['create_time']=time();
            $order_id = DB::table('order')->insertGetId($order);
            if(!$order_id){
                throw new \Exception('订单地址写入失败');
            }

            //给订单地址表添加数据
            $addressWhere = [
                ['u_id','=',$u_id],
                ['is_del','=',1],
                ['address_id','=',$address_id]
            ];
            $addressInfo = DB::table('address')->where($addressWhere)->first();
            $addressInfo->order_id = $order_id;
            // dd($addressInfo);
            $addressInfo=get_object_vars($addressInfo);
            // dd($addressInfo);
            unset($addressInfo['address_id']);
            unset($addressInfo['is_default']);
            $res2 = DB::table('order_address')->insert($addressInfo);
            // dd($res2);
            if(!$res2){
                throw new \Exception('订单地址写入失败');
            }
            
            //订单商品详情表添加数据
            $goodWhere = [
                ['u_id','=',$u_id],
                ['is_del','=',1],
            ];
            $goodsInfo = DB::table('goods')
                        ->join('cart','goods.goods_id','=','cart.goods_id')
                        ->where($goodWhere)
                        ->whereIn('goods.goods_id',$goods_id)
                        ->select('goods.goods_id','goods_img','buy_number','goods_name')
                        ->get();
            // dd($goodsInfo);
            // $goodsInfo = get_object_vars($goodsInfo);
            // dd($goodsInfo);
            $goodsInfo = json_decode(json_encode($goodsInfo),true);
            // dd($goodsInfo);
            foreach($goodsInfo as $k=>$v){
                $goodsInfo[$k]['order_id']=$order_id;
                $goodsInfo[$k]['u_id']=$u_id;
            }
            // dd($goodsInfo);
            $res3 = DB::table('order_detail')->insert($goodsInfo);
            // dd($res3);
            if(!$res3){
                throw new \Exception('订单详情写入失败');
            }

            $goodsInfo = DB::table('goods')
                        ->join('cart','goods.goods_id','=','cart.goods_id')
                        ->where($goodWhere)
                        ->whereIn('goods.goods_id',$goods_id)
                        ->select('goods.goods_id','buy_number','goods_number')
                        ->get();
            $goodsInfo = json_decode(json_encode($goodsInfo),true);
            // dd($goodsInfo);
            //修改库存
            // foreach($goodsInfo as $k=>$v){
            //     $goods_number = $v['goods_number']-$v['buy_number'];
            //     $res4 = DB::table('goods')->where('goods_id',$v['goods_id'])->update(['goods_number'=>$goods_number]);
            //     if($res4){
            //         throw new \Exception('修改库存失败');
            //     }
            // }
            // dd($goods_id);
            foreach($goodsInfo as $k=>$v){
                foreach($goods_id as $key=>$val){
                    if($v['goods_id']==$val){
                        $v['goods_number'] = $v['goods_number']-$v['buy_number'];
                        $res4 = DB::table('goods')->where('goods_id',$val)->update(['goods_number'=>$v['goods_number']]);
                    }
                }
            }
            if(!$res4){
                throw new \Exception('修改库存成功');
            }

            //清除购物车数据
            $cartWhere = [
                ['u_id','=',$u_id]
            ];
            $res5 = DB::table('cart')->where($cartWhere)->whereIn('goods_id',$goods_id)->update(['is_del'=>2]);
            // $res5 = false;
            if(!$res5){
                throw new \Exception('清除购物车数据失败');
            }
            //提交
            DB::commit();
            return [
                'code'=>1,
                'msg'=>'下单成功',
                'order_id'=>$order_id
            ];

        }catch(EXception $e){
            DB::rollBack();
            return [
                'code'=>2,
                'msg'=>'下单失败'
            ];
            report($e);
            return false;
        }
    }

    //订单成功页面
    public function success($id){
        // echo $id;
        $orderInfo = DB::table('order')->where('order_id',$id)->first();
        // dd($orderInfo);
        return view('/order/success',['orderInfo'=>$orderInfo]);
    }
}
