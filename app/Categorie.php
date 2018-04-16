<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    public function catAll()
    {
        $data = Categorie::query()
            ->orderBy('created_at', 'asc')
            ->get();
        return $data;
    }
}
