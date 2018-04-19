<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Book;
use App\Categorie;
use App\Role;
use Faker\Factory;


class PopulateController extends Controller
{
    public function index()
    {
        $factory = Factory::create();
        $cat = ['Action', 'RPG', 'Квесты', 'Онлайн-игры', 'Стратегии'];
        for ($i = 0; $i < 5; $i++) {
            $category = new Categorie();
            $category->name = $cat[$i];
            $category->description = $factory->text(50);
            $category->save();
        }
        $rols = ['Admin', 'User'];
        for ($i = 0; $i < 2; $i++) {
            $rol = new Role();
            $rol->name = $rols[$i];
            $rol->display_name = $rols[$i];
            $rol->save();
        }
        for ($i = 0; $i < 30; $i++) {
            $post = new Book();
            $post->name = $factory->jobTitle;
            $post->description = $factory->text(190);
            $post->category_id = rand(1, 5);
            $post->price = rand(100, 800);
            $factory->image($dir = './uploads', $width = 600, $height = 400);
            $post->photo = $factory->image($dir, $width = 600, $height = 400, '', false);
            $post->save();
        }
        return 'Populate';
    }
}
