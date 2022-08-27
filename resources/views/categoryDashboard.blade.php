@extends('layouts.app')

@section('content')
    <div class="container w-50">
        <div class="row">
            <div class="d-flex mb-3">
                <h3 class="p-2">Category List</h3>
                <button type="button" class="btn btn-success ms-auto p-2" onclick="window.location.href='/category/create'">
                    ➕ <b>Create Category</b>
                </button>
              </div>
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr class="row">
                                <th style="width:40px">#</th>
                                <th class="col text-center">Name</th>
                                <th class="col text-center">Author</th>
                                <th class="col-2 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $index => $category)
                                <tr class="row">
                                    <td style="width:40px">{{ $index + 1 }}</td>
                                    <td class="col text-center">{{ $category->name }}</td>
                                    <td class="col text-center">{{ $category->author->name }}</td>
                                    <td class="col-2 text-center">
                                        <div class="d-grid gap-2">
                                            <div class="d-grid">
                                                <button type="button" class="btn btn-warning" onclick="window.location.href='/category/{{ $category->id }}'">🖋️ Edit</button>
                                            </div>
                                            <form method= "post" action="/category/{{$category->id}}">
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
