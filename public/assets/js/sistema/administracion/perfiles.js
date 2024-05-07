$(document).ready(function() {
    $('#section-title').text('Administración de Perfiles');

    cargarPerfiles();
});

function cargarPerfiles() {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: 'perfiles/tabla',
        type: 'POST'
    }).done(function(response) {
        $('#tabla-perfiles').html(response);
    }).fail(function(response) {
        console.log(response);
    });
}

// Modal create
$('#createModalLg').on('shown.bs.modal', function () {
    $('#c_perfil').focus();
});

$('#btnstorelg').click(function(event) {
    event.preventDefault();
    var validate = validaFormulario();
    if (validate) {
        storePerfil();
    }
});

function storePerfil() {
    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: 'perfiles/store',
        type: 'POST',
        data: $('#form-create-perfil').serialize()
    }).done(function(response) {
        switch (response.idnotificacion) {
            case 1:
                $('.modal').modal('hide');
                alertSuccess(response.mensaje);
                cargarPerfiles();
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
    $('#e_perfil').focus();
});

$('#btnupdatelg').click(function(event) {
    event.preventDefault();
    var validate = validaFormulario();
    if (validate) {
        updatePerfil();
    }
});

function updatePerfil() {
    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: 'perfiles/update',
        type: 'POST',
        data: $('#form-edit-perfil').serialize()
    }).done(function(response) {
        switch (response.idnotificacion) {
            case 1:
                $('.modal').modal('hide');
                alertSuccess(response.mensaje);
                cargarPerfiles();
                break;
            case 2:
                $('.modal').modal('hide');
                alertWarning(response.mensaje);
                // cargarPerfiles();
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
