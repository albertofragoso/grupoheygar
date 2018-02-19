@extends('layouts.app2')

@section('content')
<form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
  {{ csrf_field() }}
  <div class="form-group-material">
    <input id="email" type="text" name="email" required class="input-material {{ $errors->has('email') ? ' is-invalid' : '' }}">
    @if ($errors->has('email'))
      <div class="invalid-feedback">{{ $errors->first('email') }}</div>
    @endif
    <label for="password" class="label-material">Usuario</label>
  </div>
  <div class="form-group-material">
    <input id="password" type="password" name="password" required class="input-material {{ $errors->has('password') ? ' is-invalid' : '' }}">
    @if ($errors->has('password'))
      <div class="invalid-feedback">{{ $errors->first('password') }}</div>
    @endif
    <label for="password" class="label-material">Contraseña</label>
  </div><button id="login" type="submit" class="btn btn-primary">Entrar</button>
</form>
@endsection
