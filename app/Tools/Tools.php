<?php

/**
 * Created by PhpStorm.
 * User: baiwei
 * Date: 2019/9/6
 * Time: 15:26
 */
namespace App\Tools;
use Illuminate\Support\Facades\Cache;
class Tools {  
    /**
     * @param $url
     * @param $data
     */
    
    public function curl_get($url){
        $curl = curl_init($url);
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,false);
        curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,false);
        curl_setopt($curl,CURLOPT_POST,true);  //发送post
        $data = curl_exec($curl);
         return $data;
    }

    public function wechat_curl_file($url,$data){
        $curl = curl_init($url);
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,false);
        curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,false);
        curl_setopt($curl,CURLOPT_POST,true);  //发送post
        curl_setopt($curl,CURLOPT_POSTFIELDS,$data);
        $data = curl_exec($curl);
        $errno = curl_errno($curl);  //错误码
        $err_msg = curl_error($curl); //错误信息
        curl_close($curl);
        return $data;
    }

    public function curl_post($url,$data)
    {
        $curl = curl_init($url);
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,false);
        curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,false);
        curl_setopt($curl,CURLOPT_POST,true);  //发送post
        curl_setopt($curl,CURLOPT_POSTFIELDS,$data);
        $data = curl_exec($curl);
        $errno = curl_errno($curl);  //错误码
        $err_msg = curl_error($curl); //错误信息
        curl_close($curl);
        return $data;
    }
    /**
     * 获取access_token
     * @return bool|string
     */
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

     public function get_wechat_user($openid)
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$this->indexa().'&openid='.$openid.'&lang=zh_CN';
        $re = file_get_contents($url);
        $result = json_decode($re,1);
        return $result;
    }
    //获取微信jsapi_ticket

    public function get_jsapi_ticket()
    {
       $key="get_jsapi_ticket";
       //判断缓存是否存在
       if (Cache::has($key)) {
            // 取缓存
            $wechat_jsapi_ticket=Cache::get($key);
       }else{
        //取不到，调接口，缓存
            $re=file_get_contents('https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token='.$this->indexa().'&type=jsapi');
            $resurl=json_decode($re,1);
            Cache::put($key,$resurl['ticket'],$resurl['expires_in']);
            $wechat_jsapi_ticket=$resurl['ticket'];
       }
       return $wechat_jsapi_ticket; 
    }
}