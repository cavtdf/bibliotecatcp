<!-- Contenido del detalle de la bibliografía para ser insertado en el cuerpo de un modal -->

<div class="modal-body-content">
    <h2 class="alert alert-warning"> Título: {{$data->titulo}} </h2>
    <h3> <div><strong> Categoría : {{ $data->categoria->categoria ?? 'N/A' }}</strong></div></h3>
    <h3><strong>Autor : <span class="text-success"> {{ $data->autor->autor ?? 'N/A' }} </span></strong></h3>
    <h3><strong>ISBN : <span class="text-success"> {{ $data->isbn }} </span></strong></h3>
    @if ($data->descripcion != 'null' && $data->descripcion != '')
        <h3><strong>Descripción : <span class="text-success"> {{ $data->descripcion }} </span></strong></h3>
        <br>
    @endif

    <h4><strong>Disponibiliad del material :</strong></h4>

    @switch($data->id_pres_estado)
        @case(1)
            <h3> <span class="text-warning "> prestado al usuario {{ $solicitadopor }} el {{ $newDate }} </span> </h3>
            @break
        @case(2)
            <h3> <span class="text-success"> disponible para su préstamo </span> </h3>
            @break
        @case(3)
        <h3> <span class="text-warning "> prestado al usuario {{ $solicitadopor }} el {{ $newDate }} </span> </h3>
            @break
        @default
    @endswitch
    <br>
    @if ($data->foto === '0' || $data->foto === NULL || $data->foto === '')
          <H4 class="text-center"><strong>Imagen no disponible</strong></H4>
    @else
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                {{-- Verificar si es PDF o imagen para mostrar correctamente --}}
                @php
                    $fileExtension = pathinfo($data->foto, PATHINFO_EXTENSION);
                @endphp

                @if(in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif']))
                    <img src="{{ Storage::url("imagenes/caratulas/" . $data->foto) }}" alt="Caratula y/o Indice de la Bibliografía" style="max-width: 100%; height: auto;">
                @elseif(strtolower($fileExtension) === 'pdf')
                     <iframe width="100%" height="500" src="{{ Storage::url("imagenes/caratulas/" . $data->foto) }}" frameborder="0"></iframe>
                @else
                    <H4 class="text-center"><strong>Formato de archivo no soportado para previsualizar. Nombre: {{ $data->foto }}</strong></H4>
                @endif
            </div>
        </div>
    @endif
    <br>
    <div class="text-center">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
    </div>
</div>

