@extends('layouts.app')

@section('content')
<div class="card-header">Edit Category</div>

<div class="card-body">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <form enctype="multipart/form-data" action="{{ route('categories.update',$category->id) }}" method="post">
        @csrf 
        @method('PUT')
        <p>
            <label for="name">Name</label>
            <input value="{{ $category->name }}" id="name" type="text" name="name" class="form-control" autofocus>
        </p>
        <p>
            <img src="/images/{{ $category->featured_image }}" height=100 width=200 alt="">
            <label>Featured image</label>
            <input type="file" name="featured_image" id="">
        </p>
        <p>
            <label for="description">Description about category</label>
            <textarea name="description" id="description" class="form-control" rows="10">{{ $category->description }}</textarea>
        </p>
        <p>
            <label>
                <input {{ ($category->show_on_menu_page == 1 ) ? 
                "checked":""  }} type="checkbox" name="show_on_menu_page"> Show on menu bar
            </label>
        </p>
        
        <input type="submit" value="Edit" class="btn btn-primary">

    </form>
</div>
@endsection
