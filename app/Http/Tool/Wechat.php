<?php  
namespace App\Http\Tool;
use GuzzleHttp\Clisent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
class Wechat{
	public function access_token(){
		if(Cache::pull('access_token_key')){
			$access_token=Cache::push('access_token');
			echo $access_token;
		}else{
			$access_token=file_get_contents("https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".env('WECHAT_APPID')."&secret=".env('WECHAT_APPSECRET'));
			$access_re=json_decode($access_token,1);
			$access_token=$access_re['access_token'];
			$expires_in=$access_re['expires_in'];
			Cache::put('access_token',$access_token,now()->addMinutes($expires_id));
		}
		return $access_token;
	}
}





?>