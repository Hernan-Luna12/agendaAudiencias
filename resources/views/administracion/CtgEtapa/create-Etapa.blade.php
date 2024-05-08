<div class="text-center mb-2">
    <h1 class="mb-1 modal-title" id="createModalLabel">Agregar Etapa</h1>
</div>

<input type="hidden" value="{{ url('/') }}" id="url">
<form class="modal-form row gy-1 pt-75 needs-validation modal-lg-custom" novalidate id="form-createetapa"
    action="/save-etapa" method="POST">

    <div class="col-12 col-md-12">
        <label class="no-mr-btm" for="etapa">Nombre Etapa</label>
        <input type="text" class="form-control" id="etapa" name="etapa" placeholder="Etapa">
    </div>
</form>
