<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-datatable">
                <table class="datatables-basic table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Permiso</th>
                            <th>Categoría</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permisions as $permiso)
                            <tr>
                                <td>
                                    {{ $permiso->name }}
                                </td>
                                <td>
                                    <span class="badge bg-dark">
                                        <i class="fas fa-tag"></i> {{ $permiso->category_permission->name }}
                                    </span>
                                </td>
                                <td>
                                    @if ($permiso->activo == true)
                                        <span class="badge rounded-pill bg-success">
                                            Activo
                                        </span>
                                    @else
                                        <span class="badge rounded-pill bg-danger">
                                            Inactivo
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal" 
                                        data-remote="{{ route('permisos.edit', $permiso->id) }}">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </button>

                                    <button class="btn btn-sm btn-danger btndeletepermiso" data-id="{{ $permiso->id }}">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </button>
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
            responsive: true,
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
            dom: '<"card-header border-bottom p-1"<"head-label"><"dt-action-buttons text-end"B>><"d-flex justify-content-between align-items-center mx-1 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-1 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            buttons: [
                {
                    text: feather.icons['plus'].toSvg({ class: 'me-50 font-small-4' }) + 'Agregar Categoría',
                    className: 'create-new btn btn-success',
                    attr: {
                        'data-bs-toggle': 'modal',
                        'data-bs-target': '#createModal',
                        'data-remote': '{{ route("permisos.create") }}'
                    },
                    init: function (api, node, config) {
                        $(node).removeClass('btn-secondary');
                    }
                }
            ]
        });
        $('div.head-label').html('<h4 class="mb-0">Permisos registrados</h4>');
        dt_basic.columns.adjust().draw();
    });

    // Delete
    $('.btndeletepermiso').click(function( event ) {
        event.preventDefault();
        var idpermiso = $(this).data('id');
        var mensaje = '¿Seguro de eliminar la Categoría de Permiso?';
        var url = 'permisos/delete/' + idpermiso;
        var fun = 'cargarPermisos';
        alertConfirm(mensaje, url, fun);
    });
</script>