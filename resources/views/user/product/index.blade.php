@extends('layouts.app')

@section('content')
    @if(Session::has('success'))
        <div class="d-flex justify-content-center align-items-center">
            <div class="alert alert-success my-2" role="alert">
                {{ Session::get('success') }}
            </div>
        </div>
    @endif
    <div class="text-end mt-4">
        <form action="{{ route('logout') }}" class="mx-4" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
        <a type="button" href="{{ route('cart') }}" class="btn btn-info"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
            <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
        </svg>Cart<span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span></a>
       
    </div>
    <div class="row">
        @foreach ($products as $item)
            <div class="col-md-4 mt-4">
                <div class="card" style="width: 18rem;">
                    <img src="{{ $item->image ? asset($item->image) :  asset('image/download.jpg') }}" class="card-img-top" alt="..." width="150" height="150">
                    <div class="card-body">
                    <h5 class="card-title">Name : {{$item->name}}</h5>
                    <p class="card-text">Quintity : {{$item->quantity}}</p>
                    <p class="card-text">Price : {{$item->price}}</p>
                    <div class="text-center">
                        <a href="{{ route('addToCart', $item->id) }}" class="btn btn-primary">Add To Cart</a>
                    </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="d-felx justify-content-center mt-4">
        {{  $products->links('pagination::bootstrap-4')}}
    </div>
@endsection