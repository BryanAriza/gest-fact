<div wire:ignore.self class="modal fade" id="theModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" style="max-width: 500px;" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #cb8a0d;">
        <h5 class="modal-title text-white">
          <b>GEST-FACT | VENTA REALIZADA</b>
        </h5>
        <h6 class="text-center text-warning" wire:loading>POR FAVOR ESPERE</h6>
      </div>
      <div class="modal-body">

        <div class="form-group">
          <label><strong>Fecha de Venta</strong></label>
          <p>{{ $date_sale ?? 'N/A' }}</p>
        </div>

        <div class="form-group">
          <label><strong>Nombre Cliente</strong></label>
          <p>{{ $customer_name ?? 'N/A' }}</p>
        </div>
        <div class="form-group">
          <label><strong>Documento Cliente</strong></label>
          <p>{{ $name_document }} - {{ $document ?? 'N/A' }}</p>
        </div>

        <div class="form-group">
          <label><strong>Usuario quien realizo venta</strong></label>
          <p>{{ $user_name ?? 'N/A' }}</p>
        </div>

        <div class="form-group">
          <label><strong>Detalle de Productos</strong></label>
          @foreach ($result as $item)
          <div class="border p-2 mb-3">
            <p><strong>Producto:</strong> {{ $item->product_name ?? 'N/A' }}</p>
            <p><strong>Cantidad:</strong> {{ $item->cant_product ?? '0' }}</p>
            <p><strong>Precio Unitario:</strong> ${{ number_format($item->unit_price, 2) ?? '0.00' }}</p>
            <p><strong>Total:</strong> ${{ number_format($item->cant_product * $item->unit_price, 2) ?? '0.00' }}</p>
          </div>
          @endforeach
        </div>

        <div class="form-group">
          <label><strong>Total Compra: </strong></label>
          <p>
            ${{ number_format($total_sale, 2) ?? '0.00' }}
          </p>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-dark close-btn text-info" style="color:#fff !important;" data-dismiss="modal">CERRAR</button>

        <a href="{{ url('/download-invoice/' . $document . '/' . $date_sale . '/' . $id_header) }}"
           class="btn btn-success" 
           target="_blank" 
           download>
          DESCARGAR COMPROBANTE
        </a>
      </div>
    </div>
  </div>
</div>
