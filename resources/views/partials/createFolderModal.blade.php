<!-- Modal -->
<div class="modal fade" id="createFolderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nova Pasta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="createFolderForm" action="{{ route('createFolder') }}" class="form-vertical" role="form" method="POST">
          {{ csrf_field()}}
          <input type="hidden" name="uriFolder" value="{{$_SERVER['REQUEST_URI']}}">
          <div class="form-group">
            <label for="nameFolder" class="control-label">Nome</label>
            <input id="nameFolder" class="form-control" type="text" name="nameFolder" value="" placeholder="Nome da pasta" required>
          </div>
          <div class="form-group">
            <label class="control-label">Privacidade</label>
            <div class="form-control">
              <div class="form-check form-check-inline">
                <label class="form-check-label">
                  <input id="privacityFolder" type="radio" name="privacityFolder" value="1" placeholder="Privada" checked> Privada
                </label>
              </div>
              <div class="form-check form-check-inline">
                <label class="form-check-label">
                  <input id="privacityFolder" type="radio" name="privacityFolder" value="2" placeholder="Pública"> Pública
                </label>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button id="createFolderSubmit" onclick="document.getElementById('createFolderForm').submit()" type="button" class="btn btn-primary">Criar Pasta</button>
      </div>
    </div>
  </div>
</div>