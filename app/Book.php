<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
//    protected $guarded = ['id'];
//    public $timestamps = false;
//    public $table =

    public function bookAll()
    {
        $data = Book::query()
            ->select('name', 'description', 'category_id', 'price', 'photo', 'id')
            ->orderBy('created_at', 'asc')
            ->limit(6)
            ->get();
        return $data;
    }


    public function randomBookCount($count)
    {
        $data = Book::all()->random($count);
        return $data;
    }

    public function getBookCatId($id)
    {
        $data = Book::find($id);
        return $data->category_id;
    }
}

