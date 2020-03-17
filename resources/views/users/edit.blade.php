@extends('layouts.app')
@section('content')
<section class="section">
    <h1 class="is-size-4">Edit user</h1>
    <form method="post" action="/admin/users/edit">
    @csrf
    <input type="hidden" name="id" value="{{$user->id}}">
    <div class="field">
        <label for="name">Name</label>
        <input id="name" type="text" class="input" name="name" value="{{$user->name}}" required>
    </div>
    <div class="field">
        <label for="email">Email</label>
        <input id="email" type="email" class="input" name="email" value="{{$user->email}}" required  autocomplete="off">
    </div>
    <button class="submit button is-primary">Save</button>
    </form>
</section>
@endsection
