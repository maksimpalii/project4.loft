<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Category extends Model
{
    use SoftDeletes;

    protected $table = 'categorys';
    protected $dates = ['deleted_at'];

    public function catAll()
    {
        return self::orderBy('created_at')->get();
    }

}
