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
                    <h1>Create Category</h1>
                    <br>
                    @if(session('mssg'))
                        <p style="color:green">{{session('mssg')}}</p>
                    @endif
                    <hr>
                    <br>
                    <!-- Create a Categor Form -->
                    <form action="{{route('categories.store')}}" method="post">
                        @csrf
                        <!-- Name  -->
                        <label for="tiltle">Category Name : </label>
                        <input type="text" name="name" id="name" value="{{old('name')}}">
                        @error('name')
                        <p style="color : red">{{$message}}</p>
                        @enderror
                        <!-- Button -->
                        <br>
                        <br>
                        <hr>
                        <input type="submit" value="submit">
                    </form>
                </div>
            </div>
                <div>
                <a href="{{route('categories.index')}}">Category List -></a>
                </div>
        </div>
    </div>
</x-app-layout>
@endsection