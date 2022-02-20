<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;
class HomeController extends Controller
{
    // public function __construcrt()
    // {
    //     $this->middleware('auth')->except(['index']);
    // }

    public function index(Request $request)
    {   
        //Handle search
        if($request->search){
            $posts = Post::where('title','like','%'.$request->search.'%')
            ->orWhere('body','like','%'.$request->search.'%')->latest()->paginate(4);
            // return $request->search;
        }elseif($request->category){
            $posts = Category::where('name',$request->category)
            ->firstOrFail()->posts()->paginate(4)->withQueryString();
            // return $request->search;
        }else{
            $posts = Post::latest()->paginate(4);
        }

        return view('welcome',['posts'=>$posts]);
    }

    // Using Route Model Binding
    public function show(Post $post)
    {   
        // GET CATEEGORIES 
        $categories = Category::all();
        // Get REalted Posts
        $relatedPosts = Category::where('id',$post->category_id)->firstOrFail()
        ->posts()->where('id','!=',$post->id)->paginate(3);

        return view('blog.posts.post',['post'=>$post,'categories'=>$categories,'relatedPosts'=>$relatedPosts]);
    }
    
    public function create()
    {   
        $categories = Category::all();
        return view('blog.posts.create',['categories'=>$categories]);
    }

    public function store(Request $request) 
    {   
        // Need Error Directive inside Form if request not passed the validations @error @enderror
        $request->validate([
            'title' => 'required',
            'image' => 'required | image',
            'body' => 'required',
            'category_id' => 'required'
        ]);
        // File Upload
        $imagePath = 'storage/'.$request->file('image')->store('postsImages','public');
        // then do php artisan storage:link to get a copy in public file
        // dd($request->all());
        $userId = Auth::user()->id;
        if(Post::latest()->first() !== null){
            $postId = Post::latest()->take(1)->first()->id+1;
        }else
        {
            $postId = 1;
        }
        // $fileds = [
        //     'title' => $request->input('title'),
        //     'slug' => Str::slug($request->input('title'),'-').'-'.$postId,
        //     'user_id' => $userId,
        //     'image' => $imagePath,
        //     'category_id' => $request->input('category_id'),
        //     'body' => $request->input('body'),
        // ];
        // Post::create($fileds);
        $post = new Post();
        $post->title = $request->input('title');
        $post->category_id = $request->input('category_id');
        $post->slug = Str::slug($request->input('title'),'-').'-'.$postId;
        $post->user_id = $userId;
        $post->body = $request->input('body');
        $post->image = $imagePath;
        $post->save();
        return redirect()->back()->with(['mssg' => 'Article Created Successfully']);
    }

    public function edit(Post $post)
    {   
        if(auth()->user()->id !== $post->user->id){
            abort(403);
        }
        return view('blog.posts.edit',['post'=>$post]);
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

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->back()->with(['mssg' => 'Article deleted Successfully']);

    }
    public function contact()
    {
        return view('blog.posts.contact');
    }
}
