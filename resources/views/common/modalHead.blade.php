<div wire:ignore.self class="modal fade" id="theModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #cb8a0d;">
        <h5 class="modal-title text-white">
        	<b>{{$componentName}} | {{ $selected_id > 0 ? 'EDITAR' : 'CREAR' }}</b>
        </h5>
        <h6 class="text-center text-warning" wire:loading>POR FAVOR ESPERE</h6>
      </div>
      <div class="modal-body">


        