<div class="border border-1 ps-md-4 ps-2 pe-md-4 pe-2 pt-4 pb-4 bg-xs-light">
    <h3 class="fw-bold text-center mt-0">Resumen del pedido</h3>
    <hr>

    <div class="row justify-content-center">

        <div class="col-12 pb-lg-3 pb-md-3 pt-lg-3 pt-md-3 pb-1 pt-1">
            <div class="row align-items-center">
                <div class="col-lg-8 col-md-8 col-6">
                    <p class="m-0">{{ $cart->count() }}  {{ $cart->count() == 1 ? 'Item' : 'Items'  }}</p>
                </div>
                <div class="col-lg-4 col-md-4 col-6 ps-0 text-end">
                    <h4 class="fw-bold fs-6 m-0 text-dark">{{ $monedaGeneral->format($cart->total() * $monedaGeneral->cambio,2,".","") }}</h4>
                </div>
            </div>
        </div>


        {{-- <div class="col-12 pb-lg-3 pb-md-3 pt-lg-3 pt-md-3 pb-1 pt-1">
            <div class="row align-items-center">
                <div class="col-lg-8 col-md-8 col-6">
                    <p class="text-secondary m-0 fw-bold">IGV({{ number_format($empresaGeneral->igv,0,".","") }}%)</p>
                </div>
                <div class="col-lg-4 col-md-4 col-6 ps-0 text-end">
                    <h4 class="fw-bold fs-6 m-0">{{ $monedaGeneral->format($cart->total() * $empresaGeneral->igv_porcentaje * $monedaGeneral->cambio,2,".","") }}</h4>
                </div>
            </div>
        </div> --}}

        @if( $descuento > 0 )
            <div class="col-12 pb-lg-3 pb-md-3 pt-lg-3 pt-md-3 pb-1 pt-1">
                <div class="row align-items-center">
                    <div class="col-lg-8 col-md-8 col-6">
                        <p class="text-secondary m-0 fw-bold">Descuento</p>
                    </div>
                    <div class="col-lg-4 col-md-4 col-6 ps-0 text-end">
                        <h4 class="fw-bold fs-6 m-0">- {{ $monedaGeneral->format($descuento * $monedaGeneral->cambio,2,".","") }}</h4>
                    </div>
                </div>
            </div>
        @endif


        @if(session()->has('envio.costoSeleccionado') && session()->get('envio.costoSeleccionado')->precio > 0)
            <div class="col-12 pb-lg-3 pb-md-3 pt-lg-3 pt-md-3 pb-1 pt-1">
                <div class="row align-items-center">
                    <div class="col-lg-8 col-md-8 col-6">
                        <p class="text-secondary m-0 fw-bold">Costo de envío</p>
                    </div>
                    <div class="col-lg-4 col-md-4 col-6 ps-0 text-end">
                        <h4 class="fw-bold fs-6 m-0">{{ $monedaGeneral->format(session()->get('envio.costoSeleccionado')->precio * $monedaGeneral->cambio,2,".","") }}</h4>
                    </div>
                </div>
            </div>
        @endif



        <div class="col-12">
            <hr>
        </div>





        <div class="col-12 pb-lg-3 pb-md-3 pt-lg-3 pt-md-3 pb-1 pt-1">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-6">
                    <p class="text-secondary m-0 fw-bold">Cupón de descuento:</p>
                </div>
                <div class="col-lg-6 col-md-6 col-6 ps-0 text-end">
                    <div class="input-group p-0 input-desct">
                        @if(session()->has('cupon'))
                            <input style="cursor: no-drop" disabled value="{{ session()->get('cupon')->codigo }}" type="text" name="codigo" id="codigo" maxlength="250" placeholder="Ingresar cupón" class="form-control ps-2 rounded-0 alto-chico fs-7">
                            <span class="input-group-btn">
                                <button class="btn btn-primary rounded-0 alto-chico" id="btnRemoverCupon" data-bs-toggle="tooltip" data-bs-placement="top" title="Remover cupón">
                                    <aside><i class="fa-solid fa-layer-minus d-flex"></i></aside>
                                </button>
                            </span>
                        @else
                            <input type="text" name="codigo" id="codigo" maxlength="250" placeholder="Ingresar cupón" class="form-control ps-2 rounded-0 alto-chico fs-7">
                            <span class="input-group-btn">
                                <button class="btn btn-primary rounded-0 alto-chico" id="btnAplicarCupon" data-bs-toggle="tooltip" data-bs-placement="top" title="Aplicar cupón">
                                    <aside><i class="fas fa-tags d-flex"></i></aside>
                                </button>
                            </span>
                        @endif

                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 pb-lg-3 pb-md-3 pt-lg-3 pt-md-3 pb-1 pt-1">
            <div class="accordion accordion-flush" id="tarifaEnvio">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flushEnvio">
                        <button class="accordion-button p-0 text-secondary {{ session()->has('envio.costoSeleccionado') ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseEnvio" aria-expanded="false" aria-controls="flush-collapseEnvio">Costo de Envío</button>
                    </h2>
                    <div id="flush-collapseEnvio" class="accordion-collapse collapse {{ session()->has('envio.costoSeleccionado') ? '' : 'show' }}" aria-labelledby="flushEnvio" data-bs-parent="#tarifaEnvio">
                        <div class="col-12 pb-lg-3 px-0 pb-md-3 pt-lg-3 pt-md-3 pb-1 pt-1">
                            <div class="row align-items-center">
                                <div class="col-lg-6 col-md-6 col-6">
                                    <p class="text-secondary m-0">Departamento:</p>
                                </div>
                                <div class="col-lg-6 col-md-6 col-6 ps-0 text-end text-liston mb-0">
                                    <aside class="custom-select">
                                        <select  name="iddepartamento" id="iddepartamento" class="form-control ps-2 rounded-0 alto-chico fs-7 text-secondary">
                                            <option value="" hidden selected>[--Seleccione--]</option>
                                            @foreach($departamentos AS $d)
                                                @if(session()->has('envio.iddepartamento') && $d->iddepartamento == session()->get('envio.iddepartamento'))
                                                    <option selected value="{{ $d->iddepartamento}}">{{ $d->nombre}}</option>
                                                @else
                                                    <option  value="{{ $d->iddepartamento}}">{{ $d->nombre}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <i class="fa-solid fa-sort-down"></i>
                                    </aside>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 pb-lg-3 px-0 pb-md-3 pt-lg-3 pt-md-3 pb-1 pt-1">
                            <div class="row align-items-center">
                                <div class="col-lg-6 col-md-6 col-6">
                                    <p class="text-secondary m-0">Provincia:</p>
                                </div>
                                <div class="col-lg-6 col-md-6 col-6 ps-0 text-end text-liston mb-0">
                                    <aside class="custom-select">
                                        <select  name="idprovincia" id="idprovincia" class="form-control ps-2 rounded-0 alto-chico fs-7 text-secondary">
                                            <option value="" hidden selected>[--Seleccione--]</option>
                                            @if(session()->has('envio.idprovincia'))
                                                @foreach($provincias AS $p)
                                                    <option {{session()->get('envio.idprovincia') == $p->idprovincia ? 'selected': ''}}
                                                            value="{{ $p->idprovincia}}">{{ $p->nombre}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <i class="fa-solid fa-sort-down"></i>
                                    </aside>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 pb-lg-3 px-0 pb-md-3 pt-lg-3 pt-md-3 pb-1 pt-1">
                            <div class="row align-items-center">
                                <div class="col-lg-6 col-md-6 col-6">
                                    <p class="text-secondary m-0">Distrito:</p>
                                </div>
                                <div class="col-lg-6 col-md-6 col-6 ps-0 text-end text-liston mb-0">
                                    <aside class="custom-select">
                                        <select  name="iddistrito" id="iddistrito"  class="form-control ps-2 rounded-0 alto-chico fs-7 text-secondary">
                                            <option value="" hidden selected>[--Seleccione--]</option>
                                            @if(session()->has('envio.iddistrito'))
                                                @foreach($distritos AS $d)
                                                    <option {{session()->get('envio.iddistrito') == $d->iddistrito ? 'selected': ''}}
                                                            value="{{ $d->iddistrito}}">{{ $d->nombre}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <i class="fa-solid fa-sort-down"></i>
                                    </aside>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="col-12 pb-lg-3 px-0 pb-md-3 pt-lg-3 pt-md-3 pb-1 pt-1">
                            <div class="row align-items-center justify-content-end">
                                <div class="col-lg-6 col-md-6 col-12 ps-md-0">
                                    <button class="btn btn-secondary w-100" id="btnCalcularEnvio">Calcular envío</button>
                                </div>
                            </div>
                        </div> --}}

                        <div class="col-12 px-0" style="display: {{ session()->has('envio.costosEnvio') ? '' : 'none' }};">
                            <p class="text-danger fw-bold">Seleccione una tarifa de envío:</p>

                            <div class="costoEnvioDiv mb-md-0 mb-4">
                                @if(session()->has('envio.costosEnvio'))
                                @foreach(session()->get('envio.costosEnvio') AS $costosEnvio)
                                    <div class="radio">
                                        <input type="radio" id="idcosto_envio_{{ $costosEnvio->idcosto_envio}}" name="idcosto_envio" value="{{ $costosEnvio->idcosto_envio}}" class="chckCostoEnvio form-control" {{ session()->has('envio.costoSeleccionado') && session()->get('envio.costoSeleccionado')->idcosto_envio == $costosEnvio->idcosto_envio ? 'checked' : '' }}>
                                        <label for="idcosto_envio_{{ $costosEnvio->idcosto_envio}}">
                                            <span>{{ $costosEnvio->precio > 0 ? $monedaGeneral->format($costosEnvio->precio * $monedaGeneral->cambio) : '' }}</span>
                                            <br>
                                            <span class="bg-light bg-gradient text-dark d-block p-1 fs-7">Nota: {!! $costosEnvio->restriccion !!}</span>
                                        </label>
                                    </div>

                                    @if(!$loop->last)
                                        <hr>
                                    @endif
                                @endforeach
                                @endif
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>


        <div class="col-12 pb-lg-3 pb-md-3 pt-lg-3 pt-md-3 pb-1 pt-1">
            <div class="row align-items-center">
                <div class="col-lg-8 col-md-8 col-6">
                    <h4 class="text-dark fs-6 m-0 fw-bold">TOTAL</h4>
                </div>
                <div class="col-lg-4 col-md-4 col-6 ps-0 text-end">
                    <h4 class="fw-bold fs-6 m-0 text-dark">{{ $monedaGeneral->format($totalNeto * $monedaGeneral->cambio,2,".","") }}</h4>
                </div>
            </div>
        </div>


        <div class="col-12 pb-lg-3 pb-md-3 pt-lg-3 pt-md-3 pt-3">
            <a href="{{ route('web.venta.usuario.index') }}" id="pasarAPagar" class="btn btn-primary w-100 pt-3 pb-3 rounded-2 {{-- session()->has('envio.costoSeleccionado')?'':'disabled' --}}"><i class="fas fa-shopping-cart pe-3"></i> <span>PAGAR</span></a>
        </div>
        <div class="col-12 pb-lg-3 pt-lg-0 pt-3 hidden-lg hidden-md">
            <a href="{{ route('web.productos') }}" class="btn btn-dark w-100 pt-3 pb-3"><i class="fas fa-angle-left pe-3"></i> <span>SEGUIR COMPRANDO</span></a>
        </div>
    </div>
</div>
