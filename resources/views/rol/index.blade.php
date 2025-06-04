@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Listado de Roles</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    {{-- Asumiendo que solo los administradores pueden gestionar roles --}}
    @can('administrador')
        <a href="{{ route('rol.create') }}" class="btn btn-primary mb-3">Crear Nuevo Rol</a>
    @endcan

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($roles as $rol)
            <tr>
                <td>{{ $rol->id }}</td>
                <td>{{ $rol->name }}</td>
                <td>
                    @can('administrador')
                        <a href="{{ route('rol.edit', $rol->id) }}" class="btn btn-sm btn-warning">Editar</a>
                        {{-- Botón Eliminar con AJAX --}}
                        <button type="button" class="btn btn-sm btn-danger delete-rol" data-id="{{ $rol->id }}">Eliminar</button>
                    @endcan
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Manejar clic en botón Eliminar rol
        $('.delete-rol').on('click', function() {
            var rol_id = $(this).data('id');
            var token = $("meta[name='csrf-token']").attr("content");

            if (confirm("¿Estás seguro de que quieres eliminar este rol?")) {
                $.ajax({
                    url: "/rol/" + rol_id,
                    type: 'DELETE',
                    data: {
                        "_token": token,
                        "_method": "DELETE",
                    },
                    success: function (response) {
                        // Recargar la página o eliminar la fila de la tabla
                        window.location.reload(); // Recargar la página para simplicidad

                        // Mostrar mensaje de éxito
                        if(response.message){
                            alert(response.message);
                        }
                    },
                    error: function (xhr, status, error) {
                         // Mostrar mensaje de error
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            alert('Error: ' + xhr.responseJSON.message);
                        } else {
                             alert('Hubo un error al intentar eliminar el rol.');
                        }
                        console.error(xhr.responseText);
                    }
                });
            }
        });
    });
</script>
@endsection 