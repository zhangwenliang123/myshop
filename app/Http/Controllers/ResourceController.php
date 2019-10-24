<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tools\Tools;
use App\Models\Resource;
use Illuminate\Support\Facades\Storage;
class ResourceController extends Controller
{
     public $tools;
     public $requery;
     public function __construct(Tools $tools,Request $request){
     	$this->tools=$tools;
     	$this->request=$request;
     }

    public function uploads(){
      return view('Resource.uplodes');
    }

    public function do_uploads(Request $request){
     $req = $this->request->all();
     // dd($req);
     if(!$this->request->hasFile('rsource')){
     	dd('没有文件');
     }
     $file_obj = $this->request->file('rsource');
     $file_ext = $file_obj->getClientOriginalExtension();
     $file_name = time().rand(1000,9999).'.'.$file_ext;
     $path = $this->request->file('rsource')->storeAs('wechat/'.$req['type'],$file_name);
     // dd($path);
     $url="https://api.weixin.qq.com/cgi-bin/material/add_material?access_token=".$this->tools->indexa().'&type='.$req['type'];
     //echo storage_path('app/public/'.$path);
     $data=[
     	'media'=>new \CURLFile(storage_path('app/public/'.$path)),
     ];

     if($req['type']=='video'){
     	$data['description'] = [
            'title'=>'标题',
            'introduction'=>'描述'
     	];
     	$data['description']=json_encode($data['description'],JSON_UNESCAPED_UNICODE);
     }
     $re = $this->tools->wechat_curl_file($url,$data);
     //dd($re);
     $result = json_decode($re,1);
     if(!isset($result['errcode'])){
     	Resource::insert([
               'media_id'=>$result['media_id'],
               'type'=>$type_arr[$req['type']],
               'path'=>'/storage'.$path,
               'addtime'=>time()
     		]);
     }
    return redirect('/source_list');
    }


    //展示
    public function source_list(Request $request){
    	$req=$request->all();
    	$url="https://api.weixin.qq.com/cgi-bin/material/batchget_material?access_token=".$this->tools->indexa();
        $data=[
           "type"=>'image',
           "offset"=>'0',
           "count"=>20
        ];
        $re=$this->tools->curl_post($url,json_encode($data,JSON_UNESCAPED_UNICODE));
        $result=json_decode($re,1);
        $res=Resource::all();
        return view('Resource.sourceList',['res'=>$res]);
    }

    public function clear_api(){
    	$url='https://api.weixin.qq.com/cgi-bin/clear_quote/?access_token='.$this->tools->indexa();
    	$data=['appid'=>'wxdfbf1a2f4a1ae73a'];
    	$re=$this->tools->curl_post($url,json_encode($data));
    	$result=json_decode($re,1);
    	dd($result);
    }
}

