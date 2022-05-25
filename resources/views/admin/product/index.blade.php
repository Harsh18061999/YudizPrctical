@extends('layouts.app')

@section('content')
   
    @if(Session::has('success'))
        <div class="d-flex justify-content-center align-items-center">
            <div class="alert alert-success my-2" role="alert">
                {{ Session::get('success') }}
            </div>
        </div>
    @endif
    <form action="{{ route('logout') }}" class="mx-4 mt-4" method="POST">
        @csrf
        <button type="submit" class="btn btn-danger">Logout</button>
    </form>
    <div class="mt-4 d-flex">
    
        
        <a href="{{ route('products.create') }}" type="button" class="btn btn-info">Add New</a>
        <a href="{{ route('order.details') }}" type="button" class="btn btn-info mx-4">Order Details</a>
        <a href="{{ route('order.details','top10') }}" type="button" class="btn btn-info mx-4">Top 10 Selling Product</a>
    </div>
    <table class="table table-dark table-striped align-middle table-bordered table-responsive-lg bg-white mt-4 text-center">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Image</th>
            <th>Status</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($products as $product)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->quantity }}</td>
                <td>{{ $product->price }}</td>
                <td><img src="{{ $product->image ? asset($product->image) : asset('image/download.jpg') }}" alt="" width="100" height="100"></td>
                <td>{{ $product->status == 1 ? 'Active' : 'Inactive' }}</td>
                <td>
                    <div class="d-flex justify-content-center">
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary mx-2">Edite</a>
                            <button type="submit" class="btn btn-danger mx-2"  class="delete">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
    </table>
    <div class="d-felx justify-content-center">
        {{  $products->links('pagination::bootstrap-4')}}
    </div>

@endsection