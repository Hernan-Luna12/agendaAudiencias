<div class="d-flex row">
    <h3 class="fw-bolder py-1">Agregar Permiso</h3>
    <form id="form-create-permiso">
        <div class="row">
            <div class="col-12 mb-1">
                <div class="form-group">
                    <label for="c_permission">Nombre del permiso</label>
                    <input type="text" name="c_permission" id="c_permission" class="form-control">
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label for="c_category">Categoría del permiso</label>
                    <select class="form-select" name="c_category" id="c_category">
                        <option value="" selected disabled>Seleccione una opción</option>
                        @foreach ($categoriaspermisos as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </form>
</div>
