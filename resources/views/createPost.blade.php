@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card">
        <div class="card-body">
            <form class="w-75 m-auto" enctype="multipart/form-data" method= "POST" action="/post">
                @csrf
                <div class="mb-3">
                    <label class="form-label" for="">Title</label>
                    <input class="form-control" type="text" name="title" id="">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="">Content</label>
                    <textarea class="form-control" name="content" id="" cols="30" rows="10"></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="">Image</label>
                    <input class="form-control" type="file" name="image" id="">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="">Category</label>
                    <select class="form-control" name="category_id" id="">
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>  
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
