@extends('layouts.app')

@section('content')
<section>
  <div class="container-fluid">
    <ul class="breadcrumb">
      <li class="breadcrumb-item"><a href="/">Home</a></li>
      <li class="breadcrumb-item">Administradores</li>
      <li class="breadcrumb-item active">Registrar</li>
    </ul>
    <div class="card">
      <div class="card-header d-flex align-items-center">
        <h2 class="h5 display display">Registar administrador</h2>
      </div>
      <div class="card-body">
        <p>Lorem ipsum dolor sit amet consectetur.</p>
        <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
          {{ csrf_field() }}
          <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" name="name" id="name" placeholder="..." class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}" required>
            @if ($errors->has('name'))
              <div class="invalid-feedback">{{ $errors->first('name') }}</div>
            @endif
          </div>
          <div class="form-group">
            <label for="email">Correo electrónico</label>
            <input type="text" name="email" id="email" placeholder="..." class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" required>
            @if ($errors->has('email'))
              <div class="invalid-feedback">{{ $errors->first('email') }}</div>
            @endif
          </div>
          <div class="form-group">
            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" placeholder="..." class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" value="{{ old('password') }}" required>
            @if ($errors->has('password'))
              <div class="invalid-feedback">{{ $errors->first('password') }}</div>
            @endif
          </div>
          <div class="form-group">
            <label for="password-confirm">Confirmar contraseña</label>
            <input id="password-confirm" type="password" name="password_confirmation" placeholder="..." class="form-control" value="{{ old('password_confirmation') }}" required>
          </div>
          <div class="form-group">
            <button id="login" type="submit" class="btn btn-primary">Registrar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
@endsection
