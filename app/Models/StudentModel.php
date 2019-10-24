<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class StudentModel extends Model
{
	const CREATED_AT= 'ctime';
	const UPDATED_AT= 'utime';

    protected $table = "Students";
    protected $primarykey ="uid";

    protected $dateFormat = "U";

    // public $incrementing = false;

    // protected $keyType = 'string';

    //时间戳设置,取消模型对时间戳的自动管理
    // public $timestamps = false;	
    // protected function getDate(){
    // 	return time();
    // }
    // protected function formatDate($date){
    // 	return strtotime($date);
    // }
}
