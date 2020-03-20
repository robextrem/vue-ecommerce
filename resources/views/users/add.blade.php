@extends('layouts.app')
@section('content')
<section class="section">
    <h1 class="is-size-4">Add new user</h1>
    <form method="post" action="/admin/users/add">
    @csrf
    <div class="field">
        <label for="name">Name</label>
        <input id="name" type="text" class="input" name="name" value="{{old('name')}}" required>
    </div>
    <div class="field">
        <label for="email">Email</label>
        <input id="email" type="email" class="input" name="email" value="{{old('email')}}" required  autocomplete="off">
    </div>
    @error('email')
        <span class="has-text-danger" role="alert">
        {{ $errors->first("email") }}
        </span>
    @enderror
    <div class="clearfix"></div>
    <button class="submit button is-link">Save user</button>
    </form>
</section>
@endsection
