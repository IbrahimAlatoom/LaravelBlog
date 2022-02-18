<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;
class HomeController extends Controller
{
    // public function __construcrt()
    // {
    //     $this->middleware('auth')->except(['index']);
    // }

    public function index()
    {   
        $posts = Post::latest()->get();
        return view('welcome',['posts'=>$posts]);
    }

    // Using Route Model Binding
    public function show(Post $post)
    {       
    

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
        $postId = Post::latest()->take(1)->first()->id+1;
        $fileds = [
            'title' => $request->input('title'),
            'slug' => Str::slug($request->input('title'),'-').'-'.$postId,
            'user_id' => $userId,
            'image' => $imagePath,
            'body' => $request->input('body'),
        ];

        Post::create($fileds);

        return redirect()->back()->with(['mssg' => 'Article Created Successfully']);
    }

    public function edit(Post $post)
    {   
        if(auth()->user()->id !== $post->user->id){
            abort(403);
        }
        return view('blog.edit',['post'=>$post]);
    }

    public function update(Request $request,Post $post)
    {   
        if(auth()->user()->id !== $post->user->id){
            abort(403);
        }
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
        $userId = $post->user->id;
        $fileds = [
            'title' => $request->input('title'),
            'slug' => Str::slug($request->input('title'),'-').'-'.$post->id,
            'user_id' => $userId,
            'image' => $imagePath,
            'body' => $request->input('body'),
        ];
        
        $post->update($fileds);

        return redirect()->back()->with(['mssg' => 'Article Updated Successfully']);
    }

    public function delete(Post $post)
    {
        $post->delete();
        return redirect()->back()->with(['mssg' => 'Article deleted Successfully']);

    }
    public function contact()
    {
        return view('blog.contact');
    }
}
