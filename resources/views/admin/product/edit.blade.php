@extends('layouts.app')

@section('content')
    <div class="mt-4">
        <div class="card">
            <div class="card-body">
                <div>
                    <a class="btn btn-primary" href="{{ route('products.index') }}" title="Go back"> Go Back </a>
                </div>
                <h3 class="text-center">Update Product</h3>
                <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group mb-4">
                      <label for="product_name">Name</label>
                      <input type="text" class="form-control" id="product_name" aria-describedby="emailHelp" name="name" placeholder="Enter product name" value="{{$product->name}}">
                      @error('name')
                      <div class="alert alert-danger p-0 my-2">{{ $message }}</div>
                  @enderror
                    </div>
                    <div class="form-group mb-4">
                      <label for="quantity">Quantity</label>
                      <input type="number" class="form-control" name="quantity" id="quantity" placeholder="Enter product quantity" value="{{$product->quantity}}">
                      @error('quantity')
                      <div class="alert alert-danger p-0 my-2">{{ $message }}</div>
                  @enderror
                    </div>
                    <div class="form-group mb-4">
                        <label for="price">Price</label>
                        <input type="number" class="form-control" name="price" id="price" placeholder="Enter product price" value="{{$product->price}}">
                        @error('price')
                        <div class="alert alert-danger p-0 my-2">{{ $message }}</div>
                    @enderror
                    </div>
                    <div><img src="{{ $product->image ? asset($product->image) : asset('image/download.jpg') }}" alt="" width="100" height="100"></div>
                    <div class="form-group mb-4">
                        <label for="image">Image</label>
                        <input type="file" class="form-control" name="image" id="image">
                        @error('image')
                        <div class="alert alert-danger p-0 my-2">{{ $message }}</div>
                    @enderror
                    </div>
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                  </form>
            </div>
        </div>
    </div>
@endsection