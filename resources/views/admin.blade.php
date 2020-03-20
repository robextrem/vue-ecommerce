@extends('layouts.app')

@section('content')
<section class="hero">
  <div class="hero-body">
    <div class="container">
      <h1 class="title">
      Hello {{ Auth::user()->name }}!
      </h1>
      <h2 class="subtitle">
        Welcome to your store admin
      </h2>
    </div>
  </div>
</section>
@endsection
