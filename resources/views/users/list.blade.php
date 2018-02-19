@extends('layouts.app')

@section('content')
<section>
  <div class="container-fluid">
    <ul class="breadcrumb">
      <li class="breadcrumb-item"><a href="/admin">Home</a></li>
      <li class="breadcrumb-item active">Clientes</li>
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
    <!--Fin errors-->
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
        <h4>Clientes</h4>
        <!--Add work-->
        @if (Auth::user()->roll)
          <div class="form-group" style="margin-bottom:50px;">
            <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-sm btn-primary">Agregar </button>
            <!-- Modal-->
              <div id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                <div role="document" class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 id="exampleModalLabel" class="modal-title">Nuevo cliente</h5>
                      <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                    </div>
                    <form action="/customers/create" method="post">
                      {{ csrf_field() }}
                      <div class="modal-body">
                        <p>Lorem ipsum dolor sit amet consectetur.</p>
                          <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" name="name" placeholder="..." class="form-control" value="{{ old('name') }}" required>
                          </div>
                          <div class="form-group">
                            <label>Sucursal</label>
                            <div class="input-group">
                              <div class="input-group-append">
                                <button type="button" class="btn btn-primary" id="delete_sucursal()" onClick="deleteSucursal()">-</button>
                              </div>
                              <input type="text" class="form-control" placeholder="..." name="sucursales[]">
                              <div class="input-group-append">
                                <button type="button" class="btn btn-primary" id="add_sucursal()" onClick="addSucursal()">+</button>
                              </div>
                            </div>
                          </div>
                          <div class="form-group" id="sucursales"></div>
                          <div class="form-group">
                            <label>Dirección</label>
                            <input type="text" name="address" placeholder="..." class="form-control" value="{{ old('address') }}" required>
                          </div>
                          <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" placeholder="..." class="form-control" value="{{ old('email') }}" required>
                          </div>
                          <div class="form-group">
                            <label>Teléfono</label>
                            <input type="phone" name="phone" placeholder="..." class="form-control" value="{{ old('phone') }}" required>
                          </div>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          @endif
        <!--Fin add work-->
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table id="datatable1" style="width: 100%;" class="table">
            <thead>
              <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Dirección</th>
                <th>Inicio</th>
                <th>Actualización</th>
              </tr>
            </thead>
            <tbody>
              @foreach($users as $user)
              <tr>
                <td>
                  <a href="/customers/{{ $user->id }}" class="text-muted">{{ $user->name }}</a>
                </td>
                <td>
                  {{ $user->email }}
                </td>
                <td>
                  {{ $user->phone }}
                </td>
                <td>
                  {{ $user->address }}
                </td>
                <td>
                  {{ $user->created_at->format('d/m/Y') }}
                </td>
                <td>
                  {{ $user->updated_at->format('d/m/Y') }}
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>
<script>
a = 0;

function deleteSucursal(){
  if (a > 0) {
    var div = document.getElementById('sucursal'+a);
    document.getElementById('sucursales').removeChild(div);
    a--;
  }
}

function addSucursal(){
  a++;
  var div = document.createElement('div');
  div.setAttribute('id', 'sucursal'+a);
  div.innerHTML = '<input style="margin-bottom:10px;" class="form-control" placeholder="..." name="sucursales[]" type="text"/>';
  document.getElementById('sucursales').appendChild(div);document.getElementById('sucursales').appendChild(div);
}
</script>
@endsection
