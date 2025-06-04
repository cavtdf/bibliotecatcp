@extends('theme.layout')

@section("styles")
    <link rel="stylesheet" type="text/css" media="screen" href="{{asset('tcp/js/bootstrap-fileinput/css/fileinput.min.css')}}">
@endsection

@section('scriptsplugin')
    <script src="{{ asset('tcp/js/bootstrap-fileinput/js/fileinput.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('tcp/js/bootstrap-fileinput/js/locales/es.js')}}" type="text/javascript"></script>
    <script src="{{ asset('tcp/js/bootstrap-fileinput/themes/fas/theme.min.js')}}" type="text/javascript"></script>
    <!-- <script src="{{ asset('tcp/page/crearlibro.js')}}" type="text/javascript"></script> -->
@endsection

@section('contenido')

    <div id="content">
    <section id="widget-grid" class="">
        <!-- Widget ID (each widget will need unique ID)-->
        <div class="jarviswidget" id="wid-id-4" data-widget-deletebutton="false" data-widget-editbutton="false" data-widget-custombutton="false">
             <header>
                <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                <h2>Modificar datos</h2>
            </header>

            <!-- widget div-->
            <div>
                <!-- widget content -->
                <div class="widget-body no-padding">
                    <form method="POST" action="{{ route('bibliografia.update', $data->id_biblioteca) }}" id="order-form" class="smart-form" autocomplete="off" novalidate="novalidate" enctype="multipart/form-data">
                        @csrf @method("put")
                        <header>
                            Modificacion de material bibliografico
                        </header>
                        <fieldset>
                            <div class="row">
                                <section class="col col-6">
                                    <select class="form-control" name="categoria" id="categoria">
                                        <option value="">Categoria</option>
                                           @foreach ($categorias as $key => $value)
                                            <option {{$value->id_categoria == $data->id_categoria ? 'selected' : ''}} value="{{$value->id_categoria}}">{{$value->categoria}}</option>
                                          @endforeach
                                    </select>
                                </section>
                                <section class="col col-6">
                                    <select class="form-control" name="tipo" id="tipo">
                                     <option value="">Tipo</option>
                                       @foreach ($tipos as $key => $value)
                                        <option {{$value->id_tipo == $data->id_tipo ? 'selected' : ''}} value="{{$value->id_tipo}}">{{$value->tipo}}</option>
                                       @endforeach
                                    </select>
                                </section>
                            </div>
                            <div class="row">
                                <section class="col col-10">
                                    <label class="input"> <i class="icon-append fa fa-book"></i>
                                        <input type="text" name="titulo" value="{{old('titulo', $data->titulo ?? '')}}" placeholder="Titulo">
                                    </label>
                                </section>
                            </div>
                            <div class="row">
                                <section class="col col-6">
                                    <select class="form-control" name="autor" id="autor">
                                    <option value="">Autor</option>
                                        @foreach ($autores as $key => $value)
                                          <option {{$value->id_autor == $data->id_autor ? 'selected' : ''}} value="{{$value->id_autor}}">{{$value->autor}}</option>
                                        @endforeach
                                    </select>
                                </section>

                                <section class="col col-6">
                                    <select class="form-control" name="editorial" id="editorial">
                                        <option value="">Editorial</option>
                                            @foreach ($editoriales as $key => $value)
                                                <option {{$value->id_editorial == $data->id_editorial ? 'selected' : ''}} value="{{$value->id_editorial}}">{{$value->editorial}}</option>
                                            @endforeach
                                    </select>
                                </section>
                            </div>
                            <div class="row">
                                <section class="col col-6">
                                <label class="input"> <i class="icon-append fa fa-"></i>
                                    <input type="text" name="isbn" value="{{old('isbn', $data->isbn ?? '')}}" placeholder="ISBN">
                                </label>
                                </section>
                         </div>
                        </fieldset>
                        <fieldset>
                            <div class="row">
                                <section class="col col-6">
                                    <select class="form-control" name="ubicacion" id="ubicacion">
                                        <option value="">Ubicacion</option>
                                            @foreach($ubicaciones as $key => $value)
                                            <option {{$value->id_ubicacion == $data->id_ubicacion ? 'selected' : ''}} value="{{$value->id_ubicacion}}">{{$value->ubicacion}}</option>
                                            @endforeach
                                    </select>
                                </section>
                                <section class="col col-6">

                                    <select class="form-control" name="estado">
                                        <option value="">Seleccione</option>
                                        @foreach ($estados as $key => $value)
                                            <option {{$value->id_estado == $data->id_estado ? 'selected' : ''}} value="{{$value->id_estado}}">{{$value->estado}}</option>
                                         @endforeach
                                    </select>

                                </section>
                            </div>
                            <div class="row">
                                <section class="col col-4">
                                    <label for="foto" class="col-lg-5 control-label ">Caratula y/o Indice de la Bibliografía</label>
                                    <div class="col-lg-5">
                                        @if ($data->foto === '0' || $data->foto === NULL)
                                            <H4 class="text-center"><strong>Imagen no disponible</strong></H4>
                                        @else
                                            <iframe width="800" height="400" src="{{Storage::url("imagenes/caratulas/$data->foto")}}" frameborder="0"></iframe>
                                            <!-- <input type="file" name="foto_up" id="foto" data-initial-preview="{{isset($data->foto) ? Storage::url("imagenes/caratulas/$data->foto") : "http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=Caratula+Libro"}}" accept="image/*, application/pdf"/> -->
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="file">Seleccione un archivo:</label>
                                        <input type="file" class="form-control-file" id="file" name="foto_up">
                                    </div>
                                </section>
                           </div>
                           <section>
                                <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                                    <textarea rows="5" name="descripcion">
                                        {{old('descripcion', $data->descripcion ?? '')}}
                                    </textarea>
                                </label>
                            </section>
                            <section>
                                <label class="textarea"> <i class="icon-append fa fa-pencil"></i>
                                    <textarea rows="5" name="notas" placeholder="Links...">
                                        {{old('notas', $data->notas ?? '')}}
                                    </textarea>
                                </label>
                            </section>
                        </fieldset>
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
    </section>
    </div>
@endsection

