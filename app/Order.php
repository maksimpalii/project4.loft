<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    public function books()
    {
        return $this->hasOne('App\Book', 'id', 'book_id')->withTrashed();
    }
}
