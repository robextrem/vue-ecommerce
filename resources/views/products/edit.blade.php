@extends('layouts.app')
@section('content')
<div class="container">
<section class="section">
    @if($product->status==0)
    <span class="tag is-pulled-right is-danger">Draft</span>
    @else
    <span class="tag is-pulled-right is-primary">Published</span>
    @endif
    <h1 class="is-size-4">Edit product</h1>
    <form method="post" action="/admin/products/edit">
        @csrf
        <input type="hidden" name="id" id="id" value="{{$product->id}}">
        <div class="field">
            <label for="name">Name</label>
            <input id="name" type="text" class="input" name="name" value="{{$product->name}}" required>
            @if($product->slug)
            <a class="is-size-7" target="_blank" href='{{url("/product/$product->slug")}}'>{{url("/product/$product->slug")}}</a>
            @endif
            @error('name')
                    <span class="has-text-danger" role="alert">
                    {{ $errors->first("name") }}
                    </span>
            @enderror
        </div>
        <label for="imageUrl">Product Image</label>
        <input type="hidden" id="imageUrl" value="{{$media}}">
        <file-upload-component></file-upload-component>
        <div class="field">
            <label for="description">Description</label>
            <textarea class="textarea" id="description" name="description">{{$product->description}}</textarea>
            @error('description')
                    <span class="has-text-danger" role="alert">
                    {{ $errors->first("description") }}
                    </span>
            @enderror
        </div>
        <div class="columns">
            <div class="column">
                <div class="field">
                    <label for="price">Price</label>
                    <input id="price" type="text" class="input" name="price" value="{{$product->price}}" required>
                </div>
                @error('price')
                    <span class="has-text-danger" role="alert">
                    {{ $errors->first("price") }}
                    </span>
                @enderror
            </div>
            <div class="column">
                <div class="field">
                    <label for="filepond">Status</label>
                    <div class="control">
                        <div class="select">
                            <select name="status" id="status">
                            <option @php echo ($product->status==0)?"selected":""; @endphp value="0">Draft</option>
                            <option @php echo ($product->status==1)?"selected":""; @endphp value="1">Published</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <button class="submit button is-link">Save product</button>
    </form>
</section>
</div>
@endsection
