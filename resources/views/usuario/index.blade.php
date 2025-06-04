@extends('theme.layout')

@section('contenido')

    <div id="content">
        <section id="widget-grid" class="">
            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget" id="wid-id-usuario-list" data-widget-deletebutton="false" data-widget-editbutton="false" data-widget-custombutton="false">
                 <header>
                    <span class="widget-icon"> <i class="fa fa-users"></i> </span>
                    <h2>Listado de Usuarios</h2>
                </header>
                <!-- widget div-->
                <div>
                    <!-- widget content -->
                    <div class="widget-body no-padding">

                        <div class="container">
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @can('manage-users')
                                <a href="{{ route('usuario.create') }}" class="btn btn-primary mb-3">Crear Nuevo Usuario</a>
                            @endcan

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Usuario</th>
                                        <th>Email</th>
                                        <th>Rol</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users ?? '' as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->names }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->role->name ?? 'Sin rol' }}</td>
                                        <td>
                                            @can('manage-users')
                                                <a href="{{ route('usuario.edit', $user->id) }}" class="btn btn-sm btn-warning">Editar</a>
                                                {{-- Botón Eliminar con AJAX --}}
                                                <button type="button" class="btn btn-sm btn-danger delete-user" data-id="{{ $user->id }}">Eliminar</button>
                                            @endcan
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <!-- end widget content -->

                </div>
                <!-- end widget div -->

            </div>
            <!-- end widget -->
        </section>
    </div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Manejar clic en botón Eliminar usuario
        $('.delete-user').on('click', function() {
            var user_id = $(this).data('id');
            var token = $("meta[name='csrf-token']").attr("content");

            if (confirm("¿Estás seguro de que quieres eliminar este usuario?")) {
                $.ajax({
                    url: "/usuario/" + user_id, // Ruta de eliminación
                    type: 'DELETE',
                    data: {
                        "_token": token,
                        "_method": "DELETE",
                    },
                    success: function (response) {
                        // Recargar la página o eliminar la fila de la tabla
                        window.location.reload(); // Opcional: recargar la página para simplicidad
                        // O si usas DataTables, recargar la tabla:
                        // $('#tu_tabla_de_usuarios').DataTable().ajax.reload();

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
                             alert('Hubo un error al intentar eliminar el usuario.');
                        }
                        console.error(xhr.responseText);
                    }
                });
            }
        });
    });
</script>
@endsection
