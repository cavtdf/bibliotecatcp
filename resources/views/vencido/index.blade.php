@extends('theme.layout')

@section('contenido')
<div id="content">
    <div class="row">
        <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
            <h1 class="page-title txt-color-blueDark">
                <!-- PAGE HEADER -->
                <i class="fa fa-lg fa-fw fa fa-book"></i>
                    Biblioteca
                <span>>
                    Préstamos Vencidos
                </span>
            </h1>
        </div>
    </div>
    <section id="widget-grid" class="">
        @csrf
	   <div class="row">
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <!-- Widget ID (each widget will need unique ID)-->
							<div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-editbutton="false" data-widget-deletebutton="false">
								<header>
									<span class="widget-icon"> <i class="fa fa-table"></i> </span>
									<h2>Vencidos</h2>
								</header>
                                <!-- widget div-->
                                <div>
                                    @if(session()->has('message.level'))
                                        <div class="alert alert-success fade in">
                                            <button class="close" data-dismiss="alert">
                                                ×
                                            </button>
                                            <i class="fa-fw fa fa-check"></i>
                                            <strong> {!! session('message.content') !!} </strong>
                                        </div>
                                    @endif
                                </div>
							<div>
									<!-- widget content -->
									<div class="widget-body no-padding">
										<table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
											<thead>
												<tr>
                                                    <th width="4%">ID</th>
                                                    <th width="5%">Ubicacion</th>
                                                    <th>Titulo</th>
                                                    <th>Usuario</th>
                                                    <th>Solicitado el</th>
                                                    <th>Entregado el</th>
                                                    <th>Fecha de Devolucion</th>
                                                    <th width="16%">Accion</th>
												</tr>
											</thead>
											<tbody>

											</tbody>
										</table>

									</div>
									<!-- end widget content -->
								</div>
								<!-- end widget div -->
							</div>
				<!-- end widget -->
            </article>
      </div>
    </section>
    <!-- Modal de Confirmacion -->
    <div class="modal modal-danger fade" id="reclamar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Confirmar reclamo</h4>
                </div>
                <div class="modal-body">
                    <form action="{{route('vencido.update','id_confirma')}}" method="post">
                        {{method_field('PUT')}}
                        {{csrf_field()}}
                        <div class="modal-body">
                            <p class="text-center">
                                Confirma el reclamo del material ?
                            </p>
                            <input type="hidden" name="id_confirma" id="id_confirma" value="">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" data-dismiss="modal">No</button>
                            <button type="submit" class="btn btn-danger">Si</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
<!-- Modal de cancelacion -->

<!-- Modal de Renovacion -->
<div class="modal modal-danger fade" id="renovar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Confirmar renovacion</h4>
            </div>
            <div class="modal-body">
                <form action="{{route('vencido.update','id_renueva')}}" method="post">
                    {{method_field('PUT')}}
                    {{csrf_field()}}
                    <div class="modal-body">
                        <p class="text-center">
                            Confirma la solicitud de renovacion ?
                        </p>
                        <input type="hidden" name="id_renueva" id="id_renueva" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-danger">Si</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- Fin Modal de renovacion -->
</div>

@endsection

@section('scripts')
<script>

    // DO NOT REMOVE : GLOBAL FUNCTIONS!

    $(document).ready(function() {

        pageSetUp();
            var responsiveHelper_dt_basic = undefined;
            var responsiveHelper_datatable_fixed_column = undefined;
            var responsiveHelper_datatable_col_reorder = undefined;
            var responsiveHelper_datatable_tabletools = undefined;

            var breakpointDefinition = {
                tablet : 1024,
                phone : 480
            };

            $('#dt_basic').dataTable({
                "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>"+
                    "t"+
                    "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
                "processing": true,
                "serverSide": true,
                "ajax":{
                    url: "{{ route('vencido.index') }}",
                 },
                "responsive": true,
                "columns":[
                        {data: 'id_id'},
                        {data: 'ubicacion'},
                        {data: 'titulo'},
                        {data: 'agente_prestamo' },
                        {data: 'fecha_solicitud',
                        "type": "date ",
                        "render":function (value) {
                            if (value === null) return "";
                            return moment(value).format('DD/MM/YYYY');
                            }
                        },
                        {data: 'fecha_entregado',
                        "type": "date ",
                        "render":function (value) {
                            if (value === null) return "";
                            return moment(value).format('DD/MM/YYYY');
                            }
                        },
                        {data: 'fecha_estimada_devolucion',
                        "type": "date ",
                        "render":function (value) {
                            if (value === null) return "";
                            return moment(value).format('DD/MM/YYYY');
                            }
                        },
                        {data: 'action',
                            orderable: false,
                            serchable: false
                        }
                ],
                "autoWidth" : true,
                "language": {
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar   _MENU_    registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sEmptyTable": "Ningún dato disponible en esta tabla",
                    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sSearch": "Buscar:  ",
                    "sUrl": "",
                    "sInfoThousands": ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Último",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                },
                "preDrawCallback" : function() {
                    // Initialize the responsive datatables helper once.
                    if (!responsiveHelper_dt_basic) {
                        responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#dt_basic'), breakpointDefinition);
                    }
                },
                "rowCallback" : function(nRow) {
                    responsiveHelper_dt_basic.createExpandIcon(nRow);
                },
                "drawCallback" : function(oSettings) {
                    responsiveHelper_dt_basic.respond();
                }

            });

            $(document).on('click', '.reclama', function(){
                var id = $(this).attr('id');
                $(".modal-body #id_confirma").val(id);
                $('#reclamar').modal('show');
            });

            $(document).on('click', '.renueva', function(){
                var id = $(this).attr('id');
                $(".modal-body #id_renueva").val(id);
                $('#renovar').modal('show');
            });


        })

   </script>

   <!-- Your GOOGLE ANALYTICS CODE Below -->
    <script>
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-XXXXXXXX-X']);
        _gaq.push(['_trackPageview']);

        (function() {
        var ga = document.createElement('script');
        ga.type = 'text/javascript';
        ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(ga, s);
        })();
    </script>

@endsection
