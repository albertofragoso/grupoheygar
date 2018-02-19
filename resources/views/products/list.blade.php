@extends('layouts.app')

@section('content')
<section>
  <div class="container-fluid">
    <ul class="breadcrumb">
      <li class="breadcrumb-item"><a href="/admin">Home</a></li>
      <li class="breadcrumb-item active">Trabajos</li>
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
        <h4>Trabajos</h4>
        <!--Add work-->
        @if (Auth::user()->roll)
          <div class="form-group" style="margin-bottom:50px;">
            <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-sm btn-primary">Agregar </button>
            <!-- Modal-->
              <form action="/products/create" method="post">
                {{ csrf_field() }}
                <div id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                  <div role="document" class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 id="exampleModalLabel" class="modal-title">Nuevo trabajo</h5>
                        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                      </div>
                      <div class="modal-body">
                        <p>Lorem ipsum dolor sit amet consectetur.</p>
                        <form>
                          <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" placeholder="..." name="name" class="form-control" value="{{ old('name') }}" required>
                          </div>
                          <div class="form-group">
                            <label>Cliente</label>
                            <select id="customer" name="customer" class="form-control" required>
                              <option value="">...</option>
                              @forelse ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                              @empty
                                <option> No hay clientes agregados</option>
                              @endforelse
                            </select>
                            <div class="form-group">
                              <label>Sucursal</label>
                              <select name="sucursal" class="form-control" id="sucursal">
                                <option value="">Selecciona un cliente</option>
                              </select>
                            </div>
                          </div>
                          <div class="form-group">
                            <label>Etapa</label>
                            <input type="text" placeholder="..." name="stage" class="form-control" value="{{ old('stage') }}">
                          </div>
                          <div class="form-group">
                            <label>Fecha de entrega</label>
                            <input type="date" placeholder="..." name="finished_at" class="form-control" required>
                          </div>
                          <div class="form-group">
                            <div class="i-checks">
                              <input id="checkboxCustom1" name="bill" type="checkbox" class="form-control-custom" value="1" checked="checked">
                              <label for="checkboxCustom1">Facturación</label>
                            </div>
                          </div>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                      </div>
                    </form>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          @endif
        <!--Fin add work-->
      </div>
      @include('products.table')
    </div>
  </div>
</section>
@endsection
