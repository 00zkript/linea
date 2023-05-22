<template>
    <StepsContainer>


        <Step :number="1" title="Inscripción" :currentValue="stepCurrent" @next="stepCurrent = 2" >

            <div class="row">

                <div class="col-md-4 col-12">
                    <div class="form-group">
                        <label for="concepto">Concepto</label>
                        <select class="form-control" id="concepto">
                            <option hidden >[---Seleccione---]</option>
                            <option value="1" selected >Nueva matricula</option>
                            <option value="2" >renovación matricula</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-8 col-12">
                    <div class="form-group">
                        <label for="empleado">Empleado</label>
                        <input type="text" class="form-control" id="empleado" value="Lorem ipsum dolor sit." readonly placeholder="Empleado" >

                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="form-group">
                        <label for="sucursal">Sucursal</label>
                        <select class="form-control" id="sucursal">
                            <option hidden >[---Seleccione---]</option>
                            <option value="1" selected >Sucursal 1</option>
                            <option value="2" >Sucursal 2</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-8 col-12">
                    <div class="form-group">
                        <label for="sucursalDireción">Sucursal Direción</label>
                        <input type="text" class="form-control" id="sucursalDireción" value="Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus, accusamus!" readonly placeholder="Sucursal" >
                    </div>
                </div>
                <div class="col-md-8 col-12">
                    <div class="form-group">
                        <label for="cliente">Cliente</label>
                        <input type="text" class="form-control" id="cliente" value="Lorem ipsum dolor sit." placeholder="Cliente" >

                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="form-group">
                        <label for="fecha">Fecha</label>
                        <DatePicker input-class="form-control" range v-model="matricula.fecha" ></DatePicker>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="form-group">
                        <label for="programa">Programa</label>
                        <select class="form-control" id="programa">
                            <option hidden >[---Seleccione---]</option>
                            <option value="1" selected >pecho</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="form-group">
                        <label for="diasDeActividad">Dias de actividad</label>
                        <select class="form-control" id="diasDeActividad">
                            <option hidden >[---Seleccione---]</option>
                            <option value="1" selected >L-M-V</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="form-group">
                        <label for="cantidadDeSessiones">Cantidad de sessiones</label>
                        <select class="form-control" id="cantidadDeSessiones">
                            <option hidden >[---Seleccione---]</option>
                            <option value="1" selected >8 sessiones S/. 350.00</option>
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
                                <td class="active"> <i class="fa-solid fa-check"></i> </td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="table-primary">2</td>
                                <td class="table-primary">08:00 am - 09:00 am </td>
                                <td></td>
                                <td class="active"> <i class="fa-solid fa-check"></i> </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="table-primary">3</td>
                                <td class="table-primary">09:00 am - 10:00 am </td>
                                <td></td>
                                <td class="active"> <i class="fa-solid fa-check"></i> </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="table-primary">4</td>
                                <td class="table-primary">10:00 am - 11:00 am </td>
                                <td></td>
                                <td></td>
                                <td class="active"> <i class="fa-solid fa-check"></i> </td>
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

        <Step :number="2" title="Ver registro" :currentValue="stepCurrent" @next="stepCurrent = 3" >
            <h3>Cliente</h3>
            <p class="fs-12">
                <b>Nombre completo:</b> Juan Manual Perez Aguila <br>
                <b>Correo:</b> juanpa@gmail.com <br>
                <b>Teléfono:</b> 987654321 <br>
                <b>Documento de identidad:</b> DNI - 87654321 <br>
                <b>Direción:</b> Lorem ipsum dolor sit amet consectetur. Lima / Lima / Lima
            </p>

            <h3>Matricula</h3>
            <p class="fs-12">
                <b>Codígo:</b> 0000007<br>
                <b>Concepto:</b> Nueva Matricula <br>
                <b>Empleado:</b> Roberto raymundo espinoza <br>
                <b>Sucursal Direción:</b> sucursal #1 - Lorem ipsum dolor sit amet consectetur. Lima / Lima / Lima  <br>
                <b>Fecha:</b> 01/01/2023 - 01/02/2023 <br>
                <b>Programa:</b> Para adultos <br>
                <b>Dias de actividad:</b> L-M-V <br>
                <b>Cantidad de sessiones:</b> 4 sessiones X 350 soles <br>
                <b>Horario: </b>
                <ul>
                    <li>Lunes : 08:00 AM - 09:00 AM</li>
                    <li>Martes : 08:00 AM - 09:00 AM</li>
                    <li>Miercoles : 08:00 AM - 09:00 AM</li>
                    <li>Lunes : 08:00 AM - 09:00 AM</li>
                </ul>

            </p>
        </Step>

        <Step :number="3" title="Final" :currentValue="stepCurrent" :showFooter="false" classContent="step-final" >
            <div class="alert alert-success text-center">
                <h2>¡Felicidades, la matrícula se realizó con éxito!</h2>
                <h4>Codígo : 0000007</h4>
            </div>
            <div class="div-btn-reset">
                <button class="btn btn-primary" @click.prevent="resetData()">Nueva matrícula</button>
            </div>
        </Step>

    </StepsContainer>
</template>

<script>
import StepsContainer from "../../components/StepsContainerComponent.vue";
import Step from '../../components/StepComponent.vue';

export default {
    components: { StepsContainer, Step },
    data() {
        return {
            resources: {
                tipoDocumentoIdentidad: [],
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
                actividadSemanal: [],
                cantidadesDeSesiones: [],
                horarios: [],
                dias: [],
            },
            temp: {
                sucursal: {},
            },
            stepCurrent : 1,
            cliente: {
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
        resetData() {
            Object.assign(this.$data, this.$options.data.call(this));
            setTimeout(() => {
                $("input[type=file]").fileinput({});
            }, 100);
        },
        getResources() {
            console.log('get resources...');
            axios(route('matricula.resources'))
            .then( response => {
                const data = response.data;
                this.resources.tipoDocumentoIdentidad = data.tipoDocumentoIdentidad;
                this.resources.departamentos        = data.departamentos;
                this.resources.conceptos            = data.conceptos;
                this.resources.empleado             = data.empleado;
                this.resources.sucursales           = data.sucursales;
                this.resources.temporadas           = data.temporadas;
                this.resources.piscionas            = data.piscionas;
                this.resources.actividadSemanal     = data.actividadSemanal;
                this.resources.cantidadesDeSesiones = data.cantidadesDeSesiones;
                this.resources.horarios             = data.horarios;
                this.resources.dias                 = data.dias;
            })
            .catch( error => {
                const response = error.response;
                const data = response.data;
            })
        },
        getProvincias( iddepartamento ) {
            console.log('get provincias...');
        },
        getDistritos( idprovincia ) {
            console.log('get distritos...');
        },
        storeCliente() {
            console.log('stored cliente :)');
        },

        getProgramas( idtemporada ) {

        },
        getCarriles( idpisciona ) {

        },
        storeMatricula(){

        }
    },
    mounted(){
        this.getResources();
        $("input[type=file]").fileinput({});
    }



}
</script>

<style>

    table tbody tr td.active{
        background-color: darkgreen;
        color: #fff;
        text-align: center;
    }

    .fs-12{
        font-size: 12pt;
    }

    .step-final{
        width: 80%;
        justify-content: center;
        display: flex;

    }
    .div-btn-reset{
        position: relative;
        display: flex;
        justify-content: center;
    }

</style>
