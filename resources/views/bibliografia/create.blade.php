@extends('theme.layout')

@section("estilos")
<link rel="stylesheet" type="text/css" media="screen" href="{{asset("tcp/js/bootstrap-fileinput/css/fileinput.min.css")}}">
@endsection

@section('scriptsplugin')
    <script src="{{ asset('tcp/js/bootstrap-fileinput/js/fileinput.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('tcp/js/bootstrap-fileinput/js/locales/es.js')}}" type="text/javascript"></script>
    <script src="{{ asset('tcp/js/bootstrap-fileinput/themes/fas/theme.min.js')}}" type="text/javascript"></script>
    <!-- <script src="{{ asset('tcp/page/crearlibro.js')}}" type="text/javascript"></script> -->
@endsection

@section('scripts')
    <!-- <script src="{{ asset('tcp/page/crearlibro.js')}}" type="text/javascript"></script> -->
@endsection

@section('contenido')
   <div id="content">
    <section id="widget-grid" class="">
        @csrf
	   <div class="row">
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <!-- Widget ID (each widget will need unique ID)-->
							<div class="jarviswidget jarviswidget-color-darken" id="alta" data-widget-editbutton="false" data-widget-deletebutton="false">
								<header>
									<span class="widget-icon"> <i class="fa fa-table"></i> </span>
									<h2>Nueva Bibliografia</h2>
                                </header>

								<!-- widget div-->
							<div>
									<!-- widget content -->
									<div class="widget-body no-padding">
										<form method="POST" action="{{route('bibliografia.store')}}" id="order-form" class="smart-form" autocomplete="off" novalidate="novalidate" enctype="multipart/form-data">
                                            @csrf
                                            @include('bibliografia.formulario')
                                            <footer>
                                                <button type="submit" class="btn btn-primary">
                                                    Guardar
                                                </button>
                                                <button type="button" class="btn btn-default" onclick="window.history.back();">Cancelar</button>
                                            </footer>
                                        </form>
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

