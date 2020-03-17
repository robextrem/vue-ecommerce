@extends('layouts.app')
@section('content')
<section class="section">
    <h1 class="is-size-4">Add new product</h1>
    <form method="post" action="/admin/products/add">
    @csrf
    <div class="field">
        <label for="name">Name</label>
        <input id="name" type="text" class="input" name="name" value="{{old('name')}}" required>
    </div>
    <div class="field">
        <label for="description">Description</label>
        <textarea class="textarea" id="description" name="description">{{old('description')}}</textarea>
    </div>
    <div class="field">
        <label for="price">Price</label>
        <input id="price" type="text" class="input" name="price" value="{{old('price')}}" required>
    </div>
    @error('price')
        <span class="has-text-danger" role="alert">
        {{ $errors->first("price") }}
        </span>
    @enderror
    <div class="clearfix"></div>
    <button class="submit button is-primary">Save</button>
    </form>
</section>
@endsection
