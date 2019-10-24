<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\buthModel;
use App\Models\MissModel;
class MissController extends Controller
{
	//登录页面
   public function missadd(Request $request){
   	if($request->isMethod("POST")){
   		$data=$request->except("_tokan");
   		$where[]=[
        'user_name','=',$data['user_name']
   	  ];
   	  $res=buthModel::where($where)->first();
   	  if($res){
   	  	if($res['user_pwd']==$data['user_pwd']){
   	  		$arr=[
             'err'=>1,
             'msg'=>'登陆成功'
   	  		];
   	  		return json_encode($arr);
   	  	}else{
           $arr=[
             'err'=>2,
             'msg'=>'登录失败'
           ];
           return json_encode($arr);
   	  	}
   	  }
   	}

    return view('miss.missadd');
   }

 public function missindex(){

   return view('miss.missindex');

 }
 public function missexit(Request $request){
     	if($request->isMethod('POST')){
	   	  	$all = $request->all();
	   	  	//dd($all);
	   	  	$res = DB::insert("insert into miss (use_name,use_price) values(?,?)",[$all['use_name'],$all['use_price']]);
	   	  	dd($res);
	   	  	 if($res){
	   	  		return redirect("/missadd_do");
	   	  	 }
              return redirect()->back();
	   	  }
          return view('miss.missexit');
	   }

 
}
