@extends('theme.layout')

@section('contenido')
<div id="content">
    <div class="row">
        <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
            <h1 class="page-title txt-color-blueDark">
                <!-- PAGE HEADER -->
                <i class="fa-fw fa fa-sitemap"></i>
                    Nomencladores
                <span>>
                    Ubicaciones
                </span>
            </h1>
        </div>

        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
            <!-- Button trigger modal -->
            <button type="button" name="create_record" id="create_record" class="btn btn-success btn-sm pull-right header-btn hidden-mobile">Nueva Ubicacion</button>

        </div>
    </div>
    <section id="widget-grid" class="">
	   <div class="row">
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <!-- Widget ID (each widget will need unique ID)-->
							<div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-editbutton="false" data-widget-deletebutton="false">
								<header>
									<span class="widget-icon"> <i class="fa fa-table"></i> </span>
									<h2>Ubicaciones</h2>
                                </header>
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
								<!-- widget div-->
							<div>
									<!-- widget content -->
									<div class="widget-body no-padding">
										<table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
											<thead>
												<tr>
                                                    <th width="10%">Id</th>
                                                    <th width="40%">Categoria</th>
                                                    <th width="40%">Ubicacion</th>
                                                    <th width="10%">Accion</th>
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
    
    <div id="formModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
         <div class="modal-content">
          <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                 <h4 class="modal-title">Nueva Ubicacion</h4>
          </div>
          <div class="modal-body">
              <span id="form_result"></span>
                <form method="post" id="sample_form" class="form-horizontal" autocomplete="off">
                 @csrf
                    {{-- Eliminado campo de Categoria --}}
                    {{--
                    <div class="form-group">
                        <label class="control-label col-md-4">Categoria : </label>
                           <div class="col-md-8">
                              <select class="selectpicker form-control" id="categoria" name="categoria" required>
                                  {{--  @foreach ($categoria as $c)
                                      <option value="{{ $c->id}}"> {{ $c->categoria}} </option>
                                  @endforeach  --}}
                              </select>
                           </div>
                    </div>
                    --}}

                    <div class="form-group">
                    <label class="control-label col-md-4" >Ubicacion : </label>
                        <div class="col-md-8">
                            <input type="text" name="ubicacion" id="ubicacion" class="form-control" required=""/>
                        </div>
                    </div>

                  
                    <div class="form-group mb-0">
                        <div class="col-md-8 offset-md-4">
                             <input type="hidden" name="action" id="action" value="Add" />
                             <input type="hidden" name="hidden_id" id="hidden_id" />
                             <button type="submit" name="action_button" id="action_button" class="btn btn-warning">Grabar</button>
                        </div>
                    </div>
                </form>
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

        /* // DOM Position key index //

        l - Length changing (dropdown)
        f - Filtering input (search)
        t - The Table! (datatable)
        i - Information (records)
        p - Pagination (paging)
        r - pRocessing
        < and > - div elements
        <"#id" and > - div with an id
        <"class" and > - div with a class
        <"#id.class" and > - div with an id and class

        Also see: http://legacy.datatables.net/usage/features
        */

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

                "processing": true,
                "serverSide": true,
                "ajax":{
                    url: "{{ route('ubicacion.index') }}",
                   },
                "columns":[
                        { data: 'id_ubicacion'},
                        { data: 'categoria'},
                        { data: 'ubicacion'},
                        { data: 'action',
                         orderable: false,
                         serchable: false
                        }
                        ],
                "autoWidth" : true,
                "language": {
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sEmptyTable": "Ningún dato disponible en esta tabla",
                    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sSearch": "Buscar:",
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

            // Descomentado el script AJAX del modal de creación/edición
            
            $('#create_record').click(function(){
                // Eliminada llamada AJAX innecesaria y lógica del selector de categoría
                
                $('.modal-title').text('Nueva Ubicacion'); // Título del modal
                $('#action_button').val('Grabar');
                $('#action').val('Add');
                $('#form_result').html('');
                $('#formModal').modal('show'); // <-- Esto abre el modal
            });

            // Descomentado el script que maneja el submit del formulario del modal
            
            $('#sample_form').on('submit', function(event){
                event.preventDefault();
                console.log('Form submit event triggered.'); // <-- Log para depuración
                var action_url = '';

                if($('#action').val() == 'Add')
                {
                 action_url = "{{ route('ubicacion.store') }}"; // Apuntando a ubicacion.store ahora
                }

                if($('#action').val() == 'Edit')
                {
                 action_url = "{{ route('ubicacion.update') }}"; // Apuntando a ubicacion.update ahora
                }

                console.log('Action URL:', action_url); // <-- Log para la URL

                $.ajax({
                    url: action_url,
                    method:"POST",
                    data:$(this).serialize(),
                    dataType:"json",
                    success:function(data)
                    {
                     console.log('AJAX success:', data); // <-- Log para respuesta exitosa
                     var html = '';
                     if(data.errors)
                     {
                      html = '<div class="alert alert-danger">';
                      for(var count = 0; count < data.errors.length; count++)
                      {
                       html += '<p>' + data.errors[count] + '</p>';
                      }
                      html += '</div>';
                     }
                     if(data.success)
                     {
                      html = '<div class="alert alert-success">' + data.success + '</div>';
                      $('#sample_form')[0].reset();
                      $('#dt_basic').DataTable().ajax.reload(null, false); // Mantener en la misma página si es posible
                     }
                     $('#form_result').html(html);
                    },
                    error: function(xhr, status, error) { // <-- Añadido manejador de errores AJAX
                        console.error('AJAX error:', xhr.responseText); // Log para errores de AJAX
                        var errorMessage = xhr.responseText || 'Error desconocido';
                         $('#form_result').html('<div class="alert alert-danger">Ocurrió un error: ' + errorMessage + '</div>');
                    }
                   });
                  });

                $(document).on('click', '.edit', function(){
                   var id = $(this).attr('id');
                   $('#form_result').html('');
                   $.ajax({

                    url :"/ubicacion/"+id+"/edit",
                    dataType:"json",
                    success:function(data)
                    {
                        console.log(data);
                     $('#ubicacion').val(data.result.material);
                     $('#hidden_id').val(id);
                     $('.modal-title').text('Editar Registro');
                     $('#action_button').val('Actualizar');
                     $('#action').val('Edit');
                     $('#formModal').modal('show');
                    }
                   })
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

    <script>
        // Script para recargar DataTables si hay un mensaje de éxito después de una creación/edición
        $(document).ready(function() {
            @if(session()->has('message.level') && session('message.level') == 'success')
                // Asumiendo que '#dt_basic' es el ID de tu tabla DataTables
                if ($.fn.DataTable.isDataTable('#dt_basic')) {
                    $('#dt_basic').DataTable().ajax.reload(null, false); // Recargar DataTables sin resetear la paginación
                }
            @endif
        });

    </script>

@endsection
