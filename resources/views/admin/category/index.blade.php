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
                <th>Name</th>
                <th>Slug</th>
                <th>Image</th>
                <th>Menu</th>
                <th>Order</th>
                <th>No of posts</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody>
                <form action="/admin/categories/order" method="post">
                    @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->slug }}</td>
                        <td>
                            <img src="/images/{{ $category->featured_image }}" class="img-fluid" alt="">
                        </td>
                        <td>
                            <a id="btn-{{ $category->id }}"  href="/admin/categories/{{ $category->id }}/complete" class="completeBtn btn btn-{{ ($category->show_on_menu_page ==0)?'danger':'primary' }} btn-sm">
                                {{ ($category->show_on_menu_page == 0)?"Nadekhaune":"Dekhaune" }}
                            </a>
                        </td>
                        <td>
                            <input size=1 class="form-control" type="text" name="order" value="{{ $category->order_number }}">
                        </td>
                        <td>10</td>
                        <td>
                        <div class="dropdown show">
                            <a class="btn btn-sm btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            </a>

                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="{{ route('categories.show',$category->id) }}">Details</a>
                                <a class="dropdown-item" href="{{ route('categories.edit',$category->id) }}">Edit</a>
                            </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan=7>
                            @csrf
                            <input type="submit" value="Order" class="btn btn-dark">
                        </td>
                    </tr>
                </form>

        </tbody>
    </table>

</div>
@endsection

@section('scripts')
    <script>
            $(document).ready(function(){
                $('.completeBtn').on('click',function(e){
                    
                    var routeName = $(this).attr('href');

                    // console.log(routeName);

                    $.ajax({
                        type: 'get',
                        url : routeName,

                        success: function(res){
                            // alert(res);

                            var label = $("#btn-"+res).val;

                            console.log(label);
                        }

                    });

                    e.preventDefault();
                });
            });
    </script>
@endsection
