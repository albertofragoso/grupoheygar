@extends('layouts.app')

@section('content')
<section>
  <div class="container-fluid">
    <ul class="breadcrumb">
      <li class="breadcrumb-item active">@if (Auth::user()->roll)<a href="/admin">Home</a>@else Home @endif</li>
      <li class="breadcrumb-item active">@if (Auth::user()->roll)<a href="/customers">Customers</a>@else Customers @endif</li>
      <li class="breadcrumb-item active">{{ $user->name }}</li>
    </ul>
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
        <h4>Cliente</h4>
        <!--Modify user-->
        <div class="form-group" style="margin-bottom:50px;">
          @if (Auth::user()->roll)
            <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-sm btn-primary">Modificar </button>
            <!-- Modal-->
              <div id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                <div role="document" class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 id="exampleModalLabel" class="modal-title">Cliente</h5>
                      <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                    </div>
                    <form action="/customers/{{ $user->id }}/update" method="post">
                      {{ csrf_field() }}
                      <div class="modal-body">
                        <p>Lorem ipsum dolor sit amet consectetur.</p>
                          <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                          </div>
                          <div class="form-group">
                            <label>Sucursal</label>
                          </div>
                          <div class="form-group" id="sucursales">
                            @forelse($user->sucursales as $key=>$sucursal)
                              @if(!$key)
                                <div class="input-group" id="sucursal{{$key}}">
                                  <div class="input-group">
                                    <div class="input-group-append">
                                      <button type="button" class="btn btn-primary"   onClick="deleteSucursal({{ $key }})">-</button>
                                    </div>
                                    <input type="text" class="form-control" name="sucursales[]" value="{{ $sucursal->name }}">
                                    <div class="input-group-append">
                                      <button type="button" class="btn btn-primary" onClick="addSucursal()">+</button>
                                    </div>
                                  </div>
                                </div>
                              @else
                                <div class="input-group" id="sucursal{{$key}}">
                                  <div class="input-group-append">
                                    <button type="button" class="btn btn-primary" onClick="deleteSucursal({{ $key }})">-</button>
                                  </div>
                                  <input style="margin-bottom:10px;margin-top:10px;" class="form-control" name="sucursales[]" type="text" value="{{ $sucursal->name }}"/>
                                </div>
                              @endif
                            @empty
                              <div class="input-group">
                                <div class="input-group-append">
                                  <button type="button" class="btn btn-primary" onClick="deleteeSucursal()">-</button>
                                </div>
                                <input type="text" class="form-control" placeholder="..." name="sucursales[]">
                                <div class="input-group-append">
                                  <button type="button" class="btn btn-primary" onClick="adddSucursal()">+</button>
                                </div>
                              </div>
                            @endforelse
                          </div>
                          <div class="form-group">
                            <label>Dirección</label>
                            <input type="text" name="address" class="form-control" value="{{ $user->address }}">
                          </div>
                          <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" value="{{ $user->email }}">
                          </div>
                          <div class="form-group">
                            <label>Teléfono</label>
                            <input type="phone" name="phone" class="form-control" value="{{ $user->phone }}">
                          </div>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            @endif
          </div>
          <!--Fin modify user-->
      </div>
      <section class="statistics">
        <div class="container-fluid">
          <div class="card-body user-activity">
            <div style="display:flex;justify-content:flex-start;margin-bottom:10px">
              <div class="feed-profile" style="margin-right:10px">
                <img src="{{ $user->image }}" alt="person" class="img-fluid rounded-circle" width="40" height="40">
              </div>
              <h2 class="display h4">{{ $user->name }}</h2>
            </div>
            <p>{{ $user->email }}</p>
            <div class="number">{{ count($user->products) }}</div>
            <h3 class="h4 display">Trabajos solicitados</h3>
            <!--<div class="progress">
              <div role="progressbar" style="width: 80%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar bg-primary"></div>
            </div>-->
            <div class="page-statistics d-flex justify-content-between">
              <div class="page-statistics-left"><span>Inicio de operaciones</span><strong>{{ $user->created_at->format('d/m/Y') }}</strong></div>
              <!--<div class="page-statistics-center"><span>Actualización de operaciones</span><strong>{{ $user->updated_at->format('d/m/Y') }}</strong></div>-->
              <div class="page-statistics-right"><span>Ultimo pedido</span><strong>{{ $user->updated_at->format('d/m/Y') }}</strong></div>
            </div>
          </div>
        </div>
        <!--Table-->
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Porcentaje</th>
                  <th>Inicio</th>
                  <th>Actualización</th>
                  <th>Entrega</th>
                </tr>
              </thead>
              <tbody>
                @foreach($user->products as $product)
                <tr>
                  <td>
                    <a href="/products/{{ $product->id }}" class="text-muted">
                      {{ $product->name }}
                      @if ($product->sucursal)
                       — {{ $product->sucursal->name }}
                      @endif
                    </a>
                  </td>
                  <td>
                    {{ $product->percentage }}%
                  </td>
                  <td>
                    {{ $product->created_at->format('d/m/Y') }}
                  </td>
                  <td>
                    {{ $product->updated_at->format('d/m/Y') }}
                  </td>
                  <td>
                    {{ $product->finished_at }}
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
    </section>
      <!--Ends client's products-->
    </div>
  </div>
</section>
<script>
a = {{ count($user->sucursales) - 1 }};
b = 0;

function deleteSucursal(key){
  var div = document.getElementById('sucursal'+key);
  document.getElementById('sucursales').removeChild(div);
}

function addSucursal(){
  a++;
  var div = document.createElement('div');
  div.setAttribute('id', 'sucursal'+a);
  div.setAttribute('class', 'input-group');
  div.innerHTML = '<div class="input-group-append"><button type="button" class="btn btn-primary" onClick="deleteSucursal('+a+')">-</button></div><input style="margin-bottom:10px; margin-top:10px;" class="form-control" placeholder="..." name="sucursales[]" type="text"/>';
  document.getElementById('sucursales').appendChild(div);document.getElementById('sucursales').appendChild(div);
}

function deleteeSucursal() {
  if (b > 0) {
    var div = document.getElementById('sucursal'+b);
    document.getElementById('sucursales').removeChild(div);
    b--;
  }
}

function adddSucursal() {
  b++;
  var div = document.createElement('div');
  div.setAttribute('id', 'sucursal'+b);
  div.innerHTML = '<input style="margin-bottom:10px;margin-top:10px;" class="form-control" placeholder="..." name="sucursales[]" type="text"/>';
  document.getElementById('sucursales').appendChild(div);document.getElementById('sucursales').appendChild(div);
}
</script>

@endsection
