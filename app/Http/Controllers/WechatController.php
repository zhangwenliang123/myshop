<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Tool\Wechat;
use Illuminate\Support\Facades\Cache;
use App\Tools\Tools;
use DB;
class WechatController extends Controller
{
  public $tools;
  public $request;
  public function __construct(Tools $tools,Request $request){
    $this->tools=$tools;
    $this->request=$request;
  }
  
	
	public function indexa()
	{
       $key="wechat_access_token";
       //判断缓存是否存在
       if (Cache::has($key)) {
       		// 取缓存
       		$wechat_access_token=Cache::get($key);
       }else{
       	//取不到，调接口，缓存
       		$re=file_get_contents('https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wxdfbf1a2f4a1ae73a&secret=6852862ef51147030ab56877aa5fe85d');
       		$resurl=json_decode($re,1);
       		Cache::put($key,$resurl['access_token'],$resurl['expires_in']);
       		$wechat_access_token=$resurl['access_token'];
       }
       return $wechat_access_token; 
	}

    //获取用户信息
	public function wechat_add(){
		$token=$this->indexa();
		$data=file_get_contents('https://api.weixin.qq.com/cgi-bin/user/get?access_token='.$token.'&next_openid=');
		$user=json_decode($data,1);
		$dtinfo=[];
		foreach($user['data']['openid'] as $v){
              $userinfo=file_get_contents('https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$token.'&openid='.$v.'&lang=zh_CN');
              $dtinfo[]=json_decode($userinfo,1);

	     }
	     //dd($dtinfo);
	    return view('wechat_list',['dtinfo'=>$dtinfo]);
	}


   // 网路授权
    public function author(){
        $appid='wxdfbf1a2f4a1ae73a';
        $redirect_uri=urlencode(env('APP_URL').'/getUserInfo');
        //dd($redirect_uri);
        $url="https://open.weixin.qq.com/connect/oauth2/authorize?appid=$appid&redirect_uri=$redirect_uri&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect";
         //dd($url);
        header("Location:".$url);
    }
    
     public function getUserInfo(Request $request){
       $data=$request->all();
       dd($data);
       $appid='wxdfbf1a2f4a1ae73a';
       $secret="6852862ef51147030ab56877aa5fe85d";

       $code=$_GET["code"];

       $url="https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appid&secret=$secret&code=$code&grant_type=authorization_code";
       $res=file_get_contents($url);
        //dd($res);
       $resutl=json_decode($res,1);
       // dd($resutl);
       // print_r($resutl);
       $user_wechat=Userwechat::where(['openid'=>$resutl['openid']])->first();
       // dd($user_wechat);
       if (!empty($user_wechat)) {
        // 登陆
           $request->session()->put('user_id',$user_wechat->user_id);
           echo 'ok';
       }else{
             // 注册
             \DB::connection('mysql')->beginTransaction(); //开启事务
             $user_id=Indexuser::insertGetId([
                  'user_name'=>rand(1000,9999).time(),
                    'user_pwd'=>'',
                    'reg_time'=>time()
                ]);
             $insert_wechat=Userwechat::insert([
                    'user_id'=>$user_id,
                    'openid'=>$resutl['openid'],
                ]);
                if ($user_id && $insert_wechat) {
                    // 登陆
                    $request->session()->put('user_id',$user_id);
                    \DB::connection('mysql')->commit();
                }else{
                    \DB::connection('mysql')->rollback();
                    dd('添加信息错误');
                }
        }


            return redirect('/wexinlist');
    }
     //调用接口获得的微信详情页
    public function weixinlist(Request $request){
      $token=$this->weixin();
      //$data=file_get_contents()
      dd($token);
    }


    //get请求
    public function get(){
       $url="http://www.baidu.com";
       $curl=curl_init($url);
       curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
       $result = curl_exec($curl);
       var_dump($result);
       curl_close($curl);
    }
  //post请求
    public function post(){
    	$url="http://www.baidu.com";
    	$curl=curl_init($url);
    	curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
    	curl_setopt($curl,CURLOPT_POST,true);
    	$post_data=[
              'name'=>222
    	];
    	curl_setopt($curl,CURLOPT_POSTFIELDS,$post_data);
    	$result=curl_exec($curl);
    	var_dump($result);
    	curl_close($curl);
    }

   //模板接口
   public function push_template_msg(){
        $url="https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".$this->tools->indexa();
        $data=[
            "touser"=>'o13FtwuetDOCbemY3q6oDlS4sUQw',
            "template_id"=>"4wSRPNR0whsx4NDrdmmZfdQo-tV5OKGNQRl8yWR4bzc",
            "data"=>[
                   "first1"=>[
                       "value"=>"帅哥",
                       "color"=>""
                        ]
                   ],
            "data"=>[
                   "first2"=>[
                       "value"=>"你真帅",
                       "color"=>""
                        ]
                   ],

        ];
        $re=$this->tools->curl_post($url,json_encode($data,JSON_UNESCAPED_UNICODE));
        $resuel=json_decode($re,1);
        dd($resuel);
    }

     //JS-SDK
    public function get_location(){
     $url = "http://".$_SERVER["HTTP_HOST"].$_SERVER['REQUEST_URI'];
     $appid='wxdfbf1a2f4a1ae73a';
     $_now_=time();
     $rand_str =rand(1000,9999).'jssdk'.time();
     $jsapi_ticket = $this->tools->get_jsapi_ticket();
     $sign_str='jsapi_ticket='.$jsapi_ticket.'&noncestr='.$rand_str.'&timestamp='.$_now_.'&url='.$url;
     $signature=sha1($sign_str);
    
    return view('location',['signature'=>$signature,'appid'=>$appid,'time'=>$_now_,'rand_str'=>$url]);
  }

} 