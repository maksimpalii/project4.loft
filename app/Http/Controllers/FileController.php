<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image as Image;

class FileController extends Controller
{
    public function upload($file, $book_id)
    {
        $img = Image::make($file['tmp_name'])
            ->resize(600, 400)
            ->save('./uploads/' . $book_id . '_' . $file['name']);
        return $book_id . '_' . $file['name'];
    }
    public function deletePhoto($photo)
    {
        if (file_exists('./uploads/' . $photo)) {
            @unlink('./uploads' . $photo);
            $msg = 'delete';
        } else {
            $msg = 'no';
        }
        return $msg;
    }

}
