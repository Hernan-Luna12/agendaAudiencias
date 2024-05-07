<div class="d-flex row">
    <h3 class="fw-bolder py-1">Agregar Usuario</h3>
    <form id="form-edit-usuario">
        <div class="row">
            <input type="hidden" name="id" value="{{ $usuario->id }}">
            <div class="col-lg-2 col-md-2 col-sm-12 mb-2">
                <div class="form-group">
                    <label for="e_primerapellido">Rol</label>
                    <select name="e_rol" id="e_rol" class="form-select">
                        <option value="" disabled selected>Seleccione</option>
                        @foreach ($roles_persona as $rol)
                            <option value="{{ $rol->id }}" {{ $usuario->persona->id_rol_persona == $rol->id ? 'selected':'' }}>
                                {{ $rol->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 mb-2">
                <div class="form-group">
                    <label for="e_nombre">Nombre(s)</label>
                    <input type="text" name="e_nombre" id="e_nombre" class="form-control text-uppercase" placeholder="Nombre(s)" value="{{ $usuario->persona->nombre }}">
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 mb-2">
                <div class="form-group">
                    <label for="e_primerapellido">Primer Apellido</label>
                    <input type="text" name="e_primerapellido" id="e_primerapellido" class="form-control text-uppercase" placeholder="Primer apellido"
                        value="{{ $usuario->persona->primerapellido }}">
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 mb-2">
                <div class="form-group">
                    <label for="e_segundoapellido">Segundo Apellido</label>
                    <input type="text" name="e_segundoapellido" id="e_segundoapellido" class="form-control text-uppercase" placeholder="Segundo apellido"
                        value="{{ $usuario->persona->segundoapellido }}">
                </div>
            </div>
            <div class="col-lg-5 col-md-5 col-sm-12 mb-2">
                <div class="form-group">
                    <label for="e_distrito">Adscripción actual</label>
                    <select name="e_distrito" id="e_distrito" class="form-select">
                        <option value="" disabled selected>Seleccione un distrito</option>
                        @foreach ($distritos as $distrito)
                            <option value="{{ $distrito->id }}" 
                                {{ ($usuario->id_centro_trabajo) != null && ($usuario->ctg_centro_trabajo->id_distrito == $distrito->id) ? 'selected':'' }}>
                                {{ $distrito->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-7 col-md-7 col-sm-12 mb-2">
                <div class="form-group">
                    <label for="">&nbsp;</label>
                    <select name="e_centro_trabajo" id="e_centro_trabajo" class="form-select">
                        <option value="" disabled selected>Seleccione una opción</option>
                        @foreach ($centros_trabajo as $centrotrabajo)
                            <option value="{{ $centrotrabajo->id }}" {{ $usuario->id_centro_trabajo == $centrotrabajo->id ? 'selected':'' }}>
                                {{ $centrotrabajo->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 mb-sm-2">
                <div class="form-group">
                    <label for="e_perfil">Perfil</label>
                    <select name="e_perfil" id="e_perfil" class="form-select">
                        <option value="" disabled selected>Seleccione un perfil</option>
                        @foreach ($roles as $rol)
                            <option value="{{ $rol->id }}" {{ $userrole == $rol->id ? 'selected':'' }}>
                                {{ $rol->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    $(document).ready(function () {
        var select2_distrito = $('#e_distrito');

        select2_distrito.each(function () {
            var $this = $(this);
            $this.wrap('<div class="position-relative"></div>');
            $this.select2({
                // the following code is used to disable x-scrollbar when click in select input and
                // take 100% width in responsive also
                dropdownAutoWidth: true,
                width: '100%',
                placeholder: 'Seleccione una opción',
                dropdownParent: $this.parent()
            });
        });

        var select2_centro_trabajo = $('#e_centro_trabajo');

        select2_centro_trabajo.each(function () {
            var $this = $(this);
            $this.wrap('<div class="position-relative"></div>');
            $this.select2({
                // the following code is used to disable x-scrollbar when click in select input and
                // take 100% width in responsive also
                dropdownAutoWidth: true,
                width: '100%',
                placeholder: 'Seleccione una opción',
                dropdownParent: $this.parent()
            });
        });
    });
    
    $('#e_distrito').on('change', function() {
        var distrito_id = $(this).val();
        if(distrito_id) {
            $.ajax({
                url: "{{ route('get-centros-trabajo', ':distrito_id') }}".replace(':distrito_id', distrito_id),
                type: "GET",
                success:function(data) {
                    $('#e_centro_trabajo').empty();
                    $('#e_centro_trabajo').append('<option value="">Seleccione una opción</option>');
                    $.each(data, function(key, value) {
                        $('#e_centro_trabajo').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                    });

                    var select2_ct = $('#e_centro_trabajo');

                    select2_ct.each(function () {
                        var $this = $(this);
                        $this.wrap('<div class="position-relative"></div>');
                        $this.select2({
                            // the following code is used to disable x-scrollbar when click in select input and
                            // take 100% width in responsive also
                            dropdownAutoWidth: true,
                            width: '100%',
                            placeholder: 'Seleccione una opción',
                            dropdownParent: $this.parent()
                        });
                    });
                }
            });
        } else {
            $('#e_centro_trabajo').empty();
        }
    });
</script>