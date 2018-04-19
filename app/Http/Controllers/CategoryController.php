<?php

namespace App\Http\Controllers;

use App\Book;
use App\Categorie;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index($id)
    {
        $cats = new Categorie();
        $book = new Book();
        $data = [
            'cat_this' => Categorie::find($id),
            'categories' => $cats->catAll(),
            'randomBooks' => $book->randomBookCount(1)
        ];

        $books = Book::where('category_id', '=', $id)->paginate(6);
        return view('category', compact('books'), $data);
    }

    public function categoryedit($id)
    {
        $data = [
            'cat' => Categorie::find($id)
        ];
        return view('admin.categoryedit', $data);
    }

    public function categoryupdate($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:5',
            'description' => 'required'
        ]);
        $categ = Categorie::find($id);
        $categ->name = $request->name;
        $categ->description = $request->description;
        $categ->save();


        return redirect('/admin/category/');
    }

    public function categorydestroy($id)
    {
        Categorie::destroy($id);
        return redirect('/admin/category/');
    }

    public function categorycreate()
    {
        return view('admin.categorycreate');
    }

    public function categorystore(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:5',
            'description' => 'required'
        ]);
        $categ = new Categorie();
        $categ->name = $request->name;
        $categ->description = $request->description;
        $categ->save();


        return redirect('/admin/category/');
    }
}
