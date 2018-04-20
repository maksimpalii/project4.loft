<?php

namespace App\Http\Controllers;

use App\Book;
use App\Categorie;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index($id)
    {
        if (!empty(Categorie::find($id))) {
            $cats = new Categorie();
            $book = new Book();
            $data = [
                'cat_this' => Categorie::find($id),
                'categories' => $cats->catAll(),
                'randomBooks' => $book->randomBookCount(1)
            ];

            $books = Book::where('category_id', '=', $id)->paginate(6);
            return view('category', compact('books'), $data);
        } else {
            return redirect('/');
        }
    }

    public function adminCategoryEdit($id)
    {
        $data = [
            'cat' => Categorie::find($id)
        ];
        return view('admin.categoryedit', $data);
    }

    public function adminCategoryUpdate($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3',
            'description' => 'required'
        ]);
        $categ = Categorie::find($id);
        $categ->name = $this->clearAll($request->name);
        $categ->description = $this->clearAll($request->description);
        $categ->save();


        return redirect('/admin/category/');
    }

    public function adminCategoryDestroy($id)
    {
        Categorie::destroy($id);
        return redirect('/admin/category/');
    }

    public function adminCategoryCreate()
    {
        return view('admin.categorycreate');
    }

    public function adminCategoryStore(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3',
            'description' => 'required'
        ]);
        $categ = new Categorie();
        $categ->name = $this->clearAll($request->name);
        $categ->description = $this->clearAll($request->description);
        $categ->save();


        return redirect('/admin/category/');
    }
}
