<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{

    use SoftDeletes;
    protected $dates = ['deleted_at'];
    public function getLast6Books()
    {
        return $data = Book::orderBy('created_at', 'asc')
            ->limit(6)
            ->get();
    }
    public function getRandomBookCount($count)
    {
        return $data = Book::orderByRaw('RAND()')->take($count)->get();
    }
}

