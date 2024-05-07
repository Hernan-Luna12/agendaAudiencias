<div class="d-flex row">
    <h3 class="fw-bolder py-1">Agregar Perfil</h3>
    <form id="form-create-perfil">
        <div class="row">
            <div class="col-12 mb-2">
                <div class="form-group">
                    <label for="c_perfil">Nombre del perfil</label>
                    <input type="text" name="c_perfil" id="c_perfil" class="form-control">
                </div>
            </div>

            <div class="col-12">
                <label for="">Permisos para el nuevo perfil</label>
                <div class="invalid-tooltip" id="invalidchecks">
                    Debe seleccionar al menos un permiso.
                </div>
                <div class="row">
                    @foreach ($categoriaspermiso as $categoriapermiso)
                        @if (count($categoriapermiso->permissions) > 0)
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                                <div class="card shadow-none border-secondary">
                                    <div class="card-header fw-bolder py-50 border border-botom bg-light">{{ $categoriapermiso->name }}</div>
                                    <ul class="list-group list-group-flush">
                                        @foreach ($categoriapermiso->permissions as $permission)
                                            <li class="list-group-item">
                                                <div class="d-flex justify-content-between">
                                                    <label class="form-check-label mb-50" for="permiso_{{ $permission->id }}">{{ $permission->name }}</label>
                                                    <div class="form-check form-switch form-check-success">
                                                        <input type="checkbox" class="form-check-input name" value="{{ $permission->id }}" 
                                                            name="permission[]" id="permiso_{{ $permission->id }}" />
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </form>
</div>
