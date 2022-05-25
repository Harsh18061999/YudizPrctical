@extends('layouts.app')

@section('content')
    <div class="card mt-4 p-2">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{route('order')}}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-8">
                    <h4>Billing address</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="first_name" class="form-label">First Name</label>
                                <input type="text" name="first_name" class="form-control" id="first_name" aria-describedby="first_name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="last_name" class="form-label">Last Name</label>
                                <input type="text" name="last_name" class="form-control" id="last_name" aria-describedby="last_name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" id="email" aria-describedby="email">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="address" name="address" class="form-control" id="address" aria-describedby="address">
                            </div>
                        </div>
                    </div>
                    <h4 class="mt-2">Payment</h4>
                    <div class="d-block my-3">
                        <div class="custom-control custom-radio">
                          <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" value="credit" checked="" required="">
                          <label class="custom-control-label" for="credit">Credit card</label>
                        </div>
                        <div class="custom-control custom-radio">
                          <input id="debit" name="paymentMethod" type="radio" class="custom-control-input"  value="debit" required="">
                          <label class="custom-control-label" for="debit">Debit card</label>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6 mb-3">
                          <label for="cc_name">Name on card</label>
                          <input type="text" class="form-control" name="cc_name" id="cc_name" placeholder="">
                          <small class="text-muted">Full name as displayed on card</small>
                          <div class="invalid-feedback">
                            Name on card is required
                          </div>
                        </div>
                        <div class="col-md-6 mb-3">
                          <label for="cc_number">Credit card number</label>
                          <input type="text" name="cc_number"  class="form-control" id="cc_number" placeholder="" >
                          <div class="invalid-feedback">
                            Credit card number is required
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-3 mb-3">
                          <label for="cc_expiration">Expiration</label>
                          <input type="text" class="form-control" name="cc_expiration" id="cc_expiration" placeholder="">
                          <div class="invalid-feedback">
                            Expiration date required
                          </div>
                        </div>
                        <div class="col-md-3 mb-3">
                          <label for="cc_expiration">CVV</label>
                          <input type="text" class="form-control" name="cc_cvv" id="cc_cvv" placeholder="" >
                          <div class="invalid-feedback">
                            Security code required
                          </div>
                        </div>
                      </div>
                </div>
                <div class="col-md-4">
                    <h4>Your cart <span class="badge badge-pill badge-danger text-danger">{{ count((array) session('cart')) }}</span></h4>
                    <ul class="list-group mb-3">
                        @php $total = 0 @endphp
                        @if(session('cart'))
                            @php
                                $total = array_column(session('cart'),'price');
                            @endphp
                            @foreach(session('cart') as $id => $details)
                                <li class="list-group-item d-flex justify-content-between lh-condensed">
                                    <div>
                                    <h6 class="my-0">{{$details['name']}} ( quantity:<span class="badge badge-pill badge-danger text-danger">{{$details['quantity']}}</span>)</h6>
                                    <small class="text-muted">Brief description</small>
                                    </div>
                                    <span class="text-muted">${{$details['price']}}</span>
                                </li>
                            @endforeach
                        @endif
                        <li class="list-group-item d-flex justify-content-between">
                          <span>Total (USD)</span>
                          <strong>${{$total == 0 ? 0 : array_sum($total)}}</strong>
                        </li>
                      </ul>
                </div>
            </div>
            <div class="text-center">
                <button class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout</button>
            </div>
        </form>
    </div>
@endsection