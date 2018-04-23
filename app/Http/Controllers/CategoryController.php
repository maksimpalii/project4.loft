<?php

namespace App\Http\Controllers;

use App\Book;
use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index($id)
    {
        if (!empty(Category::find($id))) {
            $cats = new Category();
            $book = new Book();
            $data = [
                'cat_this' => Category::find($id),
                'categorys' => $cats->catAll(),
                'randomBooks' => $book->getRandomBookCount(1)
            ];
            $books = Book::where('category_id', '=', $id)->paginate(6);
            return view('category', compact('books'), $data);
        } else {
            return redirect('/');
        }
    }

    public function edit($id)
    {
        $data = [
            'cat' => Category::find($id)
        ];
        return view('admin.categoryedit', $data);
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3',
            'description' => 'required'
        ]);
        $categ = Category::find($id);
        $categ->name = $this->clearAll($request->name);
        $categ->description = $this->clearAll($request->description);
        $categ->save();
        return redirect('/admin/category/');
    }

    public function destroy($id)
    {
        Category::destroy($id);
        return redirect('/admin/category/');
    }

    public function create()
    {
        return view('admin.categorycreate');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3',
            'description' => 'required'
        ]);
        $categ = new Category();
        $categ->name = $this->clearAll($request->name);
        $categ->description = $this->clearAll($request->description);
        $categ->save();
        return redirect('/admin/category/');
    }
}
