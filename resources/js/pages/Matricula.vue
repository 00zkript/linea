<template>
    <StepsContainer>

        <Step number="1" title="Nuevo usuario" :currentValue="stepCurrent" @next="stepCurrent = 2" >
            <div class="row">


                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="nombres">Nombres: <span class="text-danger">(*)</span></label>
                        <input type="text" name="nombres" id="nombres" required class="form-control">
                    </div>
                </div>

                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="apellidos">Apellidos: <span class="text-danger">(*)</span></label>
                        <input type="text" name="apellidos" id="apellidos" required class="form-control">
                    </div>
                </div>

                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="correo">Correo: <span class="text-danger">(*)</span></label>
                        <input type="email" name="correo" id="correo" required class="form-control">
                    </div>
                </div>

                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="telefono">Teléfono: <span class="text-danger">(*)</span></label>
                        <input type="text" name="telefono" id="telefono" required class="form-control soloNumeros">
                    </div>
                </div>

                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="tipoDocumentoIdentidad">Documento de identidad: <span class="text-danger">(*)</span></label>
                        <select name="tipoDocumentoIdentidad" id="tipoDocumentoIdentidad" class="form-control" required>
                            <option>[---Seleccione---]</option>
                            <option value="" hidden selected>[--Seleccione--]</option>
                            <!-- @foreach($tipoDocumentoIdentidad as $item)
                                <option value="{{ $item->idtipo_documento_identidad }}">
                                    {{ $item->nombre }}
                                </option>
                            @endforeach -->
                        </select>
                    </div>
                </div>

                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="numeroDocumentoIdentidad">N° de Documento: <span class="text-danger">(*)</span></label>
                        <input type="text" name="numeroDocumentoIdentidad" id="numeroDocumentoIdentidad" required class="form-control soloNumeros"  minlength="8" maxlength="8">
                    </div>
                </div>

                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="fechaNacimiento">Fecha de nacimiento:</label>
                        <input type="date" class="form-control" name="fechaNacimiento" id="fechaNacimiento" placeholder="Fecha de nacimiento" >
                    </div>
                </div>

                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="sexo">Sexo:</label>
                        <select class="form-control" name="sexo" id="sexo" >
                            <option>[---Seleccione---]</option>
                            <option value="" hidden >[---Seleccione---]</option>
                            <option value="hombre">Hombre</option>
                            <option value="mujer">Mujer</option>
                            <option value="Otro">Otro</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="departamento">Departamento:</label>
                        <select class="form-control" name="departamento" id="departamento" title="Departamento" >
                            <option>[---Seleccione---]</option>
                            <option value="" hidden selected >[---Seleccione---]</option>
                            <option v-for="(item, index) in resources.departamentos" :key="index" :value="item.iddepartamento" v-text="item.nombre"></option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="provincia">Provincia:</label>
                        <select class="form-control" name="provincia" id="provincia" title="Provincia" >
                            <option>[---Seleccione---]</option>
                            <option value="" hidden selected >[---Seleccione---]</option>
                            <option v-for="(item, index) in resources.provincias" :key="index" :value="item.idprovincia" v-text="item.nombre"></option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label for="distrito">Distrito:</label>
                        <select class="form-control" name="distrito" id="distrito" title="Distrito" >
                            <option>[---Seleccione---]</option>
                            <option value="" hidden selected >[---Seleccione---]</option>
                            <option v-for="(item, index) in resources.distritos" :key="index" :value="item.iddistrito" v-text="item.nombre"></option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12 col-12">
                    <div class="form-group">
                        <label for="direccion">Direción:</label>
                        <textarea class="form-control" name="direccion" id="direccion" placeholder="Direción" rows="3" ></textarea>
                    </div>
                </div>

                <div class="col-md-12 col-12">
                    <div class="form-group">
                        <label for="nota">Nota:</label>
                        <textarea class="form-control" name="nota" id="nota" placeholder="Nota" rows="3" ></textarea>
                    </div>
                </div>


                <div class="col-md-12 col-12">
                    <div class="form-group">
                        <label for="imagen">Imagen:</label>
                        <input type="file" id="imagen" name="imagen" class="form-control">
                    </div>
                </div>




            </div>
        </Step>

        <Step number="2" title="Matricula" :currentValue="stepCurrent" @next="stepCurrent = 3" >

            <div class="row">

                <div class="col-md-4 col-12">
                    <div class="form-group">
                        <label for="concepto">Concepto</label>
                        <select class="form-control" id="concepto">
                            <option>[---Seleccione---]</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-8 col-12">
                    <div class="form-group">
                        <label for="empleado">Empleado</label>
                        <input type="text" class="form-control" id="empleado" value="Lorem ipsum dolor sit." readonly>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="form-group">
                        <label for="sucursal">Sucursal</label>
                        <select class="form-control" id="sucursal">
                            <option>[---Seleccione---]</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-8 col-12">
                    <div class="form-group">
                        <label for="sucursalDireción">Sucursal Direción</label>
                        <input type="text" class="form-control" id="sucursalDireción" readonly>
                    </div>
                </div>
                <div class="col-md-8 col-12">
                    <div class="form-group">
                        <label for="alumno">Alumno</label>
                        <input type="text" class="form-control" id="alumno" value="Lorem ipsum dolor sit." readonly>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="form-group">
                        <label for="fecha">Fecha</label>
                        <input type="date" class="form-control" id="fecha">
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="form-group">
                        <label for="temporada">Temporada</label>
                        <select class="form-control" id="temporada">
                            <option>[---Seleccione---]</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="form-group">
                        <label for="programa">Programa</label>
                        <select class="form-control" id="programa">
                            <option>[---Seleccione---]</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="form-group">
                        <label for="pisciona">Pisciona</label>
                        <select class="form-control" id="pisciona">
                            <option>[---Seleccione---]</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="form-group">
                        <label for="carril">Carril</label>
                        <select class="form-control" id="carril">
                            <option>[---Seleccione---]</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="form-group">
                        <label for="diasDeActividad">Dias de actividad</label>
                        <select class="form-control" id="diasDeActividad">
                            <option>[---Seleccione---]</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="form-group">
                        <label for="cantidadDeSessiones">Cantidad de sessiones</label>
                        <select class="form-control" id="cantidadDeSessiones">
                            <option>[---Seleccione---]</option>
                        </select>
                    </div>
                </div>
                <div class="col-12 mt-3 pl-0 pr-0">
                    <table class="table table-bordered table-striped">
                        <thead class="table-primary">
                            <tr>
                                <th>N°</th>
                                <th>Horario</th>
                                <th>Lunes</th>
                                <th>Miercoles</th>
                                <th>Viernes</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="table-primary">1</td>
                                <td class="table-primary">07:00 am - 08:00 am </td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="table-primary">2</td>
                                <td class="table-primary">08:00 am - 09:00 am </td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="table-primary">3</td>
                                <td class="table-primary">09:00 am - 10:00 am </td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="table-primary">4</td>
                                <td class="table-primary">10:00 am - 11:00 am </td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="table-primary">5</td>
                                <td class="table-primary">11:00 am - 12:00 pm </td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="table-primary">6</td>
                                <td class="table-primary">12:00 pm - 01:00 pm </td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="table-primary">7</td>
                                <td class="table-primary">01:00 pm - 02:00 pm </td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="table-primary">8</td>
                                <td class="table-primary">02:00 pm - 03:00 pm </td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="table-primary">9</td>
                                <td class="table-primary">03:00 pm - 04:00 pm </td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="table-primary">10</td>
                                <td class="table-primary">04:00 pm - 05:00 pm </td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="table-primary">11</td>
                                <td class="table-primary">05:00 pm - 06:00 pm</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>


        </Step>

        <Step number="3" title="Ver registro" :currentValue="stepCurrent" >
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea aliquid temporibus fuga suscipit doloribus, beatae debitis provident, natus aut maxime placeat earum, veritatis molestias libero vel? Voluptatem quia veniam et amet a mollitia voluptas fugit inventore aut ut autem porro nulla magnam corporis officiis ratione hic optio similique, maiores repudiandae. A animi qui iusto saepe! Sit, ipsam minima nisi eos cumque obcaecati ut fuga neque, odit nulla, eligendi beatae officiis sed perspiciatis omnis dolorum ex quia sapiente tempore quaerat eveniet facilis! Impedit quidem aliquid porro quas, quam dolorum hic. Perspiciatis exercitationem explicabo odio iure assumenda saepe voluptas earum distinctio ad deserunt eos architecto, fuga nesciunt quod. Magni quo ut omnis obcaecati atque animi dolore est iste? Quae fugiat aperiam totam ipsum atque neque adipisci cumque quia sapiente similique id ratione eum tenetur repudiandae, minima numquam facere quos rem, unde voluptatem labore consectetur animi. Aliquam officia voluptates repudiandae voluptas? Unde, recusandae vitae perferendis expedita optio veritatis quisquam, facilis commodi quo maiores reprehenderit voluptatibus animi molestiae non ea deleniti qui corrupti exercitationem fuga. Tempore tenetur quisquam sit hic deserunt explicabo esse, et temporibus reprehenderit distinctio, nemo adipisci, numquam ad eaque. Voluptatibus nesciunt id, illo reiciendis sunt enim. Explicabo, provident officia expedita omnis ipsam temporibus magnam architecto, voluptates similique suscipit fugiat quae asperiores mollitia quaerat incidunt. Magni fugiat quae, sequi placeat asperiores similique voluptates mollitia voluptatibus, nihil facere, neque nesciunt cum consequuntur eveniet eos quod. Earum, suscipit minima, at incidunt recusandae reprehenderit corporis ratione eveniet ipsa accusamus porro mollitia soluta? Nemo iusto doloremque aspernatur quaerat maiores consequatur quidem sunt soluta eaque optio quas minus dolorem asperiores corrupti excepturi veritatis omnis qui labore, ipsum ipsam ea quibusdam. Dolorem, quisquam quia? Ratione cum consectetur ullam commodi ex ab, officiis, aliquam vitae facilis nostrum numquam laudantium, inventore aperiam illo. Laborum veniam, velit repudiandae deleniti rerum harum.
            </p>
        </Step>

    </StepsContainer>
</template>

<script>
import Step from '../components/StepComponent.vue';
import StepsContainer from "../components/StepsContainerComponent.vue";
export default {
    components: { StepsContainer, Step },
    data() {
        return {
            resources: {
                departamentos: [],
                provincias: [],
                distritos: [],
                conceptos: [],
                empleado: {
                    idempleado: 1,
                    nombres: 'juan alvaro',
                    apellidos: 'perez aguilar',
                },
                sucursales: [],
                temporadas: [],
                programas: [],
                piscionas: [],
                carriles: [],
                diasDeActividad: [],
                cantidadesDeSesiones: [],
                horarios: [],
                dias: [],
            },
            temp: {
                sucursal: {},
            },
            stepCurrent : 1,
            alumno: {
                idcliente: null,
                nombres: null,
                apellidos: null,
                correo: null,
                telefono: null,
                idtipo_documento_identidad: null,
                numero_documento_identidad: null,
                fecha_nacimiento: null,
                sexo: null,
                iddepartaento: null,
                idprovincia: null,
                iddistrito: null,
                direccion: null,
                nota: null,
                imagen: null,
            },
            matricula: {
                codigo: null,
                idcliente: null,
                idconcepto: null,
                idempleado: null,
                idsucursal: null,
                idtemporada: null,
                idprograma: null,
                idpiscina: null,
                idcarril: null,
                iddias_actividad: null,
                idcantidad_sessiones: null,
            },
            matricula_detalle: [],
        };
    },
    methods: {
        getResources() {
            console.log('get resources...');
        },
        getProvincias( iddepartamento ) {
            console.log('get provincias...');
        },
        getDistritos( idprovincia ) {
            console.log('get distritos...');
        },
        storeAlumno() {
            console.log('stored alumno :)');
        },

        getProgramas( idtemporada ) {

        },
        getCarriles( idpisciona ) {

        },
        storeMatricula(){

        }
    }



}
</script>

<style>



</style>
