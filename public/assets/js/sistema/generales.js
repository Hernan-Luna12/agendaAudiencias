$('#btnreturn').on('click', function(event) {
    event.preventDefault();
    /* Act on the event */
    window.history.go(-1);
});

function textOnly(event)
{
   var value = String.fromCharCode(event.which);
   var pattern = new RegExp(/^[a-zA-Z]+$/i);
   return pattern.test(value);
}

function noNumbers(event)
{
    if(event.charCode < 48 || event.charCode > 57)
        return true;
    return false
}

function numberOnly(event)
{
    var ASCIICode = (event.which) ? event.which : event.keyCode;
    if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
        return false;
    return true;
}

// solo llamar a la función en el js desde el blade.php
// agregar la clase al form dependiendo si es en modal (modal-form) o no (nomodal-form), para validar los campos
// si falta algún tipo de input agregarlo dentro del find()
// si no se quiere validar algún input agregar data-action="1", para que la función de validar lo excluya
function validaFormulario()
{
    /*console.log(elementos);*/
    var modal_form = $('.modal-form').is(':visible');
    if (modal_form) {
        var form = '.modal-form';
    } else {
        var form = '.nomodal-form';
    }
    $(form).find('input[type=text], input[type=number], input[type=date], input[type=email], select, textarea').each(function(index, el) {
        if ($(this).data('action') == undefined) {
            if ($(this).val() == '' || $(this).val() == null) {
                $(this).removeClass('is-valid');
                $(this).addClass('is-invalid');
            } else {
                $(this).removeClass('is-invalid');
                $(this).addClass('is-valid');
            }
        }
    });

    if ( $('form .is-invalid').length > 0 ) {
        // alertwarning('Faltan datos por capturar');
        return false;
    } else{
        return true;
    }
}

// se inicializa y cierra cualquier modal
// agregar data-title, al boton donde se agrega el data-remote, para asignarle el titulo al modal
// están contenidos en modals.blade.php
$('.modal').not('.modal-right').on('show.bs.modal', function (e) {
    var modal = $(this);
    if (modal.data('action') == undefined) {
        var button = $(e.relatedTarget);
        modal.find('.modal-body').load(button.data('remote'));
    }
});

$('.modal').not('.modal-right').on('hide.bs.modal', function (e) {
    var modal = $(this);
    if (modal.data('action') == undefined){
        modal.find('.modal-body').html('');
    }
});

function alertSuccess(mensaje = 'Alerta') {
    Swal.fire({
        html:
            '<h3 class="mb-0">'+mensaje+'</h3>',
        showCloseButton: false,
        showConfirmButton: false,
        showCancelButton: true,
        focusConfirm: false,
        timer: 2000,
        timerProgressBar: true,
        cancelButtonText: feather.icons['check-circle'].toSvg({ class: 'font-medium-1 me-1' }) + 'Cerrar',
        customClass: {
            cancelButton: 'btn btn-success'
        },
        buttonsStyling: false
    });
};

function alertWarning(mensaje = 'Alerta') {
    Swal.fire({
        html:
            '<h3 class="mb-0">'+mensaje+'</h3>',
        showCloseButton: false,
        showConfirmButton: false,
        showCancelButton: true,
        focusConfirm: false,
        timer: 2000,
        timerProgressBar: true,
        cancelButtonText: feather.icons['alert-circle'].toSvg({ class: 'font-medium-1 me-1' }) + 'Cerrar',
        customClass: {
            cancelButton: 'btn btn-warning'
        },
        buttonsStyling: false
    });
};

function alertError(mensaje = 'Alerta') {
    Swal.fire({
        html:
            '<h3 class="mb-0">'+mensaje+'</h3>',
        showCloseButton: false,
        showConfirmButton: false,
        showCancelButton: true,
        focusConfirm: false,
        timer: 2000,
        timerProgressBar: true,
        cancelButtonText: feather.icons['x-circle'].toSvg({ class: 'font-medium-1 me-1' }) + 'Cerrar',
        customClass: {
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
    });
};

function alertConfirm(mensaje = 'Alerta', url = 1, fun = 1) {
    if (url == 1 || fun == 1) {
        alertWarning('Hubo un error al procesar la solicitud. Favor de recargar la página');
    } else {
        Swal.fire({
            title: mensaje,
            showCancelButton: true,
            confirmButtonText: 'Confirmar',
            cancelButtonText: 'Cancelar',
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger ms-1'
            },
            buttonsStyling: false
        }).then(function (result) {
            if (result.value) {
                $.ajax({
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    url: url,
                    type: 'POST'
                }).done(function(response) {
                    switch (response.idnotificacion) {
                        case 1:
                            $('.modal').modal('hide');
                            alertSuccess(response.mensaje);
                            // setTimeout(function() {
                            //     window.location.reload();
                            // }, 1500);
                            window[fun]();
                            break;
                        case 2:
                            alertWarning(response.mensaje);
                            break;
                        default:
                            alertError(response.mensaje);
                            console.log(response.errors);
                            break;
                    }
                }).fail(function(response) {
                    alertError(response.mensaje);
                    console.log(response);
                });
            }
        });
    }
}
