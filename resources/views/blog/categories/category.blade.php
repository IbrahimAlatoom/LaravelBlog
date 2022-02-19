@extends('layouts.layout')

@section('content')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    @if(session('mssg'))
    <p style="color:red">{{session('mssg')}}</p>
    @endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                <div>
                <h1>Categories List</h1>
                @foreach($categories as $category )
                <div class="item">
                <p>{{$category->name}}    -<a href="{{route('categories.edit',$category)}}"><strong>Edit</strong></a> </p>
                <form action="{{route('categories.destroy',$category)}}" method="post">
                    @method('delete')
                    @csrf
                    <input type="submit" value="Delete">
                </form>
                </div>
                @endforeach
               
            </div>
        </div>
    </div>
    <div>
        <a href="{{route('categories.create')}}">Create a Category  -></a>
    </div>
</x-app-layout>
@endsection