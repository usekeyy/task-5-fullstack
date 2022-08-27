@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="d-flex mb-3">
                <h3 class="p-2">Post List</h3>
                <button type="button" class="btn btn-success ms-auto p-2" onclick="window.location.href='/post/create'">
                    ➕ <b>Create Post</b>
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
                                <th class="col text-center">Image</th>
                                <th class="col">Category</th>
                                <th class="col">Author</th>
                                <th class="col text-center">Action</th>
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
                                    <td class="col text-center">
                                        <div class="d-grid gap-2">
                                            <div class="d-grid">
                                                <button type="button" class="btn btn-warning" onclick="window.location.href='/post/{{ $post->id }}'">🖋️ Edit</button>
                                            </div>
                                                <form method= "POST" action="/post/{{$post->id}}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="d-grid">
                                                        <button type="submit" class="btn btn-danger">🗑️ Delete</button>
                                                    </div>
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
@endsection
