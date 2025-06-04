@extends('theme.layout')

@section('contenido')

    <div id="content">
        <section id="widget-grid" class="">
            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget" id="wid-id-usuario-create" data-widget-deletebutton="false" data-widget-editbutton="false" data-widget-custombutton="false">
                 <header>
                    <span class="widget-icon"> <i class="fa fa-user-plus"></i> </span>
                    <h2>Crear Nuevo Usuario</h2>
                </header>
                <!-- widget div-->
                <div>
                    <!-- widget content -->
                    <div class="widget-body no-padding">

                        <div class="container">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('usuario.store') }}" class="smart-form">
                                @csrf

                                <fieldset>
                                    <div class="row">
                                        <section class="col col-10">
                                            <label class="input"> <i class="icon-append fa fa-user"></i>
                                                <input type="text" name="names" value="{{ old('names') }}" required placeholder="Nombre y Apellido">
                                            </label>
                                        </section>
                                    </div>

                                    <div class="row">
                                        <section class="col col-10">
                                            <label class="input"> <i class="icon-append fa fa-user"></i>
                                                <input type="text" name="username" value="{{ old('username') }}" required placeholder="Usuario">
                                            </label>
                                        </section>
                                    </div>

                                    <div class="row">
                                        <section class="col col-10">
                                            <label class="input"> <i class="icon-append fa fa-envelope"></i>
                                                <input type="email" name="email" value="{{ old('email') }}" required placeholder="Email">
                                            </label>
                                        </section>
                                    </div>

                                    <div class="row">
                                        <section class="col col-10">
                                            <label class="input"> <i class="icon-append fa fa-lock"></i>
                                                <input type="password" name="password" required placeholder="Contraseña">
                                            </label>
                                        </section>
                                    </div>

                                    <div class="row">
                                        <section class="col col-10">
                                             <label class="input"> <i class="icon-append fa fa-lock"></i>
                                                <input type="password" name="password_confirmation" required placeholder="Confirmar Contraseña">
                                            </label>
                                        </section>
                                    </div>

                                     <div class="row">
                                        <section class="col col-6">
                                            <select class="form-control" id="role_id" name="role_id">
                                                <option value="">Seleccionar Rol</option>
                                                @foreach($roles as $role)
                                                    <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                                                @endforeach
                                            </select>
                                        </section>
                                    </div>
                                </fieldset>

                                <footer>
                                    <button type="submit" class="btn btn-primary">Crear Usuario</button>
                                    <a href="{{ route('usuario.index') }}" class="btn btn-secondary">Cancelar</a>
                                </footer>

                            </form>
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