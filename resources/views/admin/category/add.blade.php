@extends('layouts.app')

@section('content')
<div class="card-header">Add new Category</div>

<div class="card-body">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <form enctype="multipart/form-data" action="{{ route('categories.store') }}" method="post">
        @csrf 

        <p>
            <label for="name">Name</label>
            <input id="name" type="text" name="name" class="form-control" autofocus>
        </p>
        <p>
            <label>Featured image</label>
            <input type="file" name="featured_image" id="">
        </p>
        <p>
            <label for="description">Description about category</label>
            <textarea name="description" id="description" class="form-control" rows="10"></textarea>
        </p>
        <p>
            <label>
                <input type="checkbox" name="show_on_menu_page"> Show on menu bar
            </label>
        </p>
        
        <input type="submit" value="Add" class="btn btn-primary">

    </form>
</div>
@endsection
