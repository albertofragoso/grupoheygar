@extends('layouts.app')

@section('content')
<section>
  <div class="container-fluid">
    <ul class="breadcrumb">
      <li class="breadcrumb-item active">@if (Auth::user()->roll)<a href="/admin">Home</a>@else Home @endif</li>
      <li class="breadcrumb-item active">@if (Auth::user()->roll)<a href="/products">Trabajos</a>@else Trabajos @endif</li>
      <li class="breadcrumb-item active">{{ $product->name }}</li>
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
    <!-- End errors-->
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
      <div class="card-header">
        <h4>{{ $product->name }}</h4>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-lg-12 text-center">
            <section class="statistics">
            <div class="card user-activity" style="margin-top:20px;margin-bottom:70px">
              @if ($product->stage)
                <h2 class="display h4">Etapa: {{ $product->stage }}</h2>
              @endif
              <div class="number"><strong>{{ $product->percentage }}%</strong></div>
              <p>Porcentage de avance</p>
              <div class="progress">
                <div role="progressbar" style="width: {{ $product->percentage }}%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" class="progress-bar progress-bar bg-primary"></div>
              </div>
            </div>
          </section>
          </div>
        </div>
        @if (Auth::user()->roll)
          <div class="row">
            <div class="col-lg-1 col-sm-12">
              <div class="form-group">
                <label>Folio</label>
                <p>A000{{ $product->id }}</p>
              </div>
            </div>
            <div class="col-lg-2 col-sm-12">
              <div class="form-group">
                <label>Cliente</label>
                <p><a href="/customers/{{ $product->user->id }}" class="text-muted">{{ $product->user->name }}
                  @if ($product->sucursal)
                    — {{ $product->sucursal->name }}
                  @endif
                </a></p>
              </div>
            </div>
            <div class="col-lg-2 col-sm-12">
              <div class="form-group">
                <label>Fecha de inicio</label>
                <p>{{ $product->created_at->format('d/m/Y') }}</p>
              </div>
            </div>
            <div class="col-lg-2 col-sm-12 col-sm-12">
              <div class="form-group">
                <label>Última actualización</label>
                <p>{{ $product->updated_at->format('d/m/Y') }}</p>
              </div>
            </div>
            <div class="col-lg-2 col-sm-12">
              <div class="form-group">
                <label>Modificado por: </label>
                <p>{{ $product->modify_by }}</p>
              </div>
            </div>
            <div class="col-lg-2 col-sm-12">
              <div class="form-group">
                <label>Fecha de entrega</label>
                <p>{{ date('d/m/Y', strtotime($product->finished_at)) }}</p>
              </div>
            </div>
            <div class="col-lg-1 col-sm-12">
              <div class="form-group">
                <label>Facturado </label>
                @if ($product->bill)
                  <p>Sí</p>
                @else
                  <p>No</p>
                @endif
              </div>
            </div>
          </div>
        @else
          <div class="row">
            <div class="col-lg-3 col-sm-12">
              <div class="form-group">
                <label>Cliente</label>
                <p><a href="/customers/{{ $product->user->id }}" class="text-muted">{{ $product->user->name }}</a></p>
              </div>
            </div>
            <div class="col-lg-3 col-sm-12">
              <div class="form-group">
                <label>Fecha de inicio</label>
                <p>{{ $product->created_at->format('d/m/Y') }}</p>
              </div>
            </div>
            <div class="col-lg-3 col-sm-12">
              <div class="form-group">
                <label>Última actualización</label>
                <p>{{ $product->updated_at->format('d/m/Y') }}</p>
              </div>
            </div>
            <div class="col-lg-3 col-sm-12">
              <div class="form-group">
                <label>Fecha de entrega</label>
                <p>{{ $product->finished_at }}</p>
              </div>
            </div>
          </div>
        @endif
        <br>
        @if (Auth::user()->roll)
          <div class="row">
            <div class="col-12 text-center">
              <div class="form-group">
                <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-primary">Actualizar </button>
                <!-- Modal-->
                <div id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                  <form action="/products/{{ $product->id }}/update" method="post">
                    {{ csrf_field() }}
                    <div role="document" class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 id="exampleModalLabel" class="modal-title">Actualizar</h5>
                          <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body">
                          <p>{{ $product->name }}.</p>
                            <div class="form-group">
                              <label>Porcentaje de avance</label>
                              <input type="number" id="percentage" name="percentage" value="{{ $product->percentage }}" class="form-control" min="1" max="100" onchange="checkPercentage()">
                            </div>
                            <div class="form-group">
                              <label>Etapa</label>
                              <input type="text" name="stage" placeholder="..." value="{{ $product->etapa }}" class="form-control">
                            </div>
                            <div class="form-group">
                              <label>Comentarios</label>
                              <input type="text" name="message" placeholder="..." class="form-control form-control-lg">
                            </div>
                            <div class="form-group">
                              <div class="i-checks">
                                <input id="checkboxCustom1" name="bill" type="checkbox" class="form-control-custom" value="1" {{ $product->bill ? "checked='checked'" : "" }} disabled>
                                <label for="checkboxCustom1">Facturación</label>
                              </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-primary">Actualizar</button>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
                <button type="button" data-toggle="modal" data-target="#myModal2" class="btn btn-primary">Mensajear </button>
                <!-- Modal-->
                <div id="myModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                  <form action="/products/{{ $product->id }}/coment" method="post">
                    {{ csrf_field() }}
                    <div role="document" class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 id="exampleModalLabel" class="modal-title">Nuevo mensaje</h5>
                          <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body">
                          <p>{{ $product->name }}.</p>
                            <div class="form-group">
                              <input type="text" name="message" placeholder="..." class="form-control form-control-lg" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-primary">Enviar</button>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        @endif
        @if (!Auth::user()->roll)
          <div class="">
            <form action="/products/{{ $product->id }}/message" method="post">
              {{ csrf_field() }}
              <div class="form-group">
                <div class="col-12">
                  <div class="form-group">
                    <input type="text" name="message" placeholder="¿Tienes observaciones? Dejanos un comentario." class="form-control form-control-lg {{ $errors->has('message') ? ' is-invalid' : '' }}" value="{{ old('message') }}" required>
                    @if ($errors->has('message'))
                      <div class="invalid-feedback">{{ $errors->first('message') }}</div>
                    @endif
                    <br>
                    <button type="submit" class="btn btn-primary">Comentar</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        @endif
        <!--<responses :product="{{ $product->id }}"></responses>-->
        <div id="new-updates" class="card updates recent-updated">
          <div id="updates-header" class="card-header d-flex justify-content-between align-items-center">
            <h2 class="h5 display"><a data-toggle="collapse" data-parent="#new-updates" href="#updates-box" aria-expanded="true" aria-controls="updates-box" class="">Comentarios</a></h2><a data-toggle="collapse" data-parent="#new-updates" href="#updates-box" aria-expanded="true" aria-controls="updates-box" class=""><i class="icon-ios-email-outline"></i></a>
          </div>
          <div id="updates-box" role="tabpanel" class="collapse" style="">
            <ul class="news list-unstyled">
              @forelse ($product->responses as $response)
              <li class="d-flex justify-content-between">
                <div class="left-col d-flex">
                  <div class="icon"><i class="icon-rss-feed"></i></div>
                  <div class="title"><strong>{{ $response->message }}</strong>
                    <p>{{ $response->user->name }}</p>
                  </div>
                </div>
                <div class="right-col text-right">
                  <div class="update-date">{{ $response->created_at->format('d') }}<span class="month">{{ $response->created_at->format('M') }}</span></div>
                </div>
              </li>
              @empty
              <li>Todavía no hay observaciones de este trabajo</li>
              @endforelse
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script>
checkPercentage();
function checkPercentage(){
  var percentage = document.getElementById('percentage');
  if (percentage.value === '100') {
    document.getElementById("checkboxCustom1").disabled = false;
  } else {
    document.getElementById("checkboxCustom1").disabled = true;
  }
}
</script>
@if (Auth::user()->roll)
  <script>$(function(){
    @foreach($product->messages as $message)
      Messenger.options={extraClasses:"messenger-fixed messenger-on-top  messenger-on-right",theme:"flat",messageDefaults:{showCloseButton:!0}},Messenger().post({message:"{{$message->user->name}} dijo:<br>{{$message->message}}<br><small>{{$message->created_at->format('d/m/Y')}}</small>",type:"success"})
    @endforeach
  });</script>
@endif
@endsection
