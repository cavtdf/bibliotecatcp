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
                    Bibliografia
                </span>
            </h1>
        </div>

        @can('administrador')
            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                <a id="btnNuevo" href="{{ route ('bibliografia.create') }}" class="btn btn-success pull-right "> <i class="fa fa-plus"></i> Agregar Bibliografía</a>
            </div>
        @endcan
    </div>
    <section id="widget-grid" class="">
        @csrf
	   <div class="row">
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <!-- Widget ID (each widget will need unique ID)-->
							<div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-editbutton="false" data-widget-deletebutton="false">
								<header>
									<span class="widget-icon"> <i class="fa fa-table"></i> </span>
                                    <h2>Bibliografia</h2>
                                </header>
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
								<!-- widget div-->
							<div>
									<!-- widget content -->
									<div class="widget-body no-padding">
										<table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
											<thead>
												<tr>
                                                    <th width="4%">ID</th>
                                                    <th width="5%">Ubicacion</th>
                                                    <th>Titulo</th>
                                                    <th>Autor</th>
                                                    <th>Categoría</th>
                                                    <th>Editorial</th>
                                                    <th>Tipo</th>
                                                    <th>Estado</th>
                                                    <th>Alta</th>
                                                    <th>Links</th>
                                                    <th></th>
                                                    <th>Acciones</th>
                                                    <th></th>
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
    <!-- Inicio del Modal crear/editar -->
    <div id="ver_libro" class="modal fade" role="dialog" tabindex="-1">
        <div class="modal-dialog">
         <div class="modal-content">
          <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                 <h4 class="modal-title">Detalle de la Bibliografía</h4>
               </div>
               <div class="modal-body">

               </div>
            </div>
           </div>
    </div>
    <!-- fin del modal crear/editar -->
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
            var rol;

            @if (Auth::user())
                 rol = "{{ Auth::user()->role_id }}";
            @endif

            var breakpointDefinition = {
                tablet : 1024,
                phone : 480
            };

            $('#dt_basic').dataTable({
                "stateSave": true,
                "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>"+
                    "t"+
                    "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
                "responsive": true,
                "processing": true,
                "serverSide": true,
                "ajax":{
                    url: "{{ route('bibliografia.index') }}",
                 },
                "deferRender": true,
                "responsive": true,
                "columns":[
                        {data: 'id'},
                        {data: 'ubicacion'},
                        {data: 'titulo'},
                        {data: 'autor' },
                        {data: 'categoria'},
                        {data: 'editorial'},
                        {data: 'tipo'},
                        {data: 'estado'},
                        {data: 'created_at',
                        "type": "date",
                        "render":function (value) {
                            if (value === null) return "";
                            return moment(value).format('DD/MM/YYYY');
                            }
                        },
                        {data: 'notas',
                        "render": function ( data, type, full, meta ) {
                            if (data === null) {
                                return '';
                                }
                              else {
                                return '<a href="'+data+'"target="_blank">On line</a>';
                               }
                          }
                        },
                        {data: 'btn',
                            orderable: false,
                            serchable: false
                        },
                        {data: 'btn1',
                            orderable: false,
                            serchable: false
                        },
                        {data: 'btn2',
                            orderable: false,
                            serchable: false
                        }
                ],
                order: [9, 'desc'],
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
                        case "SOLICITADO":
                            $('td', nRow).css('background-color', '#FEF8D2');
                            $('td:eq(13)', nRow).html( '<b>No disponible</b>' );
                            $('td:eq(11)', nRow).html( '<b></b>' );
                            break;
                        case "PRESTADO":
                            $('td', nRow).css('background-color', '#FCF0AE');
                            $('td:eq(13)', nRow).html( '<b>No disponible</b>' );
                            $('td:eq(11)', nRow).html( '<b></b>' );
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

        // Manejar clic en botón Eliminar (usando delegación de eventos para botones dentro de DataTables)
        $('#dt_basic').on('click', '.delete', function () {
            var bibliografia_id = $(this).attr('id');
            var token = $("meta[name='csrf-token']").attr("content"); // Asegúrate de tener la meta tag CSRF en el layout

            if (confirm("¿Estás seguro de que quieres eliminar esta bibliografía?")) {
                $.ajax({
                    url: "/bibliografia/" + bibliografia_id, // Ruta de eliminación, Laravel usa DELETE para destroy
                    type: 'DELETE',
                    data: {
                        "_token": token,
                        "_method": "DELETE", // Laravel necesita _method para simular DELETE via POST
                    },
                    success: function (response) {
                        // Recargar la tabla DataTables después de eliminar
                        $('#dt_basic').DataTable().ajax.reload();
                        // Mostrar mensaje de éxito si lo hay
                        if(response.success){
                            alert(response.success);
                        } else if (response.message) {
                             alert(response.message);
                        }
                    },
                    error: function (xhr, status, error) {
                         // Mostrar mensaje de error si lo hay
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            alert('Error: ' + xhr.responseJSON.message);
                        } else {
                             alert('Hubo un error al intentar eliminar la bibliografía.');
                        }
                        console.error(xhr.responseText);
                    }
                });
            }
        });

        // Manejar clic en botón Detalle (abrir modal)
        $('#dt_basic').on('click', '.btn_detalle', function () {
            var bibliografia_id = $(this).attr('href').split('/').pop(); // Obtener el ID de la URL del enlace

            $.ajax({
                url: "/bibliografia/" + bibliografia_id, // Ruta para obtener el detalle
                type: 'GET',
                success: function (response) {
                    // Insertar el contenido HTML del detalle en el cuerpo del modal
                    $('#ver_libro .modal-body').html(response);
                    // Abrir el modal
                    $('#ver_libro').modal('show');
                },
                error: function (xhr, status, error) {
                    // Mostrar mensaje de error si lo hay
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        alert('Error: ' + xhr.responseJSON.message);
                    } else {
                        alert('Hubo un error al cargar el detalle de la bibliografía.');
                    }
                    console.error(xhr.responseText);
                }
            });
             return false; // Prevenir la acción por defecto del enlace (navegar)
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
