@extends('panel.template.index')
@section('cuerpo')
    @include('panel.sectionHome.eliminar')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background-color: #2a3f54">
                        <p style="font-size: 20px" class="card-title text-center text-white mb-0"> Gestionar Home</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div id="accordion" style="width: 100%;">
                                <div id="listSections" style="width: 100%"></div>
                                <div id="listSectionsNews" style="width: 100%"></div>
                            </div>




                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <hr>
                            </div>

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <p class="card-title text-center mb-0"> <i class="fa fa-plus"></i>  Agregar nueva sección</p>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">

                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                <div class="form-group">
                                                    <select name="typeSection" id="typeSection" class="form-control">
                                                        <option value="" hidden>[--- Seleccione ---] </option>
                                                        <option value="imagenes" >Imagenes</option>
                                                        <option value="productos" >Productos</option>
                                                        <option value="slider" >Slider</option>
                                                        <option value="html" >Contenido HTML</option>
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" id="quantityForSectionDiv" style="display: none">
                                                <div class="form-group">
                                                    <label for="quantityForSection">Cantidad: <span class="text-danger">(*)</span></label>
                                                    <select name="quantityForSection" id="quantityForSection" class="form-control">
                                                        <option value="" hidden>[--- Seleccione ---] </option>
                                                        @for($i=1;$i<= $numberImages;$i++)
                                                            <option value="{{ $i }}" >{{ $i }}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-right">
                                                <button class="btn btn-primary" type="button" id="addSection" disabled> <i class="fa fa-plus"></i> Agregar</button>
                                            </div>



                                        </div>

                                    </div>
                                </div>
                            </div>




                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <template id="previewsTemplate">

        <div id="preview-1" class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-center">
                <img src="{{ asset('panel/default/section-home-preview-1.png') }}" style="width: 50%" >
            </div>
        </div>

        <div id="preview-2" class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-center">
                <img src="{{ asset('panel/default/section-home-preview-2.png') }}" style="width: 50%" >
            </div>
        </div>

        <div id="preview-3" class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-center">
                <img src="{{ asset('panel/default/section-home-preview-3.png') }}" style="width: 50%" >
            </div>
        </div>

        <div id="preview-4" class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-center">
                <img src="{{ asset('panel/default/section-home-preview-4.png') }}" style="width: 50%" >
            </div>
        </div>

        <div id="preview-5" class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-center">
                <img src="{{ asset('panel/default/section-home-preview-5.png') }}" style="width: 50%" >
            </div>
        </div>

    </template>

    <template id="sectionTemplate">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 headerSection mb-3">
            <div class="card">
                <div class="card-header" >
                    <button class="btn" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <span class="card-title mb-0" style="font-weight: bold"> Sección Title </span> <i class="fa fa-plus icono"></i>
                    </button>
                </div>
                <div id="collapseOne" class="collapse" data-parent="#accordion">
                    <div class="card-body">
                        <form class="frmSection" autocomplete="off" onsubmit="return false;">

                            @csrf
                            <input type="hidden" name="idsection_home" id="idsection_home">
                            <input type="hidden" name="tipo" id="tipo">

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="titulo">Título: <span class="text-danger">(*)</span></label>
                                    <input type="text" name="titulo" id="titulo" class="form-control" placeholder="Título de la sección" required>
                                </div>
                            </div>

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="subtitulo">Sub Título: </label>
                                    <input type="text" name="subtitulo" id="subtitulo" class="form-control" placeholder="Subtitulo de la sección" >
                                </div>
                            </div>

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="posicion">Posición  de la sección: <span class="text-danger">(*)</span> </label>
                                    <input type="number" name="posicion" id="posicion" class="form-control" placeholder="Posición de la sección" value="1" min="1" step="1" >
                                </div>
                            </div>




                            <div id="preview"></div>

                            <div id="contentImages" class="">

                                @for($i=1; $i<= $numberImages; $i++)
                                    <input type="hidden" id="idsection_home_link_{{ $i }}"  value="" name="idsection_home_link[]">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 showOptionImage">
                                        <div class="row">
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                                                <div class="form-group">
                                                    <label for="imagen_{{ $i }}" >Imagen:</label>
                                                    <div class="file-loading">
                                                        <input  id="imagen_{{ $i }}" name="imagen[]" type="file" class="file" >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                                                <div class="row">
                                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                        <div class="form-group">
                                                            <label for="posicion_i_{{ $i }}">Posición: <span class="text-danger">(*)</span></label>
                                                            <input type="text" name="posicion_i[]" id="posicion_i_{{ $i }}" class="form-control" value="{{ $i }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                        <div class="form-group">
                                                            <label for="textoBoton__{{ $i }}">Texto: <span class="text-danger">(*)</span></label>
                                                            <input type="text" name="textoBoton[]" id="textoBoton_{{ $i }}" class="form-control" placeholder="Texto" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                        <div class="form-group">
                                                            <label for="link_{{ $i }}">URL: <span class="text-danger">(*)</span></label>
                                                            <input type="text" name="link[]" id="link_{{ $i }}" class="form-control" placeholder="http://example.com" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                        <div class="form-group">
                                                            <label for="contenido_{{ $i }}">Contenido:</label>
                                                            <textarea name="contenido[]" id="contenido_{{ $i }}" class="form-control" rows="3" ></textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <hr>
                                    </div>

                                @endfor
                            </div>

                            <div id="contentProducts" class="">
                                @for($i=1; $i<= $numberImages; $i++)
                                    <input type="hidden" id="idsection_home_producto_{{ $i }}"  value="" name="idsection_home_producto[]">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 showOptionProduct">
                                        <div class="row">
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                <div class="form-group">
                                                    <label for="producto_{{ $i }}" >Producto #{{ $i }}:</label>
                                                    <select name="productos[]" id="producto_{{ $i }}" class="form-control" required>
                                                        <option value="" selected hidden>Seleccione un producto</option>
                                                        @foreach($productsDestacados as $product)
                                                            <option value="{{ $product->idproducto }}">{{ $product->nombre }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>

                                @endfor
                            </div>


                            <div id="contentSlider" class="">

                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="row">
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                            <h2>Productos con el Tag : </h2>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="nuevo" id="nuevo" value="1">
                                                <label class="form-check-label" for="nuevo">Nuevo</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="destacado" id="destacado" value="1">
                                                <label class="form-check-label" for="destacado">Destacado:</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="liquidacion" id="liquidacion" value="1">
                                                <label class="form-check-label" for="liquidacion">Liquidación:</label>
                                            </div>
                                        </div>

                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label for="idmarca">Marca:</label>
                                                <select name="idmarca" id="idmarca" class="form-control" title="Seleccione una marca">
                                                    <option value="" > Todas las marca</option>
                                                    @foreach($marcas as $marca)
                                                        <option value="{{ $marca->idmarca }}">{{ $marca->nombre }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="idcategoria">Categoría:</label>
                                                <select name="idcategoria" id="idcategoria" class="form-control" title="Seleccione una categoría">
                                                    <option value="" > Todas las categorías</option>
                                                    @foreach($categorias as $categoria)
                                                        <option value="{{ $categoria->idcategoria }}">{{ $categoria->nombre }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="idsection">Sección:</label>
                                                <select name="idsection" id="idsection" class="form-control" title="Seleccione una sección">
                                                    <option value="" > Todas la secciones</option>
                                                    @foreach($sections as $section)
                                                        <option value="{{ $section->idsection }}">{{ $section->nombre }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="cantidad_slider">Cantidad de productos del slider</label>
                                                <input type="number" name="cantidad_slider" id="cantidad_slider" class="form-control" value="15" min="1" required>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <hr>
                                </div>

                            </div>



                            <div id="contentHtml" class="">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label for="contenido">Contenido: <span class="text-danger">(*)</span></label>
                                        <textarea class="form-control" rows="3" required></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-center">
                                <div class="form-group" id="btnsForStore">
                                    <button class="btn btn-success" type="submit" id="saveSection"> <i class="fa fa-save"></i> Guardar</button>
                                    <button class="btn btn-danger" type="button" id="cancelSection"> <i class="fa fa-times"></i> Cancelar</button>
                                </div>
                                <div class="form-group" id="btnsForUpdate">
                                    <button class="btn btn-warning" type="submit" id="updateSection"> <i class="fa fa-save"></i> Actualizar</button>
                                    <button class="btn btn-danger" type="button" id="deleteSection"> <i class="fa fa-trash"></i> Eliminar</button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </template>

@endsection
@push('js')
    <script type="module" >

        const URL_GETSECTIONS = "{{ route('section-home.getSections') }}";
        const URL_GUARDAR     = "{{ route('section-home.store') }}";
        const URL_MODIFICAR   = "{{ route('section-home.update',':id') }}";
        const URL_ELIMINAR    = "{{ route('section-home.destroy',':id') }}";
        const URL_CARPETA     = BASE_URL+"/panel/img/sectionHome/";

        const numberImages = "{{  $numberImages }}";

        const sectionTemplate  = document.querySelector('#sectionTemplate').content;
        const previewsTemplate  = document.querySelector('#previewsTemplate').content;
        const listSectionsDiv     = document.querySelector('#listSections');
        const listSectionsNewsDiv = document.querySelector('#listSectionsNews');
        const modalDestroy = new bootstrap.Modal(document.getElementById('modalEliminar'));
        let posicion = 1;



        const showSection = ({
             type,
             quantity = 1,
             idsection_home = '',
             title = '',
             is_new_section = true,
             row_id = 0,
         } = '') => {

            const content = sectionTemplate.cloneNode(true);
            const previews = previewsTemplate.cloneNode(true);

            const rowContent      = content.querySelector('.headerSection');
            const form            = content.querySelector('form');
            const btnsStore       = content.querySelector('#btnsForStore');
            const btnsUpdate      = content.querySelector('#btnsForUpdate');
            const contentImages   = content.querySelector('#contentImages');
            const contentProducts = content.querySelector('#contentProducts');
            const contentSlider   = content.querySelector('#contentSlider');
            const contentHtml     = content.querySelector('#contentHtml');
            const tipo            = content.querySelector('#tipo');
            const idsection       = content.querySelector('#idsection_home');
            const preview         = content.querySelector('#preview');
            const cardTitle       = content.querySelector('.card-title');
            const collapseBtn     = content.querySelector('.card-header button');
            const collapseIcon     = content.querySelector('.card-header .icono');
            const collapseContent = content.querySelector('#collapseOne');

            collapseBtn.setAttribute('data-target', '#collapse'+row_id);
            collapseBtn.setAttribute('aria-controls', 'collapse'+row_id);
            collapseContent.setAttribute('id', 'collapse'+row_id);

            rowContent.id = row_id;
            tipo.value = type;
            idsection.value = idsection_home;

            if(title != ''){
                cardTitle.innerText = title;
            }

            if(type == 'imagenes') {

            const thumber = previews.querySelector('#preview-'+quantity).cloneNode(true);
            preview.appendChild(thumber);

            contentSlider.remove();
            contentProducts.remove();
            contentHtml.remove();
            const optionsImages = contentImages.querySelectorAll('.showOptionImage');

            for (let i = 0; i < numberImages; i++) {
                if(i<quantity){
                    optionsImages[i].style.display = 'block';
                    if(is_new_section){
                        optionsImages[i].querySelector('#imagen_'+(i+1)).required = true;
                    }
                }else{
                    optionsImages[i].remove();

                }

                }

            }

            if(type == 'productos'){

                const thumber = previews.querySelector('#preview-'+quantity).cloneNode(true);
                preview.appendChild(thumber);

                contentSlider.remove();
                contentImages.remove();
                contentHtml.remove();
                const optionsProducts = contentProducts.querySelectorAll('.showOptionProduct');

                for (let i = 0; i < numberImages; i++) {
                    if (i< quantity){
                        optionsProducts[i].style.display = 'block';
                    }else{
                        optionsProducts[i].remove();
                    }
                }
            }

            if(type == 'slider'){
                preview.remove();
                contentImages.remove();
                contentProducts.remove();
                contentHtml.remove();
            }

            if(type == 'html'){
                preview.remove();
                contentImages.remove();
                contentProducts.remove();
                contentSlider.remove();
                const contenidoTextArea = contentHtml.querySelector('textarea');
                contenidoTextArea.id = 'contenido'+row_id;

            }


            if (is_new_section){
                form.id = 'frmCrear';
                btnsUpdate.remove();
                listSectionsNewsDiv.appendChild(content);
                collapseContent.classList.add('show');
            }else{
                form.id = 'frmUpdate';
                btnsStore.remove();
                listSectionsDiv.appendChild(content);
            }

            return Promise.resolve(rowContent);

        }

        const addSection = () => {
            const typeSection        = document.querySelector('#typeSection');
            const quantityForSection = document.querySelector('#quantityForSection');
            const btnAddSection      = document.querySelector('#addSection');

            typeSection.addEventListener("change",function (e){
                e.preventDefault();
                let type = this.value;

                if(type == 'imagenes' || type == 'productos'){
                    document.querySelector('#quantityForSectionDiv').style.display = 'block';
                    btnAddSection.disabled = true;
                }else{
                    document.querySelector('#quantityForSectionDiv').style.display = 'none';
                    btnAddSection.disabled = false;
                }


            })

            quantityForSection.addEventListener("change",function (e){
                e.preventDefault();
                let quantity = this.value;

                if(quantity > 0){
                    btnAddSection.disabled = false;
                }else{
                    btnAddSection.disabled = true;
                }

            })

            btnAddSection.addEventListener("click",function (e) {
                e.preventDefault();
                let type = typeSection.value;
                let quantity = quantityForSection.value;
                let row_id = str_random(10);


                showSection({
                    type,
                    quantity,
                    row_id : row_id,
                    title : 'Nueva sección'
                })
                    .then( response => {
                        const content = response;
                        content.querySelector('#posicion').value = posicion+1;

                        if (type == 'imagenes'){
                            $(`#${row_id} .file`).fileinput({
                                dropZoneTitle : 'Arrastre la imagen aquí',
                                // uploadUrl : URL_FILE_STORE,
                            });
                        }


                        if(type == 'html'){
                            CKEDITOR.replace(`contenido${row_id}`,{height : 200,});

                        }


                        // reset values default
                        typeSection.value = '';
                        quantityForSection.value = '';
                        document.querySelector('#quantityForSectionDiv').style.display = 'none';
                        btnAddSection.disabled = true;

                    })




            });

        }

        const cancelSection = () => {
            listSectionsNewsDiv.addEventListener("click",function (e) {
                if(e.target.id == "cancelSection" ){
                    e.preventDefault();
                    e.target.closest('.headerSection').remove();

                }
            });
        }

        const modales = () => {

            listSectionsDiv.addEventListener("click",function (e) {

                if(e.target.id == "deleteSection" ) {
                    e.preventDefault();
                    const idsection_home = e.target.closest('.headerSection').querySelector('#idsection_home').value;
                    const form = document.querySelector("#frmEliminar");

                    form.querySelector('input[name="idsection_home"]').value = idsection_home;
                    modalDestroy.show();
                }

            });

        }

        const getSections = () => {

            listSectionsDiv.innerHTML = '';

            return axios({
                url: URL_GETSECTIONS,
                method: 'GET',
            })
                .then(response => {
                    const sections = response.data;
                    posicion = sections.length;

                    sections.forEach(section => {
                        const links = section.links;
                        const productos = section.products;
                        let row_id = str_random(10);
                        let quantity = 0;

                        if (section.tipo == 'imagenes'){
                            quantity = links.length <= 0 ? 1 : links.length;
                        }

                        if(section.tipo == 'productos'){
                            quantity = productos.length <= 0 ? 1 : productos.length;
                        }



                        showSection({
                            type: section.tipo,
                            quantity: quantity,
                            idsection_home: section.idsection_home,
                            title: section.titulo,
                            is_new_section: false,
                            row_id: row_id,
                        })
                            .then( response => {
                                const content = response;


                                content.querySelector('#titulo').value = section.titulo;
                                content.querySelector('#subtitulo').value = section.subtitulo;
                                content.querySelector('#posicion').value = section.posicion ? section.posicion : 1;


                                if (section.tipo == 'imagenes'){

                                    if(links.length > 0) {

                                        links.forEach((link, idx) => {
                                            const i = idx + 1;

                                            let config = {
                                                dropZoneTitle: 'Arrastre la imagen aquí',
                                            };

                                            if(link.imagen != null && link.imagen != ''){
                                                config = {
                                                    dropZoneTitle: 'Arrastre la imagen aquí',
                                                    initialPreview: [URL_CARPETA + link.imagen],
                                                    initialPreviewConfig: {caption: link.imagen, width: "120px", height: "120px"},
                                                }
                                            }

                                            $(`#${row_id} #imagen_${i}`).fileinput(config);

                                            content.querySelector(`#idsection_home_link_${i}`).value = link.idsection_home_link;
                                            content.querySelector(`#textoBoton_${i}`).value = link.texto;
                                            content.querySelector(`#link_${i}`).value = link.link;
                                            content.querySelector(`#contenido_${i}`).value = link.contenido;
                                        });

                                    }else{

                                        $(`#${row_id} #imagen_1`).fileinput({
                                            dropZoneTitle : 'Arrastre la imagen aquí',
                                        });
                                    }


                                }

                                if (section.tipo == 'productos'){

                                    if(productos.length > 0) {
                                        productos.forEach((producto, idx) => {
                                            const i = idx + 1;
                                            content.querySelector(`#idsection_home_producto_${i}`).value = producto.idsection_home_producto;
                                            content.querySelector(`#producto_${idx + 1}`).value = producto.idproducto;
                                        });
                                    }else {
                                        content.querySelector('#producto_1').value = '';
                                    }
                                }

                                if (section.tipo == 'slider'){
                                    content.querySelector('#nuevo').checked = section.nuevo ? section.nuevo : false;
                                    content.querySelector('#destacado').checked = section.destacado ? section.destacado : false;
                                    content.querySelector('#liquidacion').checked = section.liquidacion ? section.liquidacion : false;

                                    content.querySelector('#idmarca').value = section.idmarca ? section.idmarca : '';
                                    content.querySelector('#idcategoria').value = section.idcategoria ? section.idcategoria : '';
                                    content.querySelector('#idsection').value = section.idsection ? section.idsection : '';
                                    content.querySelector('#cantidad_slider').value = section.cantidad_slider ? section.cantidad_slider : '15';
                                }

                                if(section.tipo == 'html'){
                                    const idTextArea = 'contenido'+row_id;
                                    CKEDITOR.replace(idTextArea,{height : 200,});
                                    CKEDITOR.instances[idTextArea].setData(section.contenido);


                                }

                            })



                    });


                })
                .catch(errorCatch)

        }


        const store = () => {
            listSectionsNewsDiv.addEventListener("submit",function (e) {
                if(e.target.id == 'frmCrear'){
                    e.preventDefault();
                    const form = e.target;
                    const tipo = form.querySelector("input[name=tipo]").value;
                    const card = form.closest('.headerSection');
                    const card_id = card.id;


                    const formData = new FormData(form);
                    formData.append('_method', 'POST');
                    if(tipo == 'html'){
                        const contenidoId = `contenido${card_id}`;
                        formData.append('contenidoHtml', CKEDITOR.instances[contenidoId].getData());
                    }


                    axios({
                        url : URL_GUARDAR,
                        method : 'POST',
                        data : formData
                    })
                        .then(response => {
                            const data = response.data;
                            stop();
                            notificacion("success","Registro exitoso",data.mensaje);
                            getSections();
                            card.remove();


                        })
                        .catch(errorCatch)


                }

            });
        }

        const update = () => {
            listSectionsDiv.addEventListener("submit",function (e) {
                if(e.target.id == 'frmUpdate'){
                    e.preventDefault();
                    const form = e.target;
                    const idregistro = form.querySelector("input[name=idsection_home]").value;
                    const tipo = form.querySelector("input[name=tipo]").value;
                    const card = form.closest('.headerSection');
                    const card_id = card.id;

                    const formData = new FormData(form);
                    formData.append('_method', 'PUT');
                    if(tipo == 'html'){
                        const contenidoId = `contenido${card_id}`;
                        formData.append('contenidoHtml', CKEDITOR.instances[contenidoId].getData());
                    }

                    cargando('Procesando...');
                    axios({
                        url : URL_MODIFICAR.replace(':id', idregistro),
                        method : 'POST',
                        data : formData
                    })
                        .then(response => {
                            const data = response.data;

                            stop();
                            notificacion("success","Modificación exitosa",data.mensaje);
                            getSections();

                        })
                        .catch(errorCatch)

                }

            });
        }

        const destroy = () => {

            document.querySelector('#frmEliminar').addEventListener("submit",function (e) {
                e.preventDefault();
                const idregistro = document.querySelector("#frmEliminar input[name=idsection_home]").value;
                cargando('Procesando...');

                axios({
                    url : URL_ELIMINAR.replace(':id', idregistro),
                    method : 'POST',
                    data : {
                        _method : 'DELETE'
                    }
                })
                    .then( response => {
                        const data = response.data;

                        getSections()
                            .then( response => {
                                notificacion("success","Eliminado",data.mensaje);
                                stop();
                                modalDestroy.hide();

                            })

                    } )
                    .catch( errorCatch )


            });
        }



        document.addEventListener("DOMContentLoaded",function () {
            getSections();
            modales();
            addSection();
            cancelSection();
            store();
            update();
            destroy();

        });


    </script>
@endpush
