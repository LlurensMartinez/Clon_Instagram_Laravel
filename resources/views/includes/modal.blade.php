{{-- Recordad poner data-toggle="modal" data-target="#myModal" en la etiqueta a o button --}}

<!-- The Modal -->
  <div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">¿Estas seguro?</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          Si eliminas esta imagen nunca podras recuperarla, ¿Estas seguro de querer borrarla?
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button>
          <a href="{{ route('image.delete', ['id' => $image->id]) }}"><i class="fas fa-trash-alt"></i></a>
        </div>

      </div>
    </div>
  </div>
