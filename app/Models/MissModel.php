<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MissModel extends Model
{
	protected $table = "miss";
    protected $dateFormat = "U";
     protected $guarded = [];
}