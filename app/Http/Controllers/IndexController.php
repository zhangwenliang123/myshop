<?php

namespace App\Http\Controllers;
use App\models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
	   //显示学生信息列表
	   public function index(Request $request){
	   	$query=request()->input();

	   	$name = request()->post('name');
	   	$age = request()->post('age');
	   	$where=[];
	   	if($name){
	   		$where[]=['name','like',"%$name%"];
	   	}
	   	if($age){
	   		$where[]=['age','=',$age];
	   	}

	   //$data= DB::select('select * from student');
	   $data = DB::table('student')->paginate(3);
    
	 
	   return view('index.index',['list'=>$data],compact('data','query','name','age')); 

	   }

	   //添加学生
	   public function add(Request $request){
	   	// $aa=request()->input();
	   	// dump($aa);
	   	  if($request->isMethod('POST')){
	   	  	$all = $request->all();
	   	  	dd($all);
	   	  	$res = DB::insert("insert into student (name,age) values(?,?)",[$all['name'],$all['age']]);
	   	  	 if($res){
	   	  		return redirect("/index");
	   	  	 }
              return redirect()->back();
	   	  }
          return view('index.add');
	   }

	   //修改学生
	    public function update(Request $request){
	    	 $data=$request->all();
	    	 $res=DB::table('student')->where(['id'=>$data['id']])->first();
	    	 return view('index.update',['student'=>$res]);

	   }
       //执行修改页面
	   public function update_do(Request $request){
	   	 $data=$request->all();
	    	 $res=DB::table('student')->where(['id'=>$data['id']])->update([
                   'name'=>$data['name'],
                   'age'=>$data['age'],
	    	 	]);
	    	 if($res){
	    	 	 return redirect('/index');
	    	 }
	    	 return redirect()->back();
           
	   }

	   //删除学生
	   public function delete(Request $request){
	   	$data=$request->all();
	   	$res=DB::table('student')->where(['id'=>$data['id']])->delete();
	   	return redirect('/index');

	   }

	   //批删
	   public function del(Request $request){
	   	$id=$request->input('id');
	   	$str = explode(",",$id);
	   	// dump($str);die;
	   	//利用循坏将需要删除的ID一个一个进行执行sql
	   	foreach($str as $v){
	   		$res=DB::table('student')->where('id','=',$v)->delete();
	   	}
	   	 //dump($res);die;
	   	return redirect('/index');
	   }

       //注册
	   public function register(){

	   	   	return view('text.register');
	   }

	   //注册执行
	   public function register_do(Request $request){
	   	$UserModel = new Users;
	   	if($request->isMethod('POST')){
	   		$all= $request->except('_token');
	   		// dd($all);
	   	    $pwd = md5($all['password']);
	   	    $all['password'] = $pwd;
	   	    // dd($all);
	   	    $res = $UserModel->create($all);
	   	    // dd($res);
	   	    if($res){
	   	    	return redirect('login');
	   	    }else{
	   	    	return redirect()->back();
	   	    }
	   	}
	  }

	  //登录
	  public function login(){

	  	return view('text.login');
	  }



	  //登录判断执行
	  public function login_do(Request $request){

	  	   $UserModel = new Users;
	  	   if($request->isMethod('POST')){
	  	   	$all = $request->except('_token');
	  	   	$where[] =[
	  	   	    'username','=',$all['username'],

	  	   	];
	  	   	$list = $UserModel->where($where)->first();
	  	   	// dd($list);
	  	   	if(empty($list)){
	  	   		echo"用户名不存在";exit;
	  	   	}else{
	  	   		if($list['password'] == md5($all['password'])){
	  	   			$request->session()->put('user',$list);
	  	   		}else{
	  	   			echo "密码错误";exit;
	  	   		}
	  	   	 }
	  	   }
	  }

	  public function model(){
	  	$data = session()->all();

	  }

	  public function addls(){
	  	echo 1;
	  }
}
