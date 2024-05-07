<div class="d-flex row">
    <h3 class="fw-bolder py-1">Agregar Usuario</h3>
    <form id="form-create-usuario">
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-12 mb-2">
                <div class="form-group">
                    <label for="c_primerapellido">Rol</label>
                    <select name="c_rol" id="c_rol" class="form-select">
                        <option value="" disabled selected>Seleccione</option>
                        @foreach ($roles_persona as $rol)
                            <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 mb-2">
                <div class="form-group">
                    <label for="c_nombre">Nombre(s)</label>
                    <input type="text" name="c_nombre" id="c_nombre" class="form-control text-uppercase" placeholder="Nombre(s)">
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 mb-2">
                <div class="form-group">
                    <label for="c_primerapellido">Primer Apellido</label>
                    <input type="text" name="c_primerapellido" id="c_primerapellido" class="form-control text-uppercase" placeholder="Primer apellido">
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 mb-2">
                <div class="form-group">
                    <label for="c_segundoapellido">Segundo Apellido</label>
                    <input type="text" name="c_segundoapellido" id="c_segundoapellido" class="form-control text-uppercase" placeholder="Segundo apellido">
                </div>
            </div>
            <div class="col-lg-5 col-md-5 col-sm-12 mb-2">
                <div class="form-group">
                    <label for="c_distrito">Adscripción actual</label>
                    <select name="c_distrito" id="c_distrito" class="form-select">
                        <option value="" disabled selected>Seleccione un distrito</option>
                        @foreach ($distritos as $distrito)
                            <option value="{{ $distrito->id }}">{{ $distrito->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-7 col-md-7 col-sm-12 mb-2">
                <div class="form-group">
                    <label for="">&nbsp;</label>
                    <select name="c_centro_trabajo" id="c_centro_trabajo" class="form-select select2">
                        <option value="" disabled selected>Seleccione un distrito</option>
                        @foreach ($centros_trabajo as $centrotrabajo)
                            <option value="{{ $centrotrabajo->id }}">{{ $centrotrabajo->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 mb-sm-2">
                <div class="form-group">
                    <label for="c_username">Usuario</label>
                    <input type="text" name="c_username" id="c_username" class="form-control text-uppercase" placeholder="Usuario">
                    <div id="invalid-f" class="invalid-feedback"></div>
                    <div id="valid-f" class="valid-feedback"></div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 mb-sm-2">
                <div class="form-group">
                    <label for="c_perfil">Perfil</label>
                    <select name="c_perfil" id="c_perfil" class="form-select">
                        <option value="" disabled selected>Seleccione un perfil</option>
                        @foreach ($roles as $rol)
                            <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 mb-sm-2" style="display: none;" id="encargados">
                <div class="form-group">
                    <label for="c_encargado">Encargado asignado</label>
                    <select name="c_encargado" id="c_encargado" class="form-select" data-actino="no">
                        <option value="" disabled selected>Seleccione</option>
                    </select>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    $(document).ready(function () {
        var select2_distrito = $('#c_distrito');

        select2_distrito.each(function () {
            var $this = $(this);
            $this.wrap('<div class="position-relative"></div>');
            $this.select2({
                // the following code is used to disable x-scrollbar when click in select input and
                // take 100% width in responsive also
                dropdownAutoWidth: true,
                width: '100%',
                placeholder: 'Seleccione un distrito',
                dropdownParent: $this.parent()
            });
        });
    });

    function createUsername()  {
		var value = $('#c_nombre').val();
		var separa = value.split(' ');
		if (separa.length == 1) {
			var nombre = value.substring(0,1).toLowerCase();
			//console.log(separa.length);
		} else {
			var n1 = separa[0].substring(0,1).toLowerCase();
			var n2 = separa[1].substring(0,1).toLowerCase();
			//console.log(separa.length);
			var nombre = n1 + n2;
		}

		var primerapellido = $('#c_primerapellido').val().toLowerCase();
		apellido = primerapellido.split(' ');
		apellido = apellido.join('');

		var username = nombre + apellido;
		$('#c_username').val(username);
	}

	$('#c_nombre').on('keyup', createUsername);
	$('#c_primerapellido').on('focusout', createUsername);
    $('#c_username').on('focusout', checkUsername);

    function checkUsername() {
        var username = $('#c_username').val();
        if(username != '') {
            $.ajax({
                url: "{{ route('check-username', ':username') }}".replace(':username', username),
                type: "GET",
                success:function(data) {
                    switch (data.notificacion) {
                        case 1:
                            $('#c_username').removeClass('is-invalid');
                            $('#c_username').addClass('is-valid');
                            $('#valid-f').text(data.mensaje);
                            $('#valid-f').show();
                            $('#invalid-f').hide();
                            break;
                        case 2:
                            $('#c_username').removeClass('is-valid');
                            $('#c_username').addClass('is-invalid');
                            $('#invalid-f').text(data.mensaje);
                            $('#invalid-f').show();
                            $('#valid-f').hide();
                            break;
                        default:
                            $('#c_username').removeClass('is-valid');
                            $('#c_username').addClass('is-invalid');
                            break;
                    }
                },
                fail:function(data) {
                    console.log(data);
                }
            });
        }
    }
    
    $('#c_distrito').on('change', function() {
        var distrito_id = $(this).val();
        if(distrito_id) {
            $.ajax({
                url: "{{ route('get-centros-trabajo', ':distrito_id') }}".replace(':distrito_id', distrito_id),
                type: "GET",
                success:function(data) {
                    $('#c_centro_trabajo').empty();
                    $('#c_centro_trabajo').append('<option value="">Seleccione una opción</option>');
                    $.each(data, function(key, value) {
                        $('#c_centro_trabajo').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                    });

                    var select2_ct = $('#c_centro_trabajo');

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
            $('#c_centro_trabajo').empty();
        }
    });
</script>