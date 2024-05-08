@extends('layouts.master')



@section('content')
<input type="hidden" value="{{ url('/') }}" id="url">
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="table-responsive p-0">
                <!-- Tabla Etapas-->
                <table id="Etapas" class="datatable-Etapas table table-bordered table-stripe">
                    <thead>
                        <tr>
                            <!--<th>Fecha Actual</th>-->
                            <th class="centrar">Nombre</th>
                            
                            <th class="centrar">Estado</th>
                            <th class="centrar"></th>
                            <th class="centrar">
                                <button type="button" data-func="dt-add" class="abrir-modal btn btn-success btn-xs"
                                    data-bs-toggle="modal" data-bs-target="#createModal"
                                    data-remote="{{route('etapas.create')}}">
                                    <i class=' fas fa-plus'></i> Nuevo
                                </button>
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($etapas as $etapa)
                        <tr>
                            <td>{{$etapa->nombreEtapa}}</td>
                            <td>@if ($etapa->activo == true)
                                <span class="badge rounded-pill badge-light-success">Activo</span>
                                @else
                                <span class="badge rounded-pill badge-light-danger">Inactivo</span>
                                @endif
                            </td>
                            <td>@if ($etapa->activo == true)
                                <div class="btn-group" role="group">
                                    <button type="button" data-func="dt-add" class="btn btn-primary me-2 dt-add"
                                        data-bs-toggle="modal" data-bs-target="#editModal"
                                        data-remote="">
                                        <i class='right fas fa-pencil'></i>
                                    </button>
                                    <div class="btn-group" role="group">
                                    
                                        <button type="button" data-func="dt-add"
                                            class="btn btn-danger btn-xs dt-add eliminaredicto"
                                            data-id="" id="btn_delete">
                                            <i class='right fas fa-trash'></i>
                                        </button>
                                    </div>
                                </div>
                                @else
                                <button type="button" class="btn btn-info btn-xs dt-add btn_activate" id="btn_activate"
                                    data-id="">
                                    <i class="fas fa-check text-light"></i> Activar
                                </button>
                                @endif
                            </td>
                            {{--  <td>{{ \Carbon\Carbon::parse($edicto->fecha_publicacion)->format('d/m/Y') }}</td>
                            <td>{{ $edicto->numero_expediente ."/". $edicto->anio_expediente}}</td>
                            <td>{{ $edicto->numero_edicto. "/". $edicto->anio_edicto }}</td>
                            <td>{{ $juzgado[$edicto->iddistrito] }}</td>
                            <td>{{ $juzgado[$edicto->idjuzgado] }}</td>
                            <td>{{ $juicio[$edicto->idjuicio] }}</td>
                            <td>{{ $demandada[$edicto->idprestacion_demandada] }}</td>
                            <td>{{ $edicto->descripcion }}</td>
                            <td>
                                @if ($etapa->activo == true)
                                <span class="badge rounded-pill badge-light-success">Activo</span>
                                @else
                                <span class="badge rounded-pill badge-light-danger">Inactivo</span>
                                @endif
                            </td>
                            <td>
                                @if ($etapa->activo == false)
                                <div class="btn-group" role="group">
                                    <button type="button" data-func="dt-add" class="btn btn-primary me-2 dt-add"
                                        data-bs-toggle="modal" data-bs-target="#editModal"
                                        data-remote="{{ route('#) }}">
                                        <i class='right fas fa-pencil'></i>
                                    </button>
                                    <div class="btn-group" role="group">
                                    
                                        <button type="button" data-func="dt-add"
                                            class="btn btn-danger btn-xs dt-add eliminaredicto"
                                            data-id="{{ # }}" id="btn_delete">
                                            <i class='right fas fa-trash'></i>
                                        </button>
                                    </div>
                                </div>
                                @else
                                <button type="button" class="btn btn-info btn-xs dt-add btn_activate" id="btn_activate"
                                    data-id="{{#}}">
                                    <i class="fas fa-check text-light"></i> Activar
                                </button>
                                @endif
                            </td>  --}}
                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')

<script src="{{ asset('public/assets/js/sistema/CtgEtapa/Etapa.js') }}"></script>
<script type="text/javascript" charset="utf-8" async defer>
    $(document).ready(function() {
            var dt_Etapas_table = $('.datatable-Etapas')
            var dt = dt_Etapas_table.DataTable({
                language: {
                    sProcessing: 'Procesando...',
                    sLengthMenu: 'Mostrar _MENU_ registros',
                    sZeroRecords: 'No se encontraron resultados',
                    sEmptyTable: 'Ningún dato disponible en esta tabla',
                    sInfo: 'Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros',
                    sInfoEmpty: 'Mostrando registros del 0 al 0 de un total de 0 registros',
                    sInfoFiltered: '(filtrado de un total de _MAX_ registros)',
                    sInfoPostFix: '',
                    sSearch: 'Busca:',
                    sUrl: '',
                    sInfoThousands: ',',
                    sLoadingRecords: 'Cargando...',
                    oPaginate: {
                        sFirst: 'Primero',
                        sLast: 'Último',
                        sNext: 'Siguiente',
                        sPrevious: 'Anterior'
                    },
                    oAria: {
                        sSortAscending: ': Activar para ordenar la columna de manera ascendente',
                        sSortDescending: ': Activar para ordenar la columna de manera descendente'
                    },
                    paginate: {
                        // remove previous & next text from pagination
                        previous: '&nbsp;',
                        next: '&nbsp;'
                    }
                },
                sProcessing: true,
                    dom: '<"d-flex justify-content-between align-items-center mx-1 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-1 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                    buttons: [],
                    responsive: true,
                    order: [[0, 'desc']], // Ordenar por la primera columna de forma descendente
                })
                 
        });
</script>
@stop