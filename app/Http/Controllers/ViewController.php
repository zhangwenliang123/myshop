<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\StudentModel;

class viewController extends Controller
{
    public function model(){

    	$model = new StudentModel();
    	//dd($model); 
    	 $data = $model->get();
    	 // dd($data);
     //    $dt = $model->insert(['name'=>'么嗯','sex'=>'男','age'=>18]);
     //    $dt = $model->where('uid',7)->update(['name'=>'zx','age'=>18]);
     //    $dt = $model->insert(['name'=>'zx','age'=>18]);
        // $model->name ="阿三";
        // $model->sex ='女';
        // $model->age = 21;
        // $dt = $model->save();
        // if($dt){
        // 	 return redirect('/index');
        // }
          
        //更新
        // $data = StudentModel::find(14);
        // $data->name = "爱哎";
        // $dt = $data->save();
        // var_dump($dt);
         $data = StudentModel::findOrFail(14);
    	 return view('model',['list'=>$data],);

    	
    }
}
