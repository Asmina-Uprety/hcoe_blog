@extends('layouts.app')

@section('content')
<div class="card-header">List of all categories</div>

<div class="card-body">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <table class="table">
        <thead>
        <tr>
                <th>Title</th>
                <th>Status</th>
                <th>User</th>
                <th>Categories</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody>
                    @foreach($blogs as $blog)
                    <tr>
                        <td>{{ $blog->title }}</td>
                        <td>{{ ($blog->status==1)?"Published":"Unpublished" }}</td>
                        <td>
                           {{$blog->user->name}}
                        </td>
                      
                        <td>
                            <ul>
                            @foreach($blog->categories as $category)
                                <li>{{ $category->name }}</li>
                            @endforeach
                            </ul>
                        </td>
                        <td>
                       
                        </td>
                    </tr>
                    @endforeach

        </tbody>
    </table>

</div>
@endsection
