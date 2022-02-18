<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;
class HomeController extends Controller
{
    //
    public function index()
    {   
        $posts = Post::all();
        return view('welcome',['posts'=>$posts]);
    }

    public function show($id)
    {   
        $post = Post::find($id);    
        return view('blog.post',['post'=>$post]);
    }

    public function create()
    {
        return view('blog.create');
    }

    public function store(Request $request) 
    {   
        // Need Error Directive inside Form if request not passed the validations @error @enderror
        $request->validate([
            'title' => 'required',
            'image' => 'required | image',
            'body' => 'required'
        ]);
        // File Upload
        $imagePath = 'storage/'.$request->file('image')->store('postsImages','public');
        // then do php artisan storage:link to get a copy in public file
        // dd($request->all());
        $userId = Auth::user()->id;
        $fileds = [
            'title' => $request->input('title'),
            'slug' => Str::slug($request->input('title'),'-'),
            'user_id' => $userId,
            'image' => $imagePath,
            'body' => $request->input('body'),
        ];

        Post::create($fileds);

        return redirect()->back()->with(['mssg' => 'Article Created Successfully']);
    }


    public function contact()
    {
        return view('blog.contact');
    }
}
