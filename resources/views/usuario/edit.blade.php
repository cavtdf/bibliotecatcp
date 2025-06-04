@extends('theme.layout')

@section('contenido')

    <div id="content">
    <section id="widget-grid" class="">
        <!-- Widget ID (each widget will need unique ID)-->
        <div class="jarviswidget" id="wid-id-3" data-widget-deletebutton="false" data-widget-editbutton="false" data-widget-custombutton="false">
             <header>
                <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                <h2>Modificar Rol</h2>
            </header>
            <div class="row">
                @if(session()->has('message.level'))
                    <div class="alert alert-{{ session('message.level') }}">
                        {!! session('message.content') !!}
                    </div>
                @endif
            </div>
            <!-- widget div-->
            <div>
                <!-- widget content -->
                <div class="widget-body no-padding">
                    <form method="POST" action="{{ route('usuario.update', $user->id) }}" id="order-form" class="smart-form" autocomplete="off" novalidate="novalidate" enctype="multipart/form-data">
                        @csrf @method("put")
                        <header>
                            Asignaci{on de Roles a usuarios}
                        </header>
                        <fieldset>

                            <div class="row">
                                <section class="col col-10">
                                    <label class="input"> <i class="icon-append fa fa-user"></i>
                                        <input type="text" name="names" value="{{old('names', $user->names ?? '')}}" placeholder="Nombre y Apellido">
                                    </label>
                                </section>
                            </div>

                            <div class="row">
                                <section class="col col-10">
                                    <label class="input"> <i class="icon-append fa fa-user"></i>
                                        <input type="text" name="username" value="{{old('username', $user->username ?? '')}}" placeholder="Usuario">
                                    </label>
                                </section>
                            </div>

                            <div class="row">
                                <section class="col col-10">
                                    <label class="input"> <i class="icon-append fa fa-envelope"></i>
                                        <input type="email" name="email" value="{{old('email', $user->email ?? '')}}" placeholder="Email">
                                    </label>
                                </section>
                            </div>

                        </fieldset>
                        <fieldset>
                            <div class="row">
                                <section class="col col-6">
                                    <select class="form-control" name="role_id" id="role_id">
                                        <option value="">Seleccionar Rol</option>
                                            @foreach($roles as $key => $value)
                                            <option {{$value->id == $user->role_id ? 'selected' : ''}} value="{{$value->id}}">{{$value->name}}</option>
                                            @endforeach
                                    </select>
                                </section>

                            </div>
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

