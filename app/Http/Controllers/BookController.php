<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\Book;
use Illuminate\Support\Facades\Redis;
use DB;

class NewsController extends Controller
{
    public function index()
    {
        return view('book.list');
    }

    public function add()
    {
        return view('book.add');
    }
    public function edit()
    {
        return view('book.edit');

    }
    public function addHandle()
    {
        
    }

    public function upload()
    {
       
    }
//     public function detail($id)
//     {
//         $data = cache('new_'.$id);
// //        dd($data);
//         if(!$data){
//             echo 11;
//             $data =  DB::table('news')
//                 ->join('cates','news.c_id','=','cates.c_id')
//                 ->where('new_id',$id)
//                 ->first();

//             cache(['new_'. $id=>$data],60);

//         }

//         if(Redis::exists('num')){
//             $num=Redis::incr('num');
//         }else{
//             $num=Redis::set('num',1);
//         }
//         return view('admin.new.detail',['data'=>$data,'num'=>$num]);
//     }
}
