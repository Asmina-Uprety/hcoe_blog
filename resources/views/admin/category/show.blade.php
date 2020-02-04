@extends('layouts.app')

@section('content')
<div class="card-header">
    <h2>{{  $category->name }}</h2>
</div>

<div class="card-body">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <img src="/images/{{ $category->featured_image }}" class="img-fluid" alt="">

    {!! $category->description !!}
  
    <form action="{{ route('categories.destroy',$category->id)}}" method="post">
        @method('DELETE')
        @csrf 
        <input type="submit" value="Delete" class="btn btn-danger" onclick="return confirm('Are you sure?')">
    </form>
</div>
@endsection

