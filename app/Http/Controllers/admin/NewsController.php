<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\News;
use Illuminate\Support\Facades\Redis;
use DB;

class NewsController extends Controller
{
    public function index()
    {
        $query=request()->all();
        $where=[];
        if($query['new_name']??''){
            $where[]=['new_name','like',"%$query[new_name]%"];
        }
        $pageSize=config('app.pageSize');
        $data =  DB::table('news')
            ->join('cates','news.c_id','=','cates.c_id')
            ->where($where)
            ->orderBy('new_id', 'desc')
            ->paginate($pageSize);
        return view('admin.new.index',['data'=>$data,'query'=>$query]);
    }

    public function add()
    {
        $data=Db::table('cates')->select('c_name','c_id')->get();
        return view('admin.new.add',['data'=>$data]);
    }

    public function doadd(Request $request)
    {
        $data=$request->except(['_koten']);
        //第一种表单验证
        $validatedData = $request->validate([
                    'new_name' => 'required|unique:news',
                ],[
                    'new_name.required'=>'文章标题不能为空',
                    'new_name.unique'=>'文章标题不能重复',

                ]);
        //先判断文件是否存在
        if ($request->hasFile('new_file')) {
            //存在调用upload方法
            $res=$this->upload($request,'new_file');
            //判断code是否正确
            if($res['code']){
                //把图片路径赋值给$data
                $data['new_file']=$res['imgurl'];
            }
        }
        $res=News::create($data);

        if($res){
            return redirect('/news/index');
        }
    }

    public function upload(Request $request ,$file){
        if ($request->file($file)->isValid()){
            $photo=$request->file($file);
            $store=$photo->store(date('Ymd'));
            return ['code'=>1,'imgurl'=>$store];
        }else{
            return ['code'=>0,'message'=>'上传出错'];
        }
    }
    public function detail($id)
    {
        $data = cache('new_'.$id);
//        dd($data);
        if(!$data){
            echo 11;
            $data =  DB::table('news')
                ->join('cates','news.c_id','=','cates.c_id')
                ->where('new_id',$id)
                ->first();

            cache(['new_'. $id=>$data],60);

        }

        if(Redis::exists('num')){
            $num=Redis::incr('num');
        }else{
            $num=Redis::set('num',1);
        }
        return view('admin.new.detail',['data'=>$data,'num'=>$num]);
    }
}
