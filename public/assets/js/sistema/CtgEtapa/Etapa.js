

$('#btnstore').click(function(event) {
    event.preventDefault();
    if (validaFormulario) { // Verifica si el formulario es válido
        confirSave("¿Los datos capturados, son correctos?", function () {
            saveEtapa();
        });
    }
});

async function saveEtapa() {
    const url = $('#url').val();
    try {
        const formData = new FormData($('#form-createetapa')[0]);

        const response = await fetch(url + '/catagolo/Etapas/Storage', {
            method: 'POST',
            mode: 'cors',
            redirect: 'manual',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            body: formData
        });

        const data = await response.json();
        switch (data.idnotificacion) {
            case 1:
                
                Swal.fire({
                    title: data.mensaje,
                    icon: "success",
                    showConfirmButton: false,  // No mostrar el botón "Ok"
                    timer: 1000,  // Cerrar automáticamente después de 1500 milisegundos (1.5 segundos)
                    timerProgressBar: true  // Mostrar una barra de progreso durante el temporizador
                });
                // Esperar un breve período de tiempo antes de recargar la página
                setTimeout(function () {
                    document.getElementById('form-createetapa').reset();
                    window.location.reload();
                }, 1000); // Espera 1 segundo

                break;

            case 2:
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: data.mensaje
                });
                break;

            case 3:
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: data.mensaje
                });
                break;

            default:
                Swal.fire({
                    icon: "info",
                    title: "Info...",
                    text: "Error desconocido"
                });
        }

    } catch (error) {
        console.error("Error al procesar la solicitud:", error);
    }
}