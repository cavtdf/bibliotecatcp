<!-- #NAVIGATION -->
<!-- Left panel : Navigation area -->
<!-- Note: This width of the aside area can be adjusted through LESS/SASS variables -->
<aside id="left-panel">

    <!-- User info -->
    <div class="login-info">
        <span> <!-- User image size is adjusted inside CSS, it should stay as is -->

            <a href="javascript:void(0);" id="show-shortcut" data-action="toggleShortcut">
                <img src="tcp/img/avatars/sunny.png" alt="yo" class="online">
                <span>
                   @auth
                         {{ Auth::user()->names }}
                   @endauth
                </span>
                <i class="fa fa-angle-down"></i>
            </a>

        </span>
    </div>

    <nav>
        <ul>
            <li class="">

                <a href="{{ route ('inicio') }}" title="Volver al inicio"><i class="fa fa-lg fa-fw fa-home"></i> <span class="menu-item-parent">Inicio</span></a>

            </li>
            <li class="">
                <a href="#"><i class="fa fa-lg fa-fw fa fa-book"></i> <span class="menu-item-parent">Biblioteca</span><b class="collapse-sign"><em class="fa fa-minus-square-o"></em></b></a>
                <ul style="display: none;">
                    <li>
                        <a href="{{ route ('bibliografia.index') }}">Bibliografía</a>
                    </li>
                    <li>
                        <a href="{{ route ('vencido.index') }}">Prestamos Vencidos</a>
                    </li>
                    @can('usuario')
                    <li>
                        <a href="{{ route ('libro.index') }}">Bibliografia solicitada</a>
                    </li>
                    @endcan
                    <li>
                        <a href="{{ route ('bibliografia.index') }}">Solicitar Prestamo</a>
                    </li>
                    @can('administrador')
                        <li>
                            <a href="{{ route ('devolucion.index') }}">Devoluciones</a>
                        </li>
                    @endcan
                </ul>
            </li>

            @can('administrador')
            <li class="">
                <a href="#"><i class="fa fa-lg fa-fw fa-sitemap"></i> <span class="menu-item-parent">Nomencladores</span><b class="collapse-sign"><em class="fa fa-plus-square-o"></em></b></a>
                <ul style="display: none;">
                    <li>
                        <a href="{{ route ('categoria.index') }}">Categorías</a>
                    </li>
                    <li>
                        <a href="{{ route ('editorial.index') }}">Editoriales</a>
                    </li>
                    <li>
                        <a href="{{ route ('autor.index') }}">Autores</a>
                    </li>
                    <li>
                        <a href="{{ route ('horario.index') }}">Horarios de Atención</a>
                    </li>
                    <li>
                        <a href="{{ route ('material.index') }}">Tipos de material Bibliográfico</a>
                    </li>
                    <li>
                        <a href="{{ route ('estado.index') }}">Estados del Material Bibliográfico</a>
                    </li>
                    <li>
                        <a href="{{ route ('limite.index') }}">Administrar Límites de Días</a>
                    </li>

                    <li>
                        <a href="{{ route ('movimiento.index') }}">Tipo de Movimientos</a>
                    </li>
                    <li>
                        <a href="{{ route ('ubicacion.index') }}">Ubicaciones</a>
                    </li>
                </ul>
            </li>
            @endcan
            @can('administrador')
                <li class="">
                    <a href="#"><i class="fa fa-lg fa-fw fa fa-user"></i> <span class="menu-item-parent">Usuarios</span><b class="collapse-sign"><em class="fa fa-minus-square-o"></em></b></a>
                    <ul style="display: none;">
                        <li>
                            <a href="{{ route ('usuario.index') }}">Roles</a>
                        </li>

                    </ul>
                </li>
            @endcan
        </ul>
    </nav>

    <span class="minifyme" data-action="minifyMenu"> <i class="fa fa-arrow-circle-left hit"></i> </span>

</aside>
<!-- END NAVIGATION -->
