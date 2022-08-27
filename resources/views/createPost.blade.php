@extends('layouts.app')

@section('content')

<div class="container w-75">
    <div class="card">
        <div class="card-body">
            <h2 class="d-flex justify-content-center">Create Post</h2>
            <form class="p-3" enctype="multipart/form-data" method= "POST" action="/post">
                @csrf
                <div class="mb-3">
                    <label class="form-label fs-4" for="">Title</label>
                    <input class="form-control" type="text" name="title" id="" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fs-4" for="">Content</label>
                    <textarea class="form-control" name="content" id="" cols="30" rows="10" required></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label fs-4" for="">Image</label>
                    <input class="form-control" type="file" name="image" id="" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fs-4" for="">Category</label>
                    <select class="form-control" name="category_id" id="">
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>  
                        @endforeach
                    </select>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Submit</button>                
                </div>
            </form>
        </div>
    </div>
</div>
    
@endsection
