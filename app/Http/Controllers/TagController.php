<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tools\Tools;

class TagController extends Controller
{
  
    public $tools;
    public $request;
    public function __construct(Tools $tools,Request $request){
         $this->tools=$tools;
         $this->request=$request;

    } 


    public function  tag_list(){
    
    	//公众号标签列表
     $url="https://api.weixin.qq.com/cgi-bin/tags/get?access_token=".$this->tools->indexa();
     $re = $this->tools->curl_get($url);
     $result=json_decode($re,1);
    // dd($result);
      return view('Tag.taglist',['data'=>$result['tags']]);
    }

    public function add_tag(){
    	return view('Tag.tagadd');
    }

    public function do_add_tag(){
    	$req = $this->request->all();
    	$url="https://api.weixin.qq.com/cgi-bin/tags/create?access_token=".$this->tools->indexa();
    	$data=[
    	   'tag'=>[
               'name'=>$req['tag_name']
    	   ]
    	];
       $re = $this->tools->curl_post($url,json_encode($data,JSON_UNESCAPED_UNICODE));
       $result=json_decode($re,1);
       dd($result);
    	//dd($req);

    }
}
