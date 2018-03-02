@extends('layouts.app')

@section('content')
<section>
  <div class="container-fluid">
    <ul class="breadcrumb">
      <li class="breadcrumb-item"><a href="/admin">Home</a></li>
      <li class="breadcrumb-item active">Trabajos terminados</li>
    </ul>
    <!-- Errors -->
    @if ($errors->any())
      @foreach ($errors->all() as $error)
      <div class="row">
        <div class="col-12">
          <div class="alert btn-danger" role="alert">
            {{ $error }}
          </div>
        </div>
      </div>
      @endforeach
    @endif
    <!-- End of Errors -->
    <!--Success-->
    @if(session('success'))
      <div class="row">
        <div class="col-12">
          <div class="alert btn-info" role="alert">
            {{ session('success') }}
          </div>
        </div>
      </div>
    @endif
    <!--Fin success-->
    <div class="card">
      <div class="card-header" style="display:flex; justify-content:space-between;padding-bottom: 45px;">
        <h4>Trabajos terminados</h4>
      </div>
      @include('products.table')
    </div>
  </div>
</section>
@endsection
