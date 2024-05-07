<div class="d-flex row">
    <h3 class="fw-bolder py-1">Editar Permiso</h3>
    <form id="form-edit-permiso">
        <input type="hidden" name="id" value="{{ $permission->id }}">
        <div class="row">
            <div class="col-12 mb-1">
                <div class="form-group">
                    <label for="e_permission">Nombre del permiso</label>
                    <input type="text" name="e_permission" id="e_permission" class="form-control" value="{{ $permission->name }}">
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label for="e_category">Categoría del permiso</label>
                    <select class="form-select" name="e_category" id="e_category">
                        <option value="" disabled>Seleccione una opción</option>
                        @foreach ($categoriaspermisos as $category)
                            <option value="{{ $category->id }}" {{ $permission->category_id == $category->id ? 'selected':'' }}>
                                {{ $permission->category_permission->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </form>
</div>
