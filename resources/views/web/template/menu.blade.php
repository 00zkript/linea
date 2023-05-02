@if($menuGeneral)
    <ul class="navbar-nav mb-lg-0" id="mainNav">
        @foreach($menuGeneral as $m)

            @if(count($m->submenus) > 0)
                <li class="nav-item dropdown" id="{{ $m->idmenu }}">
                    <a href="javascript:void(0);" class="nav-link link-solo dropdown-toggle {{ (empty( !$m->icono) ? 'link-imagen' : 'sin-imagen') }}" data-bs-toggle="dropdown" aria-expanded="false" id="c{{ $m->idmenu}}">
                        @empty(!$m->icono)
                        <figure class="hidden-sm hidden-xs">
                            <img src="{{ asset('panel/img/menu/'.$m->icono) }}">
                        </figure>
                        @endempty
                        <span>{{ $m->nombre }}</span>
                    </a>
                    <ul class="dropdown-menu menu-drop1" aria-labelledby="c{{ $m->idmenu}}">
                            @if($m->ruta_completa != 'javascript::void(0);')
                                <div class="col-12 text-center hidden-sm hidden-xs">
                                    <a href="{{ $m->ruta_completa }}" class="link-todo text-uppercase">Ver todas las categorias</a>
                                </div>
                                <hr class="hidden-sm hidden-xs">
                            @endif


                            @foreach($m->submenus as $m2)
                                @if(count($m2->submenus) > 0)
                                <li class="dropdown2" id="{{ $m2->idmenu}}">
                                    
                                        <a href="{{ $m2->ruta_completa }}" class="dropdown-item {{ (empty( !$m2->icono) ? 'menu-imagen' : 'sin-imagen') }}" data-bs-toggle="dropdown2" aria-expanded="false" id="sc{{ $m2->idmenu}}">
                                            @empty(!$m2->icono)
                                            <figure class="hidden-sm hidden-xs">
                                                <img src="{{ asset( 'panel/img/menu/'.$m2->icono) }}">
                                            </figure>
                                            @endempty
                                            <span>{{ $m2->nombre }}</span>
                                        </a>

                                        <ul class="submenu dropdown-menu" aria-labelledby="sc{{ $m2->idmenu}}">
                                            @foreach($m2->submenus as $m3)
                                                <li id="{{ $m3->idmenu}}">
                                                    <a href="{{ $m3->ruta_completa }}" class="nav-link">
                                                        <span>
                                                            <i class="fa-regular fa-chevron-right icono-menu hidden-sm hidden-xs"></i>
                                                            {{ $m3->nombre}}
                                                        </span>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                </li>
                                @else
                                <li id="{{ $m2->idmenu}}">
                                    <a href="{{ $m2->ruta_completa }}" class="{{ (empty( !$m2->icono) ? 'menu-imagen' : 'sin-imagen') }}" id="sc{{ $m2->idmenu}}">
                                        @empty(!$m2->icono)
                                        <figure class="hidden-sm hidden-xs">
                                            <img src="{{ asset( 'panel/img/menu/'.$m2->icono) }}">
                                        </figure>
                                        @endempty
                                        <span>{{ $m2->nombre }}</span>
                                    </a>
                                </li>
                                @endif

                            @endforeach


                            @if($m->ruta_completa != 'javascript::void(0);')
                                <li class="hidden-md hidden-lg">
                                    <a href="{{ $m->ruta_completa }}" class="link-todo nav-link">Ver todas las categorias</a>
                                </li>
                            @endif

                        </ul>
                </li>
            @else
                <li class="nav-item">
                    <a href="{{ $m->ruta_completa }}" class="nav-link link-solo {{ (empty( !$m->icono) ? 'link-imagen' : 'sin-imagen') }}" id="{{ $m->idmenu }}">
                        @empty(!$m->icono)
                        <figure class="hidden-sm hidden-xs">
                            <img src="{{ asset('panel/img/menu/'.$m->icono) }}">
                        </figure>
                        @endempty
                        <span>{{ $m->nombre }}</span>
                    </a>
                </li>
            @endif

        @endforeach
    </ul>

@endif