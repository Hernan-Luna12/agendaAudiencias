$(document).ready(function() {
    $('#section-title').text('Administración de Usuarios');

    cargarUsuarios();
});

function cargarUsuarios() {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: 'usuarios/tabla',
        type: 'POST'
    }).done(function(response) {
        $('#tabla-usuarios').html(response);
    }).fail(function(response) {
        console.log(response);
    });
}

// Modal create
$('#createModalLg').on('shown.bs.modal', function () {
    $('#c_rol').focus();
});

$('#btnstorelg').click(function(event) {
    event.preventDefault();
    var validate = validaFormulario();
    if (validate) {
        storeUsuario();
    }
});

function storeUsuario() {
    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: 'usuarios/store',
        type: 'POST',
        data: $('#form-create-usuario').serialize()
    }).done(function(response) {
        switch (response.idnotificacion) {
            case 1:
                $('.modal').modal('hide');
                alertSuccess(response.mensaje);
                cargarUsuarios();
                break;
            case 2:
                alertWarning(response.mensaje);
                break;
            default:
                alertError(response.mensaje);
                break;
        }
    }).fail(function(response) {
        alertError(response.responseJSON.message);
        console.log(response);
    });
}

// Modal edit
$('#editModalLg').on('shown.bs.modal', function () {
    $('#e_rol').focus();
});

$('#btnupdatelg').click(function(event) {
    event.preventDefault();
    var validate = validaFormulario();
    if (validate) {
        updateUsuario();
    }
});

function updateUsuario() {
    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: 'usuarios/update',
        type: 'POST',
        data: $('#form-edit-usuario').serialize()
    }).done(function(response) {
        switch (response.idnotificacion) {
            case 1:
                $('.modal').modal('hide');
                alertSuccess(response.mensaje);
                cargarUsuarios();
                break;
            case 2:
                $('.modal').modal('hide');
                alertWarning(response.mensaje);
                // cargarUsuarios();
                break;
            default:
                alertError(response.mensaje);
                console.log(response.errors);
                break;
        }
    }).fail(function(response) {
        alertError(response.responseJSON.message);
        console.log(response);
    });
}
