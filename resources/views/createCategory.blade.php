@extends('layouts.app')

@section('content')

<div class="container w-50">
    <div class="card">
        <div class="card-body">
            <h2 class="d-flex justify-content-center">Create Category</h2>
            <form class="p-3" enctype="multipart/form-data" method= "POST" action="/category">
                @csrf
                <div class="mb-3">
                    <label class="form-label fs-4" for="">Name</label>
                    <input class="form-control" type="text" name="name" id="" required>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Submit</button>                
                </div>
            </form>
        </div>
    </div>
</div>
    
@endsection
