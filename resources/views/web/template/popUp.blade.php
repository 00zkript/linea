{{--FIN MODAL NOTIFICAION A TODOS LOS USUARIO ACTIVOS EN LA WEB--}}
@if (request()->routeIs(['web.inicio']))
    <!-- modal home -->
    @if(count($popupsPaginas) > 0)
        <div id="modal-home" class="modal fade modal-home" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content" style="background-color: transparent;">
                    <div class="modal-cabecera">
                        <button type="button" class="close" data-bs-dismiss="modal">×</button>
                    </div>
                    <div class="modal-cuerpo">
                        <aside class="slider popup-home flechas-popup">
                            @foreach ($popupsPaginas as $p)
                                @if ($p->pagina == 'inicio')
                                    <div class="item">
                                        @if (!empty($p->enlace))
                                            <a href="{{ $p->enlace}}" target="_blank">
                                                <img src="{{ asset('panel/img/popup/'.$p->imagen) }}">
                                            </a>
                                        @else
                                            <img src="{{ asset('panel/img/popup/'.$p->imagen) }}">
                                        @endif
                                    </div>
                                @endif
                            @endforeach
                        </aside>
                    </div>
                </div>
            </div>
        </div>

        @push('js')
            <script type="module">
                $(document).ready(function () {
                    // setTimeout (function(){
                        $('#modal-home').modal('show');
                    // },5000);
                });
            </script>
        @endpush

    @endif
    <!-- fin modal home -->


@endif
