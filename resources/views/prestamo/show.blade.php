@extends('theme.layout')

@section("styles")
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('tcp/js/bootstrap-fileinput/css/fileinput.min.css')}}">
@endsection

@section('scriptsplugin')
    <script src="{{ asset('tcp/js/bootstrap-fileinput/js/fileinput.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('tcp/js/bootstrap-fileinput/js/locales/es.js')}}" type="text/javascript"></script>
    <script src="{{ asset('tcp/js/bootstrap-fileinput/themes/fas/theme.min.js')}}" type="text/javascript"></script>
@endsection

@section('scripts')
    <script src="{{ asset('tcp/page/crearlibro.js')}}" type="text/javascript"></script>
@endsection


@section('contenido')
  <div id="content">
    <section id="widget-grid" class="">
        <div class="row">
            <!-- NEW WIDGET START de la primera columna -->
            <article class="col-sm-12 col-md-12 col-lg-6">

                <!-- Widget ID (each widget will need unique ID)-->
                <div class="jarviswidget" id="prestamo" data-widget-colorbutton="false" data-widget-fullscreenbutton="false" data-widget-deletebutton="false" data-widget-editbutton="false" data-widget-custombutton="false">
                     <header>
                        <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                        <h2>Prestamo</h2>

                    </header>

                    <!-- widget div-->
                    <div>

                        <!-- widget edit box -->
                        <div class="jarviswidget-editbox">
                            <!-- This area used as dropdown edit box -->

                        </div>
                        <!-- end widget edit box -->

                        <!-- widget content -->
                        <div class="widget-body no-padding">
                            <form class="smart-form" method="POST" action="{{ route('prestamo.update', $data->id) }}" id="order-form" class="smart-form"  enctype="multipart/form-data">
                                @csrf @method("put")
                                <header>
                                  <h3 class="alert alert-info"> Título:   {{$data->titulo}} </h3>
                                </header>
                                <fieldset>
                                    <section>
                                        <H4> <div><strong> Categoría : {{ $categoria->categoria }}</strong></div></H4>
                                    </section>
                                    <section>
                                        <H4><strong>Autor : <span class="text-success"> {{ $autores->autor }} </span></strong></H4>
                                    </section>
                                    <section>
                                        <H4><strong>ISBN : <span class="text-success"> {{ $data->isbn }} </span></strong></H4>
                                    </section>
                                    <section>
                                        <H4><strong>Fecha de solicitud : <span class="text-success"> {{ date('d-m-Y') }} </span></strong></H4>
                                    </section>
                                    <section>
                                        <H4><strong>Fecha estimada de devolucion : <span class="text-success"> {{ $dt->format('d-m-Y') }} </span></strong></H4>
                                    </section>
                                    <section>
                                        @if ($data->descripcion != 'null')
                                             <H4><strong>Descripción : <span class="text-success"> {{ $data->descripcion }} </span></strong></H4>

                                        @endif
                                    </section>
                                    <section>
                                        @if ($data->notas != 'null')
                                            <H4><strong>Notas : <span class="text-success"> {{ $data->notas }} </span></strong></H4>
                                        @endif
                                    </section>
                                </fieldset>
                                    <fieldset>
                                        <section>
                                          @if ($data->foto === '0' || $data->foto === NULL )
                                                <H4 class="text-center"><strong>Imagen no disponible</strong></H4>
                                          @else
                                                <div class="row">
                                                    <article class="col-xs-12 col-sm-6 col-md-6 col-lg-6 sortable-grid ui-sortable">
                                                        <div class="text-center"><img src="{{Storage::url("imagenes/caratulas/$data->foto")}}" alt="Caratula del libro" width="100%">
                                                        </div>
                                                    </article>
                                                </div>
                                           @endif
                                        </section>
                                    </fieldset>
                                <footer>
                                    <button type="submit" class="btn btn-primary">
                                        Confirmar
                                    </button>
                                    <button type="button" class="btn btn-default" onclick="window.history.back();">
                                        Cancelar
                                    </button>
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

