@extends('panel.template.index')
@section('cuerpo')
    @include('panel.producto.crear')
    @include('panel.producto.editar')
    @include('panel.producto.habilitar')
    @include('panel.producto.inhabilitar')
    @include('panel.producto.eliminar')
    @include('panel.producto.eliminarChck')
    @include('panel.producto.ver')
    @include('panel.producto.importarProductos')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background-color: #2a3f54">
                        <p style="font-size: 20px" class="card-title text-center text-white mb-0"> Gestionar productos</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 text-right">
                                <button id="btnModalImportar" class="btn btn-success btn-lg"><i class="fa fa-file-excel-o"></i> Importar Productos</button>
                                <button id="btnModalCrear" class="btn btn-primary btn-lg"><i class="fa fa-plus"></i> Nuevo registro</button>
                            </div>
                            <div class="col-md-6 col-md-12">
                                <div class="form-group">
                                    <label for="cantidadRegistros">Cantidad de registros</label>
                                    <select name="cantidadRegistros" id="cantidadRegistros" class="form-control form-control-sm">
                                        <option value="10" selected>10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                        <option value="9999999">Todos</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 my-2">
                                <form id="frmBuscar">
                                    @csrf
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="text" id="txtBuscar" name="txtBuscar" class="form-control" placeholder="Buscar...">
                                            <div class="input-group-append">
                                                <button class="btn btn-secondary"><i class="fa fa-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="col-12" id="listado">
                                @include('panel.producto.listado')
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('js')
    <script >

        const URL_LISTADO     = "{{ route('productos.listar') }}";
        const URL_GUARDAR     = "{{ route('productos.store') }}";
        const URL_VER         = "{{ route('productos.show','show') }}";
        const URL_EDIT        = "{{ route('productos.edit','edit') }}";
        const URL_MODIFICAR   = "{{ route('productos.update','update') }}";
        const URL_HABILITAR   = "{{ route('productos.habilitar') }}";
        const URL_INHABILITAR = "{{ route('productos.inhabilitar') }}";
        const URL_ELIMINAR    = "{{ route('productos.destroy','destroy') }}";

        const URL_IMAGEN_UPLOAD  = "{{ route('productos.imagen.upload') }}";
        const URL_IMAGEN_UPDATE = "{{ route('productos.imagen.update') }}";
        const URL_IMAGEN_SORT   = "{{ route('productos.imagen.sort') }}";
        const URL_IMAGEN_REMOVE  = "{{ route('productos.imagen.remove') }}";

        const URL_MANUAL_UPLOAD  = "{{ route('productos.manual.upload') }}";
        const URL_MANUAL_UPDATE = "{{ route('productos.manual.update') }}";
        const URL_MANUAL_REMOVE = "{{ route('productos.manual.remove') }}";

        const URL_IMPORTAR_PRODUCTOS = "{{ route('productos.importarProductos') }}";
        const URL_RESOURCES = "{{ route('productos.getResources') }}";
        const URL_GET_PRODUCTOS = "{{ route('producto.getProductos') }}";

        const dataLists = {
            attributes: [],
        }

        const filtros = () => {

            $(document).on("click","a.page-link",function(e) {
                e.preventDefault();
                const url = e.target.href;
                const paginaActual = url.split("?pagina=")[1];
                const cantidadRegistros = $("#cantidadRegistros").val();
                const txtBuscar = $("#txtBuscar").val();

                listado(cantidadRegistros,paginaActual,txtBuscar);
            });

            $(document).on("change", "#cantidadRegistros", function(e) {
                e.preventDefault();
                const paginaActual = $("#paginaActual").val();
                const cantidadRegistros = e.target.value;
                const txtBuscar = $("#txtBuscar").val();

                listado(cantidadRegistros,paginaActual,txtBuscar);
            });

            $(document).on("submit", "#frmBuscar", function(e) {
                e.preventDefault();
                const txtBuscar = $("#txtBuscar").val();
                const cantidadRegistros = $("#cantidadRegistros").val();
                listado(cantidadRegistros,1);
            });

        }

        const listado = async (cantidadRegistros = 10,paginaActual = 1) => {
            cargando();

            const form = {
                cantidadRegistros : cantidadRegistros,
                paginaActual : paginaActual,
                txtBuscar : $("#txtBuscar").val().trim(),
            }

            try{
                const response = await axios.post(URL_LISTADO, form );
                const data = response.data;

                stop();
                document.querySelector("#listado").innerHTML = data;


            }catch(error){
                errorCatch(error);
            }


        }

        const controlTabs = () => {
            $(document).on('click','.nav-link', function (e){
                e.preventDefault();
                const el = $(this);
                const content = el.attr('href');
                const form = el.closest('form');
                const _class = form.attr('id') == 'frmCrear' ? 'content-create' : 'content-edit';


                $('.nav-link').removeClass('active');
                $('.'+_class).hide();

                el.addClass('active');
                $(content).show();


            });

        }

        const guardar = () => {
            $(document).on("submit","#frmCrear",function(e){
                e.preventDefault();
                var form = new FormData($(this)[0]);
                form.append('descripcionCorta',CKEDITOR.instances.descripcionCorta.getData());
                form.append('descripcion',CKEDITOR.instances.descripcion.getData());
                form.append('ficha_tecnica',CKEDITOR.instances.ficha_tecnica.getData());
                form.append('video',CKEDITOR.instances.video.getData());

                cargando('Procesando...');
                axios.post(URL_GUARDAR,form)
                    .then(response => {
                        const data = response.data;
                        stop();

                        $("#imagen").fileinput("upload");
                        $("#manual").fileinput("upload");

                        $("#modalCrear").modal("hide");
                        notificacion("success","Registro exitoso",data.mensaje);
                        listado();

                    })
                    .catch(errorCatch)




            });
        }

        const modificar = () => {
            $(document).on("submit","#frmEditar",function(e){
                e.preventDefault();

                var form = new FormData($(this)[0]);
                form.append('descripcionCortaEditar',CKEDITOR.instances.descripcionCortaEditar.getData());
                form.append('descripcionEditar',CKEDITOR.instances.descripcionEditar.getData());
                form.append('ficha_tecnicaEditar',CKEDITOR.instances.ficha_tecnicaEditar.getData());
                form.append('videoEditar',CKEDITOR.instances.videoEditar.getData());

                cargando('Procesando...');
                axios.post(URL_MODIFICAR,form)
                    .then(response => {
                        const data = response.data;
                        $("#imagenEditar").fileinput("upload");
                        $("#manualEditar").fileinput("upload");

                        stop();
                        $("#modalEditar").modal("hide");
                        notificacion("success","Modificación exitosa",data.mensaje);
                        listado($("#cantidadRegistros").val(),$("#paginaActual").val());

                    })
                    .catch(errorCatch)


            });
        }

        const habilitar = () => {
            $(document).on( "submit" ,"#frmHabilitar", function(e){
                e.preventDefault();
                var form = new FormData($(this)[0]);
                cargando('Procesando...');

                axios.post(URL_HABILITAR,form)
                    .then( response => {
                        const data = response.data;
                        stop();

                        $("#modalHabilitar").modal("hide");

                        notificacion("success","Habilitado",data.mensaje);

                        listado($("#cantidadRegistros").val(),$("#paginaActual").val());

                    })
                    .catch( errorCatch )


            } )

        }

        const inhabilitar = () => {
            $(document).on( "submit","#frmInhabilitar" , function(e){
                e.preventDefault();

                var form = new FormData($(this)[0]);

                cargando('Procesando...');

                axios.post(URL_INHABILITAR,form)
                    .then( response => {
                        const data = response.data;
                        stop();
                        $("#modalInhabilitar").modal("hide");

                        notificacion("success","Inhabilitado",data.mensaje);

                        listado($("#cantidadRegistros").val(),$("#paginaActual").val());

                    } )
                    .catch( errorCatch )

            } )
        }

        const eliminar = () => {
            $(document).on( "submit","#frmEliminar" , function(e){
                e.preventDefault();

                var form = new FormData($(this)[0]);

                cargando('Procesando...');

                axios.post(URL_ELIMINAR,form)
                    .then( response => {
                        const data = response.data;
                        stop();
                        $("#modalEliminar").modal("hide");

                        notificacion("success","Eliminado",data.mensaje);

                        listado($("#cantidadRegistros").val(),$("#paginaActual").val());

                    } )
                    .catch( errorCatch )

            } )
        }

        const sortImagenes = () => {

            $("#imagenEditar").on('filesorted', function(e, params) {
                e.preventDefault();
                let stack = params.stack;

                axios.post(URL_IMAGEN_SORT, {
                    stack : JSON.stringify(stack)
                })
                .then( response => {
                    const data = response.data;
                    console.log(data.mensaje);
                })
                .catch( error => {
                    const response = error.response;
                    const data = response.data;

                    console.log(data);
                })


            });

        }

        const importarProductos = () => {
            $(document).on("submit","#frmImportarProductos",function(e){
                e.preventDefault();
                var form = new FormData($(this)[0]);

                cargando('Procesando...');
                axios.post(URL_IMPORTAR_PRODUCTOS,form)
                .then(response => {
                    const data = response.data;
                    stop();

                    $("#modalImportarProductos").modal("hide");
                    notificacion("success","Registro exitoso",data.mensaje);
                    listado();

                })
                .catch(errorCatch)




            });
        }

        const getResources = () => {
            return axios({
                method: 'get',
                url: URL_RESOURCES,
            }).then( response => {
                const data = response.data;
                dataLists.attributes = data.atributos;
            })
        }

        const addAttribute = ({tbody}) => {

            const template = function (name){
                const tr = document.createElement("tr");
                tr.innerHTML = (`
                    <tr>
                        <td>
                            <select name="${name}[idatributo]" class="form-control a-idatributo" required >
                                <option value="" hidden="">[--Seleccion--]</option>
                                ${ dataLists.attributes.map(atributo => `<option value="${atributo.idatributo}">${atributo.nombre}</option>`).join('') }
                            </select>
                        </td>
                        <td><input type="text" name="${name}[valor]" class="form-control a-valor" placeholder="Valor"></td>
                        <td> <button type="button" class="btn btn-xs btn-danger removeAttribute"><i class="fa fa-trash"></i></button> </td>
                    </tr>
                `);

                return tr;
            }

            const key = str_random(10);
            const collectName = tbody.dataset.collect;
            const tr = template(collectName+"["+key+"]");
            tbody.appendChild(tr);

            return Promise.resolve(tr);
        }

        const actionsAttribute = () => {
            $(document).on('click','.addAttribute,.addAttributeEditar',function (e){
                e.preventDefault();
                const form = this.closest('form');
                const tbody = form.querySelector(".table-attribute tbody");

                addAttribute({
                    accion : form.id === "frmCrear" ? "crear" : "editar",
                    tbody : tbody,
                });

            })

            $(document).on('click','.removeAttribute,.removeAttributeEditar',function (e){
                e.preventDefault();
                const tr = $(this).closest("tr");
                tr.remove();
            })

        }


        const getProductos = ({ accion = 'crear', valorActual = null }) => {
            const selector = accion === 'crear' ? '#idproductoRelacionado' : '#idproductoRelacionadoEditar';

            return axios.get(URL_GET_PRODUCTOS)
                .then( response => {
                    const data = response.data;
                    let html;
                    // let html = `<option value="" hidden >Sin producto relacionado</option>`;
                    for (const producto of data) {
                        html += `<option value="${ producto.idproducto }" >${ producto.nombre } (${ producto.idproducto.toString().padStart(7,0) })</option>`;
                    }
                    $(selector).html(html);

                    $(selector).selectpicker('refresh');
                    $(selector).selectpicker('val', valorActual);

                })
                .catch( errorCatch );
        }


        const modales = () => {

            $(document).on("click","#btnModalCrear",function (e) {
                e.preventDefault();
                $("#frmCrear span.error").remove();
                $("#frmCrear .selectpicker").selectpicker("val",null);
                $("#frmCrear")[0].reset();

                $('.content-create').hide();
                $('#frmCrear .nav-link').removeClass('active');
                $('#frmCrear .nav-link:eq(0)').addClass('active');
                $('#frmCrear .content-create:eq(0)').show();

                $('#listOption').html('');

                CKEDITOR.instances.descripcion.setData('');
                CKEDITOR.instances.ficha_tecnica.setData('');
                CKEDITOR.instances.video.setData('');

                const tbodyAtribute = document.querySelector("#frmCrear tbody");
                tbodyAtribute.innerHTML = '';
                addAttribute({
                    tbody : tbodyAtribute,
                });

                getProductos({ accion: 'crear' });

                $("#modalCrear").modal("show");
            });

            $(document).on("click",".btnModalHabilitar",function(e){
                e.preventDefault();
                var idproducto = $(this).closest('div.dropdown-menu').data('idproducto');
                $("#frmHabilitar input[name=idproducto]").val(idproducto);
                $("#modalHabilitar").modal("show");
            });

            $(document).on("click",".btnModalInhabilitar",function(e){
                e.preventDefault();
                var idproducto = $(this).closest('div.dropdown-menu').data('idproducto');
                $("#frmInhabilitar input[name=idproducto]").val(idproducto);
                $("#modalInhabilitar").modal("show");
            });

            $(document).on("click",".btnModalEliminar",function(e){
                e.preventDefault();
                var idproducto = $(this).closest('div.dropdown-menu').data('idproducto');
                $("#frmEliminar input[name=idproducto]").val(idproducto);
                $("#modalEliminar").modal("show");
            });

            $(document).on("click",".btnModalEditar",function(e){
                e.preventDefault();
                var idproducto = $(this).closest('div.dropdown-menu').data('idproducto');


                cargando('Procesando...');
                axios({
                    url: URL_EDIT,
                    method : 'get',
                    params: {idproducto : idproducto}
                })
                    .then(response => {
                        let data = response.data;

                        stop();
                        $("#frmEditar")[0].reset();
                        $("#frmEditar span.error").remove();
                        $('.content-edit').hide();
                        $('#frmEditar .nav-link').removeClass('active');
                        $('#frmEditar .nav-link:eq(0)').addClass('active');
                        $('#frmEditar .content-edit:eq(0)').show();


                        $("#idproducto").val(data.idproducto);
                        $("#idcategoriaEditar").selectpicker("val",data.idcategoria);
                        $("#idsectionEditar").selectpicker("val",data.idsection);
                        $("#idmarcaEditar").selectpicker("val",data.idmarca);
                        $("#codigoEditar").val(data.codigo);
                        $("#nombreEditar").val(data.nombre);
                        $("#precioEditar").val(data.precio);
                        $("#precio_promocionalEditar").val(data.precio_promocional);
                        $("#stockEditar").val(data.stock);
                        $("#destacadoEditar").val(data.destacado);
                        $("#nuevoEditar").val(data.nuevo);
                        $("#liquidacionEditar").val(data.liquidacion);
                        $("#showPrecioEditar").val(data.show_precio);

                        const tbodyAttribute = document.querySelector("#table-attributeEditar tbody")
                        tbodyAttribute.innerHTML = "";
                        for (let atributo of data.atributos) {

                            addAttribute({
                                tbody : tbodyAttribute,
                            })
                                .then( tr => {
                                    tr.querySelector(".a-idatributo").value = atributo.idatributo;
                                    tr.querySelector(".a-valor").value = atributo.pivot.valor;
                                });
                        }

                        getProductos({ accion: 'editar', valorActual: data.productos_relacionados_pivot.map( ele => ele.idproducto_relacionado) });


                        $("#telefonoVentaEditar").val(data.telefonoVenta);

                        const imagenes = allFilesData( BASE_URL+"/panel/img/producto", data.imagenes);

                        $("#imagenEditar")
                            .fileinput('destroy')
                            .fileinput({
                                dropZoneTitle:'Arrastre las imágenes aquí',
                                fileActionSettings: {
                                    showRemove: true,
                                    showUpload: false,
                                    showZoom: true,
                                    showDrag: true,
                                },
                                initialPreview: imagenes.urls,
                                initialPreviewConfig: imagenes.settings,
                                uploadUrl: URL_IMAGEN_UPDATE,
                                uploadExtraData: {
                                    idproducto : idproducto
                                },
                                deleteUrl: URL_IMAGEN_REMOVE,
                            });



                        const manuales = allFilesData( BASE_URL+"/panel/img/manuales", data.manuales, 'pdf' );

                        $("#manualEditar")
                            .fileinput('destroy')
                            .fileinput({
                                dropZoneTitle:'Arrastre los manuales aquí',
                                fileActionSettings: {
                                    showRemove: true,
                                    showUpload: false,
                                    showZoom: false,
                                    showDrag: false,
                                },
                                initialPreview: manuales.urls,
                                initialPreviewConfig: manuales.settings,
                                allowedFileTypes: ['pdf'],
                                uploadUrl: URL_MANUAL_UPDATE,
                                uploadExtraData: {
                                    idproducto : idproducto
                                },
                                deleteUrl: URL_MANUAL_REMOVE,
                            })

                        CKEDITOR.instances.descripcionEditar.setData(data.descripcion);
                        CKEDITOR.instances.descripcionCortaEditar.setData(data.descripcion_corta);
                        CKEDITOR.instances.ficha_tecnicaEditar.setData(data.ficha_tecnica);
                        CKEDITOR.instances.videoEditar.setData(data.video);

                        $("#estadoEditar").val(data.estado);

                        $("#modalEditar").modal("show");
                    })
                    .catch(errorCatch)

            });

            $(document).on("click","#btnModalImportar",function(e){
                e.preventDefault();

                $("#frmImportarProductos")[0].reset();
                $("#modalImportarProductos").modal("show");

            });

            $(document).on("click",".btnModalVer",function(e){
                e.preventDefault();
                var idproducto = $(this).closest('div.dropdown-menu').data('idproducto');

                cargando('Procesando...');
                axios(URL_VER,{ params: {idproducto : idproducto} })
                    .then(response => {
                        const data = response.data;
                        const moneyFormat = "{{ $monedaGeneral->format('0.00') }}";

                        stop();
                        $("#txtCategoria").html(data.categoria.nombre);
                        $("#txtSection").html(data.section.nombre);
                        $("#txtMarca").html(data.marca.nombre);
                        $("#txtCodigo").html(data.codigo);
                        $("#txtNombre").html(data.nombre);
                        $("#txtprecio").html(moneyFormat.replace('0.00',data.precio));
                        $("#txtprecio_promocional").html(moneyFormat.replace('0.00',data.precio_promocional));
                        $("#txtStock").html(data.stock);
                        $("#txtDestacado").html(data.destacado ? 'SI' : 'NO');



                        $("#txtDescripcionCorta").html(data.descripcion_corta);
                        $("#txtDescripcion").html(data.descripcion);
                        $("#txtficha_tecnica").html(data.ficha_tecnica);
                        $("#txtVideo").html(data.video);

                        if (data.estado){
                            $("#txtEstado").html('<label class="badge badge-success">Habilitado</label>');
                        }else{
                            $("#txtEstado").html('<label class="badge badge-danger">Inhabilitado</label>');
                        }


                        $("#modalVer").modal("show");
                    })
                    .catch(errorCatch)

            });

        }

        function onInvalid(event){
            const ele = event.target;
            const form = ele.closest('form');
            const clase = form.id == 'frmEditar' ? '.content-edit' : '.content-create';
            const div = ele.closest(clase);
            if(div !== null){
                const divId = div.id;
                form.querySelector('a[href="#'+divId+'"]').click();
            }
        }


        $("#imagen").fileinput({
            dropZoneTitle:'Arrastre las imágenes aquí',
            uploadUrl: URL_IMAGEN_UPLOAD,
            fileActionSettings: {
                showRemove: true,
                showUpload: false,
                showZoom: true,
                showDrag: true,
            },
        });

        $("#manual").fileinput({
            dropZoneTitle:'Arrastre los manuales aquí',
            uploadUrl: URL_MANUAL_UPLOAD,
            allowedFileTypes: ['pdf'],
            fileActionSettings: {
                showRemove: true,
                showUpload: false,
                showZoom: true,
                showDrag: true,
            },
        });

        $("#excel").fileinput({
            dropZoneTitle:'Arrastre el Excel aquí',
            fileActionSettings: {
                showRemove: true,
                showUpload: false,
                showZoom: true,
                showDrag: true,
            },
            allowedFileTypes: ['office'],
        });


        $(function () {
            getResources();
            filtros();
            modales();
            guardar();
            modificar();
            habilitar();
            inhabilitar();
            eliminar();
            sortImagenes();
            importarProductos();
            actionsAttribute();
            controlTabs();

            CKEDITOR.replace('descripcion',{
                height : 300
            });

            CKEDITOR.replace('descripcionCorta',{
                height : 300
            });

            CKEDITOR.replace('ficha_tecnica',{
                height : 300
            });

            CKEDITOR.replace('video',{
                height : 300
            });


            CKEDITOR.replace('descripcionCortaEditar',{
                height : 300
            });

            CKEDITOR.replace('descripcionEditar',{
                height : 300
            });


            CKEDITOR.replace('ficha_tecnicaEditar',{
                height : 300
            });

            CKEDITOR.replace('videoEditar',{
                height : 300
            });

        });

    </script>
@endpush
