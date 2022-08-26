@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="d-flex justify-content-end mb-3">
                <button type="button" class="btn btn-success" onclick="window.location.href='/post/create'">
                    ➕ Create Post
                </button>
            </div>
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr class="row">
                                <th style="width:40px">#</th>
                                <th class="col-3">Title</th>
                                <th class="col-3">Content</th>
                                <th class="col">Image</th>
                                <th class="col">Category</th>
                                <th class="col">Author</th>
                                <th class="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $index => $post)
                                <tr class="row">
                                    <td style="width:40px">{{ $index + 1 }}</td>
                                    <td class="col-3">{{ $post->title }}</td>
                                    <td style="max-width: 300px;" class="col-3 d-inline-block text-truncate">
                                        {{ $post->content }}</td>
                                    <td class="col">
                                        <img src="/images/{{ $post->image }}" height="80px" width="100px" alt="">
                                    </td>
                                    <td class="col">{{ $post->category->name }}</td>
                                    <td class="col">{{ $post->author->name }}</td>
                                    <td class="col">
                                        <div class="d-grid gap-2">
                                            <button type="button" class="btn btn-warning" onclick="window.location.href='/post/{{ $post->id }}'">🖋️ Edit</button>
                                            <form method= "POST" action="/post/{{$post->id}}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">🗑️ Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="container">
         <div class="row col">
             <div class="card">
                 <div class="card-body">
                 <a href="{{ '/articles/create/'}}" class="btn btn-primary my-3"><i class="bi bi-plus">Add Article</i></a>
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Title</th>
                            <th scope="col">Content</th>
                            <th scope="col">Image</th>
                            <th scope="col">Author</th>
                            <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <th scope="row"></th>
                            <td></td>
                            <td></td>
                            <td><img width="32" height="32" src="" alt=""></td>
                            <td></td>
                            <td class="d-flex">
                                <a href="" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>
                                <form action='' method="POST">
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit" class="btn btn-danger" data-method="DELETE"><i class="bi bi-trash3-fill"></i></button>
                                </form>
                            </td>
                            </tr>
                        </tbody>
                    </table>
                 </div>
             </div>
            
        </div>
    </div> --}}
@endsection
