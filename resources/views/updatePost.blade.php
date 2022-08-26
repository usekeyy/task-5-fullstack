@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card">
        <div class="card-body">
            <form class="w-75 m-auto" enctype="multipart/form-data" method= "POST" action="/post/{{$post->id}}">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label fs-4" for="">Title</label>
                    <input class="form-control" type="text" name="title" id="" value="{{$post->title}}">
                </div>
                <div class="mb-3 fs-4">
                    <label class="form-label" for="">Content</label>
                    <textarea class="form-control" name="content" id="" cols="30" rows="10">{{$post->content}}</textarea>
                </div>
                <div class="mb-3 fs-4">
                    <label class="form-label" for="">Image</label>
                    <input class="form-control" type="file" name="image" id="" value="{{$post->image}}">
                    <label class="form-label mt-2 me-3" for="">Last Image</label>
                    <img class= "mt-2" src="/images/{{$post->image}}" height="120px" width="200px" alt="">
                </div>
                <div class="mb-3 fs-4">
                    <label class="form-label" for="">Category</label>
                    <select class="form-control" name="category_id" id="">
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}" {{$category->id == $post->category_id ? 'selected' : ''}}>{{$category->name}}</option>      
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">

                    <button type="submit" class="btn btn-primary">Submit</button>                
                </div>
            </form>
        </div>
    </div>
</div>
    
@endsection