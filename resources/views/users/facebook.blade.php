@extends('layouts.app2')

@section('content')
<form class="form-horizontal" role="form" method="POST" action="/auth/facebook/register">
  {{ csrf_field() }}
  <div class="feed-profile" style="margin-right:10px; margin-bottom:25px">
    <img src="{{ $user->avatar }}" alt="person" class="img-fluid rounded-circle">
  </div>
  <div class="form-group-material">
    <input id="name" type="text" name="name" required class="input-material" value=" {{ $user->name }}" readonly>
    <label for="password" class="label-material">Nombre</label>
  </div>
  <div class="form-group-material">
    <input id="email" type="text" name="email" required class="input-material" value=" {{ $user->email }}" readonly>
    <label for="password" class="label-material">Email</label>
  </div>
  <div class="form-group-material">
    <input id="customer_id" type="hidden" name="customer_id" value=" {{ $customer->id }}">
  </div>
  <button id="login" type="submit" class="btn btn-primary">Entrar</button>
</form>
@endsection
