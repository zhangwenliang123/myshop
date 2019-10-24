<?php

namespace App\Http\Controllers\Buth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\buthModel;
use App\Models\buthindexModel;   
class ButhIndexController extends Controller
{
	
    //注册
    public function buthregist(Request $request){
        return view('buth.buth.buthregist');
    }
    
    //注册执行
    public function buthregist_do(Request $request){
        $data=$request->except('_tokan');
        $res=buthModel::create($data);
        if ($res) {
            $arr=[
                'error'=>1,
                'msg'=>'注册成功'
            ];
            return json_encode($arr);
        }else{
            $arr=[
                'error'=>2,
                'msg'=>'注册失败'
            ];
            return json_encode($arr);
        }
    }
   //登录
    public function buthlogin(Request $request){
    
        if ($request->isMethod("POST")) {
            $data=$request->except('_tokan');
            $where[]=[
                'user_name','=',$data['user_name']
            ];

            $res=buthModel::where($where)->first();
            if ($res) {
               if ($res['user_pwd']==$data['user_pwd']) {
                   $arr=[
                        'err'=>1,
                        'msg'=>"登陆成功"
                   ];
                  return json_encode($arr);
               }else{
                      $arr=[
                        'err'=>2,
                        'msg'=>"登陆失败"
                   ];
                  return json_encode($arr);

               }
            }else{
                  $arr=[
                        'err'=>2,
                        'msg'=>"未注册"
                   ];
                  return json_encode($arr);
            }
        }
        
        return view('buth.buth.buthlogin');
    }

    //商品页面
    public function buthindex(Request $request){
        $data=$request->all();
        $list=buthindexModel::all();
        //dd($list);
	  	return view('buth.buth.buthindex',['list'=>$list]);
    } 
    
    //商品详情页
    public function buthexit(Request $request){
        $goods_id=$request->all();
        //dd($goods_id);
        $list=buthindexModel::where(['goods_id'=>$goods_id['goods_id']])->first();
            //dd($list);
        return view('buth.buth.buthexit',['list'=>$list]);
    }

    //购物车
    public function buthcart(Request $request){
       if($request->isMethod('POST')){
         $data=$request->except('_tokan');
         $res=buthindexMode::create($data);
         //dd($res);
         if($res){
            return $resd=['font'=>'','code'=>1];
         }else{
            return $resd=['font'=>'加入购物车失败','code'=>2];

         }
         return json_encode($resd);

        }
        return view('buth.buth.buthcart');
    }

    //产品列表
    public function buthprolist(){
        return view('buth.buth.buthprolist');
    }

    //订单管理
    public function buthorders(){
        return view('buth.buth.buthorders');
    }

    //购物车结算
    public function buthinfo(){
        return view('buth.buth.buthinfo');
    }


    
    

}
