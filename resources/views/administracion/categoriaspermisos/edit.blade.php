<div class="d-flex row">
    <h3 class="fw-bolder py-1">Editar Categoría de Permiso</h3>
    <form id="form-edit-categoriapermiso">
        <input type="hidden" name="id" value="{{ $categoriapermiso->id }}">
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label for="e_category">Nombre de la categoria</label>
                    <input type="text" name="e_category" id="e_category" class="form-control" value="{{ $categoriapermiso->name }}">
                </div>
            </div>
        </div>
    </form>
</div>
