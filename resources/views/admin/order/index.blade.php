@extends('layouts.app')

@section('content')
<table class="table table-dark table-striped align-middle table-bordered table-responsive-lg bg-white mt-4 text-center">
    <tr>
        <th>No</th>
        <th>Name</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Image</th>
        <th>First Name</th>
        <th>Last Name</th>
    </tr>
    @foreach ($orders as $item)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $item->product->name }}</td>
            <td>{{$item->queintity }}</td>
            <td>{{$item->product->price }}</td>
            <td><img src="{{$item->product->image ? asset($item->product->image) : asset('image/download.jpg') }}" alt="" width="100" height="100"></td>
            <td>{{ $item->order->first_name }}</td>
            <td>{{ $item->order->last_name }}</td>
        </tr>
    @endforeach
</table>
<div class="d-felx justify-content-center">
    {{  $orders->links('pagination::bootstrap-4')}}
</div>
@endsection