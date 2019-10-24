<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleModel extends Model
{
	protected $table = "article";
    protected $dateFormat = "U";
     protected $guarded = [];
}
