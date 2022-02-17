@extends('layouts.layout')

@section('editorHead')
<!-- CKEditor CDN https://cdn.ckeditor.com/ -->
<script src="https://cdn.ckeditor.com/4.17.2/standard/ckeditor.js"></script>
@endsection

@section('content')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1>Create Post</h1>
                    <hr>
                    <br>
                    <!-- Create a Post Form -->
                    <form action="{{route('store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <!-- Titel  -->
                        <label for="tiltle">Title : </label>
                        <input type="text" name="title" id="title" value="{{old('title')}}">
                        @error('title')
                        <p style="color : red">{{$message}}</p>
                        @enderror
                        <!-- Image -->
                        <br>
                        <br>
                        <label for="image">Image : </label>
                        <input type="file" name="image" id="image">
                        @error('image')
                        <p style="color : red">{{$message}}</p>
                        @enderror
                        <!-- Body -->
                        <br>
                        <br>
                        <label for="body">Body :</label>
                        <br>
                        <textarea name="body" id="body" cols="100" rows="10" value="{{old('body')}}"></textarea>
                        @error('body')
                        <p style="color : red">{{$message}}</p>
                        @enderror
                        <!-- Button -->
                        <br>
                        <hr>
                        <input type="submit" value="submit">
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
@endsection
@section('editorBody')
<script>CKEDITOR.replace( 'body' );</script>
@endsection