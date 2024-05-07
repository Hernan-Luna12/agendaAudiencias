<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-datatable">
                <table class="datatables-basic table table-bordered table-striped d-table">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Usuario</th>
                            <th>Perfil</th>
                            <th>Centro de trabajo</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($usuarios as $usuario)
                            <tr>
                                <td>
                                    {{ $usuario->persona->full_name }}
                                </td>
                                <td>
                                    {{ $usuario->name }}
                                </td>
                                <td class="fw-bolder">
                                    @if( count($usuario->roles) > 0 )
                                        @foreach ($usuario->roles as $item)
                                            {{ $item->name }}
                                        @endforeach
                                    @else
                                        <span class="badge rounded-pill bg-light-secondary">
                                            Sin perfil
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    @if( $usuario->ctg_centro_trabajo )
                                        {{ $usuario->ctg_centro_trabajo->name }}, {{ $usuario->ctg_centro_trabajo->ctg_distrito->name }}
                                    @else
                                        <span class="badge rounded-pill bg-light-secondary">
                                            Sin centro de trabajo
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    @if ($usuario->activo == true)
                                        <span class="badge rounded-pill bg-light-success">
                                            Activo
                                        </span>
                                    @else
                                        <span class="badge rounded-pill bg-light-danger">
                                            Inactivo
                                        </span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="d-inline-flex">
                                        <a class="dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa-solid fa-bars-staggered"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a href="javascript:;" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editModalLg" 
                                            data-remote="{{ route('usuarios.edit', $usuario->id) }}">
                                                <i class="fa-regular fa-pen-to-square text-warning"></i> Editar usuario
                                            </a>
                                            @if ($usuario->activo)
                                                <a href="javascript:;" class="dropdown-item btndestroyusuario" data-id="{{ $usuario->id }}">
                                                    <i class="fa-solid fa-user-xmark text-danger"></i> Desactivar usuario
                                                </a>
                                            @else
                                                <a href="javascript:;" class="dropdown-item btnactivateusuario" data-id="{{ $usuario->id }}">
                                                    <i class="fa-solid fa-user-check text-success"></i> Activar usuario
                                                </a>
                                            @endif
                                            <a href="javascript:;" class="dropdown-item btnresetpassword" data-id="{{ $usuario->id }}">
                                                <i class="fa-solid fa-key"></i> Resetear contraseña
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        var dt_basic_table = $('.datatables-basic');
        var dt_basic = dt_basic_table.DataTable({
            language: {
                sProcessing:     'Procesando...',
                sLengthMenu:     'Mostrar _MENU_ registros',
                sZeroRecords:    'No se encontraron resultados',
                sEmptyTable:     'No se encontraron resultados', // 'Ningún dato disponible en esta tabla',
                sInfo:           'Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros',
                sInfoEmpty:      'Mostrando registros del 0 al 0 de un total de 0 registros',
                sInfoFiltered:   '(filtrado de un total de _MAX_ registros)',
                sInfoPostFix:    '',
                sSearch:         'Buscar:',
                sUrl:            '',
                sInfoThousands:  ',',
                sLoadingRecords: 'Cargando...',
                oPaginate: {
                    sFirst:    'Primero',
                    sLast:     'Último',
                    sNext:     'Siguiente',
                    sPrevious: 'Anterior'
                },
                oAria: {
                    sSortAscending:  ': Activar para ordenar la columna de manera ascendente',
                    sSortDescending: ': Activar para ordenar la columna de manera descendente'
                },
                paginate: {
                    // remove previous & next text from pagination
                    previous: '&nbsp;',
                    next: '&nbsp;'
                }
            },
            processing: true,
            ordering: false,
            responsive: true,
            dom: '<"card-header border-bottom p-1"<"head-label"><"dt-action-buttons text-end"B>><"d-flex justify-content-between align-items-center mx-1 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-1 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            buttons: [
                {
                    text: feather.icons['plus'].toSvg({ class: 'me-50 font-small-4' }) + 'Agregar Usuario',
                    className: 'create-new btn btn-success',
                    attr: {
                        'data-bs-toggle': 'modal',
                        'data-bs-target': '#createModalLg',
                        'data-remote': '{{ route("usuarios.create") }}'
                    },
                    init: function (api, node, config) {
                        $(node).removeClass('btn-secondary');
                    }
                }
            ]
        });
        $('div.head-label').html('<h4 class="mb-0">Usuarios registrados</h4>');
        dt_basic.columns.adjust().draw();
    });

    // Destroy
    $('.btndestroyusuario').click(function( event ) {
        event.preventDefault();
        var id = $(this).data('id');
        var mensaje = '¿Seguro de desactivar la Usuario?';
        var url = 'usuarios/destroy/' + id;
        var fun = 'cargarUsuarios';
        alertConfirm(mensaje, url, fun);
    });

    // Activate
    $('.btnactivateusuario').click(function( event ) {
        event.preventDefault();
        var id = $(this).data('id');
        var mensaje = '¿Seguro de activar la Usuario?';
        var url = 'usuarios/activate/' + id;
        var fun = 'cargarUsuarios';
        alertConfirm(mensaje, url, fun);
    });

    // Reset password
    $('.btnresetpassword').click(function( event ) {
        event.preventDefault();
        var id = $(this).data('id');
        var mensaje = '¿Seguro de resetear la contraseña?';
        var url = 'usuarios/resetpassword/' + id;
        var fun = 'cargarUsuarios';
        alertConfirm(mensaje, url, fun);
    });
</script>