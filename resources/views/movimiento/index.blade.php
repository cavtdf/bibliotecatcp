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
                    Movimientos
                </span>
            </h1>
        </div>

        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
            <!-- Button trigger modal -->
            <button type="button" name="create_record" id="create_record" class="btn btn-success btn-sm pull-right header-btn hidden-mobile" <i class="fa fa-plus"></i>Nuevo Movimiento</button>

        </div>
    </div>
    <section id="widget-grid" class="">
	   <div class="row">
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <!-- Widget ID (each widget will need unique ID)-->
							<div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-editbutton="false" data-widget-deletebutton="false">
								<header>
									<span class="widget-icon"> <i class="fa fa-table"></i> </span>
									<h2>Autores</h2>
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
                                                    <th width="40%">Movimiento</th>
                                                    <th width="10%">Acción</th>
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
    <div id="formModal" class="modal fade" role="dialog" autocomplete="off">
        <div class="modal-dialog">
         <div class="modal-content">
          <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
                 <h4 class="modal-title">Nuevo Movimiento</h4>
               </div>
               <div class="modal-body">
                <span id="form_result"></span>
                <form method="post" id="sample_form" class="form-horizontal">
                 @csrf
                 <div class="form-group">
                     <label class="control-label col-md-4" >Movimiento : </label>
                     <div class="col-md-8">
                             <input type="text" name="tipo_movimiento" id="tipo_movimiento" class="form-control" />
                     </div>
                  </div>
                  <br />
                       <div class="form-group" align="center">
                        <input type="hidden" name="action" id="action" value="Add" />
                        <input type="hidden" name="hidden_id" id="hidden_id" />
                        <input type="submit" name="action_button" id="action_button" class="btn btn-warning" value="Grabar" />
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
                    url: "{{ route('movimiento.index') }}",
                   },
                "columns":[
                        { data: 'id_tipo_movimiento'},
                        { data: 'tipo_movimiento'},
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
            $('#create_record').click(function(){
                $('.modal-title').text('Nuevo Movimiento');
                $('#action_button').val('Grabar');
                $('#action').val('Add');
                $('#form_result').html('');
                $('#formModal').modal('show');
            });

            $('#sample_form').on('submit', function(event){
                event.preventDefault();
                var action_url = '';

                if($('#action').val() == 'Add')
                {
                 action_url = "{{ route('movimiento.store') }}";
                }

                if($('#action').val() == 'Edit')
                {
                 action_url = "{{ route('movimiento.update') }}";
                }
                $.ajax({
                    url: action_url,
                    method:"POST",
                    data:$(this).serialize(),
                    dataType:"json",
                    success:function(data)
                    {
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
                      $('#dt_basic').DataTable().ajax.reload();
                     }
                     $('#form_result').html(html);
                    }
                   });
                  });

                $(document).on('click', '.edit', function(){
                   var id = $(this).attr('id');
                   $('#form_result').html('');
                   $.ajax({
                    url :"/movimiento/"+id+"/edit",
                    dataType:"json",
                    success:function(data)
                    {
                     $('#tipo_movimiento').val(data.result.tipo_movimiento);
                     $('#hidden_id').val(id);
                     $('.modal-title').text('Editar Registro');
                     $('#action_button').val('Actualizar');
                     $('#action').val('Edit');
                     $('#formModal').modal('show');
                    }
                   })
            });

            $(".alert").fadeTo(2000, 700).slideUp(700, function(){
                $(".alert").slideUp(700);
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
