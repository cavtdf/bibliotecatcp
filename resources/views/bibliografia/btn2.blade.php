@can('request-prestamo')
    @if($estado_prestamo == 'DISPONIBLE')
        <a href="{{ route('prestamo.show', $id) }}" name="solicitar" id="prestar" class="btn btn-sm btn-primary solicitar"> <i class="fa fa-edit"></i>Solicitar</a>
    @else
        {{ $estado_prestamo }}
    @endif
@endcan
