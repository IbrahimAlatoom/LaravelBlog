@extends('layouts.layout')

@section('content')
<div class="row tm-row">
    <div class="col-12">
        <hr class="tm-hr-primary tm-mb-55">
        <img src="{{asset($post->image)}}" alt="Image" class="img-fluid">
    </div>
</div>
<div class="row tm-row">
    <div class="col-lg-8 tm-post-col">
        <div class="tm-post-full">                    
            <div class="mb-4">
                <h2 class="pt-2 tm-color-primary tm-post-title">{{$post->title}}</h2>
                <p class="tm-mb-40">{{$post->created_at->diffForHumans()}} posted by {{$post->user->name}}</p>
                <p>
                    {!!$post->body!!} </p>
                <p>
                    Duis pretium efficitur nunc. Mauris vehicula nibh nisi. Curabitur gravida neque
                    dignissim, aliquet nulla sed, condimentum nulla. Pellentesque id venenatis
                    quam, id cursus velit. Fusce semper tortor ac metus iaculis varius. Praesent
                    aliquam ex vel lectus ornare tristique. Nunc et eros quis enim feugiat tincidunt
                    et vitae dui.
                </p>
                <span class="d-block text-right tm-color-primary">Creative . Design . Business</span>
            </div>
            
            <!-- Comments -->
            <div>
                <h2 class="tm-color-primary tm-post-title">Comments</h2>
                <hr class="tm-hr-primary tm-mb-45">
                
                @foreach($comments as $comment)
                <div class="tm-comment tm-mb-45">
                    <figure class="tm-comment-figure">
                        <img src="{{asset('img/comment-1.jpg')}}" alt="Image" class="mb-2 rounded-circle img-thumbnail">
                        <figcaption class="tm-color-primary text-center">{{$comment->user->name}}</figcaption>
                    </figure>
                    <div>
                        <p>
                            {{$comment->body}}
                        </p>
                        <div class="d-flex justify-content-between">
                            <!-- <a href="#" class="tm-color-primary">REPLY</a> -->
                            <span class="tm-color-primary">{{$comment->created_at->diffForHumans()}}</span>
                        </div>                                                 
                    </div>                                
                </div>
                @endforeach


                <form action="{{route('comments.store')}}" method="post" class="mb-5 tm-comment-form">
                    @csrf
                    <h2 class="tm-color-primary tm-post-title mb-4">Your comment</h2>
                    <div class="mb-4">
                        <label for="username">{{Auth::user()->name}}</label>
                    </div>
                    <div class="mb-4">
                        <input type="hidden" name="post_id" value="{{$post->id}}">
                        <textarea class="form-control" name="body" rows="6">Comment....</textarea>
                    </div>
                    <div class="text-right">
                        <button class="tm-btn tm-btn-primary tm-btn-small">Submit</button>                        
                    </div>                                
                </form>                          
            </div>
        </div>
    </div>
    <!-- sidebar Categories -->
    <aside class="col-lg-4 tm-aside-col">
        <div class="tm-post-sidebar">
            <hr class="mb-3 tm-hr-primary">
            <h2 class="mb-4 tm-post-title tm-color-primary">Categories</h2>
            <ul class="tm-mb-75 pl-5 tm-category-list">
                <!-- <li><a href="#" class="tm-color-primary">Visual Designs</a></li>
                <li><a href="#" class="tm-color-primary">Travel Events</a></li>
                <li><a href="#" class="tm-color-primary">Web Development</a></li>
                <li><a href="#" class="tm-color-primary">Video and Audio</a></li>
                <li><a href="#" class="tm-color-primary">Etiam auctor ac arcu</a></li>
                <li><a href="#" class="tm-color-primary">Sed im justo diam</a></li> -->
                @foreach($categories as $category)
                <li><a href="{{route('home',['category'=>$category->name])}}" class="tm-color-primary">{{$category->name}}</a></li>
                @endforeach
            </ul>
            <hr class="mb-3 tm-hr-primary">
            <h2 class="tm-mb-40 tm-post-title tm-color-primary">Related Posts</h2>
            @foreach($relatedPosts as $relatedPost)
            <a href="{{route('post',$relatedPost)}}" class="d-block tm-mb-40">
                <figure>
                    <img src="{{asset($relatedPost->image)}}" alt="Image" class="mb-3 img-fluid">
                    <figcaption class="tm-color-primary">{{$relatedPost->title}}</figcaption>
                </figure>
            </a>
            @endforeach
            <!-- <a href="#" class="d-block tm-mb-40">
                <figure>
                    <img src="{{asset('img/img-05.jpg')}}" alt="Image" class="mb-3 img-fluid">
                    <figcaption class="tm-color-primary">Integer quis lectus eget justo ullamcorper ullamcorper</figcaption>
                </figure>
            </a>
            <a href="#" class="d-block tm-mb-40">
                <figure>
                    <img src="{{asset('img/img-06.jpg')}}" alt="Image" class="mb-3 img-fluid">
                    <figcaption class="tm-color-primary">Nam lobortis nunc sed faucibus commodo</figcaption>
                </figure>
            </a> -->
        </div>                    
    </aside>
</div>
@endsection