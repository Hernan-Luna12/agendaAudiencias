$(document).ready(function() {
    $('#section-title').text('Administración de Categorías de Permisos');

    cargarCategoriasPermiso();
});

function cargarCategoriasPermiso() {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: 'categoriaspermiso/tabla',
        type: 'POST'
    }).done(function(response) {
        $('#tabla-categoriaspermiso').html(response);
    }).fail(function(response) {
        console.log(response);
    });
}

// Modal create
$('#createModal').on('shown.bs.modal', function () {
    $('#c_category').focus();
});

$('#btnstore').click(function(event) {
    event.preventDefault();
    var validate = validaFormulario();
    if (validate) {
        storeCategoriaPermiso();
    }
});

function storeCategoriaPermiso() {
    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: 'categoriaspermiso/store',
        type: 'POST',
        data: $('#form-create-categoriapermiso').serialize()
    }).done(function(response) {
        switch (response.idnotificacion) {
            case 1:
                $('.modal').modal('hide');
                alertSuccess(response.mensaje);
                cargarCategoriasPermiso();
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
    $('#e_category').focus();
});

$('#btnupdate').click(function(event) {
    event.preventDefault();
    var validate = validaFormulario();
    if (validate) {
        updateCategoriaPermiso();
    }
});

function updateCategoriaPermiso() {
    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url: 'categoriaspermiso/update',
        type: 'POST',
        data: $('#form-edit-categoriapermiso').serialize()
    }).done(function(response) {
        switch (response.idnotificacion) {
            case 1:
                $('.modal').modal('hide');
                alertSuccess(response.mensaje);
                cargarCategoriasPermiso();
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
