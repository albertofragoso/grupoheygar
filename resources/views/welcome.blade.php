@extends('layouts.app')

@section('content')
<!-- Counts Section -->
<section class="dashboard-counts section-padding">
  <div class="container-fluid">
    <div class="row">
      <!-- Count item widget-->
      <div class="col-md-4 col-sm-12 col-6">
        <div class="wrapper count-title d-flex">
          <div class="icon"><i class="icon-user"></i></div>
          <div class="name"><strong class="text-uppercase">Clientes</strong><span>Último agregado hace 7 días</span>
            <div class="count-number">{{ $total_customers }}</div>
          </div>
        </div>
      </div>
      <!-- Count item widget-->
      <div class="col-xl-4 col-md-4 col-sm-12 col-6">
        <div class="wrapper count-title d-flex">
          <div class="icon"><i class="icon-padnote"></i></div>
          <div class="name"><strong class="text-uppercase">Trabajos</strong><span>Último hace 5 días</span>
            <div class="count-number">{{ $total_products }}</div>
          </div>
        </div>
      </div>
      <div class="col-xl-4 col-md-4 col-sm-12 col-6">
        <div class="wrapper count-title d-flex">
          <div class="icon"><i class="icon-check"></i></div>
          <div class="name"><strong class="text-uppercase">Administradores</strong><span>Last 2 months</span>
            <div class="count-number">{{ $total_admins }}</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Header Section-->
<section class="dashboard-header section-padding">
  <div class="container-fluid">
    <div class="row d-flex align-items-md-stretch">
      <!-- To Do List-->
      <div class="col-12 col-md-6">
        <div class="card to-do">
          <h2 class="display h4">Lista de trabajos pendientes</h2>
          <p>Trabajos próximos por entregar.</p>
          <ul class="check-lists list-unstyled">
            @forelse($products as $key=>$product)
              <li class="d-flex align-items-center">
                <input type="checkbox" id="list-{{ ++$key }}" name="list-{{ $key }}" class="form-control-custom">
                <label for="list-{{ $key }}"><a href="/products/{{ $product->id }}">{{ $product->name }}</a><span style="margin-left: 5px;!important">{{ $product->user->name }}
                @if ($product->sucursal)
                  — {{ $product->sucursal->name }}
                @endif
                </span></label>
                <!--Agregar si hay sucursal-->
              </li>
            @empty
              <li>Aún no hay trabajos por hacer.</li>
            @endforelse
          </ul>
        </div>
      </div>
      <!-- To Do List-->
      <div class="col-12 col-md-6">
        <div class="card to-do">
          <h2 class="display h4">Lista de últimos clientes</h2>
          <p>Últimos clientes agregados.</p>
          <ul class="check-lists list-unstyled">
            @forelse($customers as $key=>$customer)
            <li class="d-flex align-items-center">
              <input type="checkbox" id="list-{{ ++$key }}" name="list-{{ $key }}" class="form-control-custom">
              <label for="list-{{ $key }}"><a href="/customers/{{ $customer->id }}">{{ $customer->name }}</a></label>
            </li>
            @empty
              <li>Aún no hay clientes agregados.</li>
            @endforelse
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
