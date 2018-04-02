<!--Table-->
<div class="card-body">
  <div class="table-responsive">
    <table id="datatable1" style="width: 90%;" class="table">
      <thead>
        <tr>
          <th>Folio</th>
          <th>Nombre</th>
          <th>Cliente</th>
          <th>Porcentaje</th>
          <th>Etapa</th>
          <th>Facturado</th>
          <th>Inicio</th>
          <th>Actualización</th>
          <th>Entrega</th>
        </tr>
      </thead>
      <tbody>
        @foreach($products as $product)
        <tr>
          <td>
            A000{{ $product->id }}
          </td>
          <td>
            <a href="/products/{{ $product->id }}" class="text-muted">{{ $product->name }}</a>
          </td>
          <td>
            {{ $product->user->name }}
            @if ($product->sucursal)
              — {{ $product->sucursal->name }}
            @endif
          </td>
          <td>
            {{ $product->percentage }}%
          </td>
          <td>
            {{ $product->stage }}
          </td>
          <td>
            @if ($product->bill)
              Sí
            @else
              No
            @endif
          </td>
          <td>
            {{ $product->created_at->format('d/m/Y') }}
          </td>
          <td>
            {{ $product->updated_at->format('d/m/Y') }}
          </td>
          <td>
            {{ date('d/m/Y', strtotime($product->finished_at)) }}
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
<!--End table-->
