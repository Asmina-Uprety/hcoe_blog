@extends('layouts.app')

@section('content')
<div class="card-header">Add new Blog</div>

<div class="card-body">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <form enctype="multipart/form-data" action="{{ route('blogs.store') }}" method="post">
        @csrf 

        <p>
            <label>Title</label>
            <input type="text" name="title" class="form-control" autofocus>
        </p>
        <p>
            <label for="description">Description about blog</label>
            <textarea name="description" id="description" class="form-control" rows="10"></textarea>
        </p>
        <p>
            <label for="excerpt">Excerpt about blog</label>
            <textarea name="excerpt" id="excerpt" class="form-control" rows="3"></textarea>
        </p>
        <p>
            <label>Image</label>
            <input type="file" name="image" id="">
        </p>
        <p>
            <label for="video">Video link</label>
            <textarea name="video" id="video" class="form-control" rows="3"></textarea>
        </p>
       
        <p>
            <label>
                <input type="checkbox" name="status"> Published
            </label>
        </p>
        <p>
            <label>Categories</label> <br>
            @foreach(App\Category::all() as $category)
                <input type="checkbox" name="category_id[]" value="{{ $category->id }}"> {{ $category->name }}
            @endforeach
        </p>
        <input type="submit" value="Add" class="btn btn-primary">

    </form>
</div>
@endsection
