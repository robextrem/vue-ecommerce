@extends('layouts.app')
@section('content')
<section class="section">
  <a href="/admin/users/new" class="button is-link is-pulled-right">Add user</a>
  <h1 class="is-size-4">Users list</h1>
  <br/>
  @if(count($users)>0)
  <table class="table is-bordered is-fullwidth">
  <tr><th>Name</th><th>Email</th><th>Action</th></tr>
  @foreach($users as $user)
  <tr>
    <td>{{$user->name}}</td>
    <td>{{$user->email}}</td>
    <td>
      <a href="/admin/users/{{$user->id}}" class="button is-small"><span class="icon is-small"><i class="fa fa-pencil"></i></span><span>Editar</span></a> 
      <a href="#" data-id="{{$user->id}}" v-on:click="deleteUser({{$user->id}}, $event)" class="button btn-delete is-small"><span class="icon is-small"><i class="fa fa-trash-o"></i></span><span>Borrar</span></a>
      </td>
  </tr>
  @endforeach
  </table>
  @else
  <span>Por ahora no hay usuarios registrados</span>
  @endif
  <a href="/admin/users/new" class="button is-link is-pulled-right">Add user</a>
</section>
@endsection
