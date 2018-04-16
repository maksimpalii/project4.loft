<?php

namespace App\Http\Controllers;

use App\Post;
use Faker\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    public function asd()
    {
        $data = ['asd' => 'asd'];
        return view('posts.index', $data);
    }

    public function populate()
    {
        $factory = Factory::create();
        for ($i = 0; $i < 10; $i++) {
            $post = new Post();
            $post->title = $factory->sentence(3);
            $post->content = $factory->text(200);
            $post->user_id = rand(1, 10);
            $post->save();
        }
        return 'Populate';
    }

    public function index()
    {
        $data = [
            'posts' => Post::all()
        ];
        Log::info('User wathced the index');
        return view('posts.index', $data);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->get('content');
        $post->user_id = Auth::id();
        $post->save();

        return redirect('/posts');
    }

    public function edit($post_id)
    {
        $data = [
            'post' => Post::find($post_id)
        ];
        return view('posts.edit', $data);
    }

    public function update($post_id, Request $request)
    {
        $this->validate($request, [
            'title'=> 'required|min:10',
            'content'=> 'required',
            'image' =>'image'
        ]);
        $post = Post::find($post_id);
        $post->title = $request->title;
        $post->content = $request->get('content');
        $post->save();

//        $file = $request->file('image');
//        $file->move('.', $file->getClientOriginalName());

        return redirect('/posts');
    }

    public function destroy($post_id)
    {
        Post::destroy($post_id);
        return redirect('/posts');
    }
}
