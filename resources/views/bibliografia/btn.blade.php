@can('administrador')
    <a href="{{ route('bibliografia.edit', $id) }}" class="btn btn-sm btn-primary"> <i class="fa fa-edit"></i> Editar</a>
    <button type="button" name="delete" id="{{ $id }}" class="delete btn btn-danger btn-sm">Eliminar</button>
@endcan

