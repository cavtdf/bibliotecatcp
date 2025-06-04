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
                    Solicitar Prestamo
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
									<h2>Solicitar prestamo</h2>
								</header>
                                <!-- widget div-->
                                <div class="row">
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
                                                    <th>Titulo</th>
                                                    <th>Autor</th>
                                                    <th>Categoría</th>
                                                    <th>Editorial</th>
                                                    <th>Tipo</th>
                                                    <th>Estado</th>
                                                    <th>Situacion</th>
                                                    <th width="13%">Accion</th>
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
</div>

@endsection

@section('scripts')
<script>

    // DO NOT REMOVE : GLOBAL FUNCTIONS!

    $(document).ready(function() {

        pageSetUp();

        /* BASIC ;*/
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
                "responsive": true,
                "processing": true,
                "serverSide": true,
                "ajax":{
                    url: "{{ route('prestamo.index') }}",
                 },
                "responsive": true,
                "columns":[
                        {data: 'titulo'},
                        {data: 'autor' },
                        {data: 'categoria'},
                        {data: 'editorial'},
                        {data: 'tipo'},
                        {data: 'estado'},
                        {data: 'estado_prestamo'},
                        {data: 'btn',
                            orderable: false,
                            serchable: false,
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

               "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                    switch(aData['estado_prestamo']){
                        case "PRESTADO":
                                $('td', nRow).css('background-color', '#FCF0AE')
                                $('td:eq(7)', nRow).html( '<b>No disponible</b>' );
                            break;
                        case "SOLICITADO":
                            $('td', nRow).css('background-color', '#FEF8D2');
                            $('td:eq(7)', nRow).html( '<b>No disponible</b>' );
                            break;
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

          //  $(".alert").fadeTo(2000, 900).slideUp(900, function(){
         //       $(".alert").slideUp(900);
         //   });

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
