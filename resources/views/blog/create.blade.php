@extends('layouts.layout')

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
                    <form action="" method="post">
                        <!-- Titel  -->
                        <label for="tiltle">Title : </label>
                        <input type="text" name="title" id="title">
                        <!-- Image -->
                        <br>
                        <br>
                        <label for="image">Image : </label>
                        <input type="file" name="image" id="image">
                        <!-- Body -->
                        <br>
                        <br>
                        <label for="body">Body :</label>
                        <br>
                        <textarea name="body" id="body" cols="100" rows="10"></textarea>
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