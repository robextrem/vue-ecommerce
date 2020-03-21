@extends('layouts.store')

@section('content')
<section class="section">
    <div class="container">
    @if(count($cart)>0)
    <h1 class="is-size-3">Shopping cart</h1>
    <table class="table is-fullwidth">
    <tr><th>Name</th><th>Qty</th><th>Price</th><th>Subtotal</th><th>&nbsp;</th></tr>
    @foreach($cart as $c)
        <tr><td><img class="is-pulled-left" src="{{$c->options->image}}" width="50px">&nbsp;{{$c->name}}</td><td>{{$c->qty}}</td><td>${{number_format($c->price,2,".",",")}}</td><td>${{number_format($c->subtotal,2,".",",")}}</td><td><a href="/cart/remove/{{$c->rowId}}">Remove</a></td></tr>
    @endforeach
    </table>
    <div class=" is-pulled-right">
    <h1 class="has-text-right is-size-4">Total ${{\Cart::priceTotal()}}</h1><br/>
    <a class="is-medium button" href="/"><span>Continue shopping</span></a>
    <a class="is-medium is-primary button" href="/checkout"><span>Proceed to checkout</span><span class="icon"> <i class="fa fa-arrow-right"></i></span></a>
    </div>
    @else
    <p>Your shopping cart is empty</p>
    @endif
    </div>
</section>
@endsection
