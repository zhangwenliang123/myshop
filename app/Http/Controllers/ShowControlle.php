<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ArticleModel;
class ShowController extends Controller
{
	//文章添加
     public function show(Request $request){
     	if($request->isMethod('POST')){
            
     		$data=$request->all();
     		$dt=ArticleModel::create($data);
     		// dd($dt);
     		if ($dt) {
     		
     			return redirect('/add_do');
     		}

     		//return redirect()->back();
     	}

     	return view('layout.show');
     }

     // 查询
     public function add_do(Request $request){
     	//$list=ArticleModel::orderBy('id','desc')->paginate(8);
  		return view('layout.add_do');
     }

}
