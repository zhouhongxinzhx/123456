<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>会员管理-有点</title>
    <link rel="stylesheet" type="text/css" href="/admin/css/css.css" />
    <link rel="stylesheet" type="text/css" href="/admin/css/manhuaDate.1.0.css">
    <script type="text/javascript" src="/admin/js/jquery.min.js"></script>
    <script type="text/javascript" src="/admin/js/manhuaDate.1.0.js"></script>
    <script type="text/javascript" src="/admin/js/jquery-1.7.2.min.js"></script>
    <link rel="stylesheet" href="{{asset('css/page.css')}}" rel="stylesheet" type="text/css">

    <!-- <script type="text/javascript" src="js/page.js" ></script> -->
    <script type="text/javascript">
        $(function (){
            $("input.mh_date").manhuaDate({
                Event : "click",//可选
                Left : 0,//弹出时间停靠的左边位置
                Top : -16,//弹出时间停靠的顶部边位置
                fuhao : "-",//日期连接符默认为-
                isTime : false,//是否开启时间值默认为false
                beginY : 1949,//年份的开始默认为1949
                endY :2100//年份的结束默认为2049
            });
        });
    </script>
</head>

<body>
<div id="pageAll">
    <div class="pageTop">
        <div class="page">
            <img src="/admin/img/coin02.png" /><span><a href="#">首页</a>&nbsp;-&nbsp;<a
                        href="#">公共管理</a>&nbsp;-</span>&nbsp;意见管理
        </div>
    </div>

    <div class="page">
        <!-- vip页面样式 -->
        <div class="vip">
            <div class="conform">
                <form>

                    <div class="cfD">
                        <input class="userinput" ype="text" name="new_name" value="{{$query['new_name']??''}}" placeholder="请输入标题"/><button>搜索</button>

                        <button class="userbtn" ><a href="/news/add">添加</a></button>
                    </div>

                </form>
                <h3>浏览量：{{$num}}</h3>
            </div>
            <!-- vip 表格 显示 -->
            <div class="conShow">
                <table border="1" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="66px" class="tdColor tdC">ID</td>
                        <td width="188px" class="tdColor">文章标题</td>
                        <td width="130px" class="tdColor">文章分类</td>
                        <td width="282px" class="tdColor">文章重要性</td>
                        <td width="130px" class="tdColor">是否显示</td>
                        <td width="235px" class="tdColor">添加日期</td>

                    </tr>
                    
                        <tr>
                            <td>{{$data->new_id}}</td>
                            <td>{{$data->new_name}}</td>
                            <td>{{$data->c_name}}</td>
                            <td>{{$data->new_zy}}</td>
                            <td>{{$data->new_is_show}}</td>
                            <td>{{$data->create_time}}</td>

                        </tr>

                </table>

            </div>
            <!-- vip 表格 显示 end-->
        </div>
        <!-- vip页面样式end -->
    </div>

</div>


<!-- 删除弹出框 -->

<!-- 删除弹出框  end-->
</body>

<script type="text/javascript">
    // 广告弹出框
    $(".delban").click(function(){
        $(".banDel").show();
    });
    $(".close").click(function(){
        $(".banDel").hide();
    });
    $(".no").click(function(){
        $(".banDel").hide();
    });
    // 广告弹出框 end
</script>
</html>