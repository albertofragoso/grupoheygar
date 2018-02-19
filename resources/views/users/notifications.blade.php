@extends('layouts.app')

@section('content')
<section>

<div class="container-fluid">
  <ul class="breadcrumb">
    <li class="breadcrumb-item"><a href="/admin">Home</a></li>
    <li class="breadcrumb-item active">Notificaciones</li>
  </ul>
  <div class="card">
    <div class="card-header">
      <h4>Notificaciones</h4>
    </div>
    <div class="card-body">
      <div class="col-12">
        <div class="card updates recent-updated">
          <ul class="news list-unstyled">
            @forelse ($notifications as $notification)
            <li class="d-flex justify-content-between">
              <div class="left-col d-flex">
                  <div class="icon"><i class="icon-rss-feed"></i></div>
                  <a href='/products/{{ $notification->data["product"]["id"] }}'>
                    <div class="title"><span>Se actualizó:</span><strong>{{ $notification->data["product"]["name"] }}</strong><span>{{ $notification->data["user"]["name"] }}</span></div>--
                    <!--Agregar si tiene o no sucursal-->
                  </a>
              </div>
              <div class="right-col text-right">
                <div class="update-date">{{ $notification->created_at->format('d') }}<span class="month">{{ $notification->created_at->format('M') }}</span></div>
              </div>
            </li>
            @empty
              <li>Aún no tienes notificaciones.</li>
            @endforelse
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
</section>
@endsection
