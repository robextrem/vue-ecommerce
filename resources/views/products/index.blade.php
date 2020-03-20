@extends('layouts.app')
@section('content')
<section class="section">
  <a href="/admin/products/new" class="button is-link is-pulled-right">Add product</a>
  <h1 class="is-size-4">Product list</h1>
  <br/>
  @if(count($products)>0)
  <table class="table is-bordered is-fullwidth">
  <tr><th>Image</th><th>Name</th><th>Price</th> <th>Status</th><th>Actions</th></tr>
  @foreach($products as $product)
  <tr>
    <td><img width="35px" src="{{($product->getFirstMediaUrl('images'))}}"></td>
    <td>{{$product->name}}</td>
    <td>{{$product->price}}</td>
    <td>
    @if($product->status==0)
    <span class="has-text-danger">Draft</span>
    @else
    <span class="has-text-primary">Published</span>
    @endif
    </td>
    <td>
      <a href="/admin/products/{{$product->id}}" class="button is-small"><span class="icon is-small"><i class="fa fa-pencil"></i></span><span>Editar</span></a> 
      <a href="#" data-id="{{$product->id}}" v-on:click="deleteProduct({{$product->id}}, $event)" class="button btn-delete is-small"><span class="icon is-small"><i class="fa fa-trash-o"></i></span><span>Borrar</span></a>
    </td>
  </tr>
  @endforeach
  </table>
  <?php if ($products->lastPage() > 1) { ?>
          <nav class="pagination is-centered" role="navigation" aria-label="pagination">
                    <a class="pagination-previous" <?php echo ($products->currentPage() == 1) ? "disabled" : "" ?> href="<?php echo ($products->currentPage() == 1) ? "#" : $products->url($products->currentPage() - 1); ?>">Previous</a>
                    <?php if ($products->hasMorePages()) { ?>   
                      <a class="pagination-next" <?php echo ($products->currentPage() == $products->lastPage()) ? "disabled" : "" ?> href="<?php echo $products->nextPageUrl(); ?>">Next page</a>
                    <?php } ?>
                    <ul class="pagination-list">
                    <?php for ($i = 1; $i <= $products->lastPage(); $i++) { ?>
                        <li> <a class="pagination-link <?php echo ($products->currentPage() == $i) ? "is-current" : "" ?>" href="<?php echo $products->url($i); ?>"><?php echo $i; ?></a></li>
                    <?php } ?>
                      
          </nav>
  <?php } ?>
  <a href="/admin/products/new" class="button is-link is-pulled-right">Add product</a>
  @else
  <span>Not a single product was found :(</span>
  @endif
  
</section>
@endsection
