@extends('layouts.app')

@section('content')
    <div class="mt-4">
        <div class="card">
            <div class="card-body">
                <div>
                    <a class="btn btn-primary" href="{{ route('products.index') }}" title="Go back"> Go Back </a>
                </div>
                <h3 class="text-center">Create New Product</h3>
                <form action="{{ route('products.store') }}"  method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-4">
                      <label for="product_name">Name</label>
                      <input type="text" class="form-control" id="product_name" aria-describedby="emailHelp" name="name" placeholder="Enter product name">
                      @error('name')
                      <div class="alert alert-danger p-0 my-2">{{ $message }}</div>
                  @enderror
                    </div>
                    <div class="form-group mb-4">
                      <label for="quantity">Quantity</label>
                      <input type="number" class="form-control" name="quantity" id="quantity" placeholder="Enter product quantity">
                      @error('quantity')
                      <div class="alert alert-danger p-0 my-2">{{ $message }}</div>
                  @enderror
                    </div>
                    <div class="form-group mb-4">
                        <label for="price">Price</label>
                        <input type="number" class="form-control" name="price" id="price" placeholder="Enter product price">
                        @error('price')
                        <div class="alert alert-danger p-0 my-2">{{ $message }}</div>
                    @enderror
                    </div>
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