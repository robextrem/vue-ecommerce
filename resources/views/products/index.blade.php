@extends('layouts.app')
@section('content')
<section class="section">
  <a href="/admin/products/new" class="button is-primary is-pulled-right">+ Add product</a>
  <h1 class="is-size-4">Product list</h1>
  <br/>
  @if(count($products)>0)
  <table class="table is-bordered is-fullwidth">
  <tr><th>Name</th><th>Price</th><th>Actions</th></tr>
  @foreach($products as $product)
  <tr>
    <td>{{$product->name}}</td>
    <td>{{$product->price}}</td>
    <td>
      <a href="/admin/products/{{$product->id}}" class="button is-small"><span class="icon is-small"><i class="fa fa-pencil"></i></span><span>Editar</span></a> 
      <a href="#" data-id="{{$product->id}}" v-on:click="deleteProduct({{$product->id}}, $event)" class="button btn-delete is-small"><span class="icon is-small"><i class="fa fa-trash-o"></i></span><span>Borrar</span></a>
      </td>
  </tr>
  @endforeach
  </table>
  <a href="/admin/products/new" class="button is-primary is-pulled-right">Add product</a>
  @else
  <span>Not a single product was found :(</span>
  @endif
</section>
@endsection
