$(document).ready(function() {
    $('#section-title').text('Administración de Permisos');

    cargarPermisos();
});

function cargarPermisos() {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: 'permisos/tabla',
        type: 'POST'
    }).done(function(response) {
        $('#tabla-permisos').html(response);
    }).fail(function(response) {
        console.log(response);
    });
}

// Modal create
$('#createModal').on('shown.bs.modal', function () {
    $('#c_permission').focus();
});

$('#btnstore').click(function(event) {
    event.preventDefault();
    var validate = validaFormulario();
    if (validate) {
        storePermiso();
    }
});

function storePermiso() {
    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: 'permisos/store',
        type: 'POST',
        data: $('#form-create-permiso').serialize()
    }).done(function(response) {
        switch (response.idnotificacion) {
            case 1:
                $('.modal').modal('hide');
                alertSuccess(response.mensaje);
                cargarPermisos();
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
$('#editModal').on('shown.bs.modal', function () {
    $('#e_permission').focus();
});

$('#btnupdate').click(function(event) {
    event.preventDefault();
    var validate = validaFormulario();
    if (validate) {
        updatePermiso();
    }
});

function updatePermiso() {
    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: 'permisos/update',
        type: 'POST',
        data: $('#form-edit-permiso').serialize()
    }).done(function(response) {
        switch (response.idnotificacion) {
            case 1:
                $('.modal').modal('hide');
                alertSuccess(response.mensaje);
                cargarPermisos();
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
