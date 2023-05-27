<template>
    <StepsContainer>

        <Step :number="1" title="Nuevo Alumno" :currentValue="stepCurrent" @next="storeAlumno()"  >
            <div class="row">
                <div class="col-md-8 col-12 mb-3 row">
                    <div class="col-md-6 col-12 form-group">
                        <label for="nombres">Nombres <span class="text-danger">(*)</span></label>
                        <input type="text" name="nombres" id="nombres" class="form-control" placeholder="Nombres" v-model="alumno.nombres" >
                    </div>

                    <div class="col-md-6 col-12 form-group">
                        <label for="apellidos">Apellidos <span class="text-danger">(*)</span></label>
                        <input type="text" name="apellidos" id="apellidos" class="form-control" placeholder="Apellidos" v-model="alumno.apellidos" >
                    </div>

                    <div class="col-md-6 col-12 form-group">
                        <label for="correo">Correo <span class="text-danger">(*)</span></label>
                        <input type="email" name="correo" id="correo" class="form-control" placeholder="Correo" v-model="alumno.correo"  >
                    </div>

                    <div class="col-md-6 col-12 form-group">
                        <label for="telefono">Teléfono <span class="text-danger">(*)</span></label>
                        <input type="text" name="telefono" id="telefono" class="form-control" @keypress="soloNumeros" placeholder="Teléfono" v-model="alumno.telefono" >
                    </div>

                    <div class="col-md-6 col-12 form-group">
                        <label for="tipoDocumentoIdentidad">Documento de identidad <span class="text-danger">(*)</span></label>
                        <select name="tipoDocumentoIdentidad" id="tipoDocumentoIdentidad" class="form-control" v-model="alumno.idtipo_documento_identidad" @change="changeTipoDocumentoIdentidad()" >
                            <option hidden selected >[---Seleccione---]</option>
                            <option v-for="(item, index) in resources.tipoDocumentoIdentidad" :key="index" :value="item.idtipo_documento_identidad" v-text="item.nombre" ></option>
                        </select>
                    </div>

                    <div class="col-md-6 col-12 form-group">
                        <label for="numeroDocumentoIdentidad">N° de Documento <span class="text-danger">(*)</span></label>
                        <input type="text" name="numeroDocumentoIdentidad" id="numeroDocumentoIdentidad" class="form-control" @keypress="soloNumeros"  :minlength="alumno.numero_documento_identidad_lemgth" :maxlength="alumno.numero_documento_identidad_lemgth" placeholder="N°" v-model="alumno.numero_documento_identidad" >
                    </div>

                    <div class="col-md-6 col-12 form-group">
                        <label for="fechaNacimiento">Fecha de nacimiento</label>
                        <DatePicker input-class="form-control" format="DD/MM/Y" v-model="alumno.fecha_nacimiento" ></DatePicker>
                    </div>

                    <div class="col-md-6 col-12 form-group">
                        <label for="sexo">Sexo</label>
                        <select class="form-control" name="sexo" id="sexo" v-model="alumno.sexo" >
                            <option hidden selected >[---Seleccione---]</option>
                            <option value="hombre">Hombre</option>
                            <option value="mujer">Mujer</option>
                            <option value="Otro">Otro</option>
                        </select>
                    </div>

                    <div class="col-md-4 col-12 form-group">
                        <label for="departamento">Departamento</label>
                        <select class="form-control" name="departamento" id="departamento" title="Departamento" v-model="alumno.iddepartamento" @change="getProvincias()" >
                            <option value="" hidden selected >[---Seleccione---]</option>
                            <option v-for="(item, index) in resources.departamentos" :key="index" :value="item.iddepartamento" v-text="item.nombre"></option>
                        </select>
                    </div>

                    <div class="col-md-4 col-12 form-group">
                        <label for="provincia">Provincia</label>
                        <select class="form-control" name="provincia" id="provincia" title="Provincia" v-model="alumno.idprovincia" @change="getDistritos()" >
                            <option value="" hidden selected>[---Seleccione---]</option>
                            <option v-for="(item, index) in resources.provincias" :key="index" :value="item.idprovincia" v-text="item.nombre"></option>
                        </select>
                    </div>

                    <div class="col-md-4 col-12 form-group">
                        <label for="distrito">Distrito</label>
                        <select class="form-control" name="distrito" id="distrito" title="Distrito" v-model="alumno.iddistrito" >
                            <option value="" hidden selected >[---Seleccione---]</option>
                            <option v-for="(item, index) in resources.distritos" :key="index" :value="item.iddistrito" v-text="item.nombre"></option>
                        </select>
                    </div>
                    <div class="col-md-12 col-12 form-group">
                        <label for="direccion">Direción</label>
                        <input type="text" class="form-control" name="direccion" id="direccion" placeholder="Direción" v-model="alumno.direccion" >
                    </div>


                    <div class="col-12 mb-3 mt-3">
                        <h4>Apoderado o persona de referencia</h4>
                    </div>

                    <div class="col-md-6 col-12 form-group">
                        <label for="personaReferenciaNombres">Nombres <span class="text-danger">(*)</span></label>
                        <input type="text" name="personaReferenciaNombres" id="personaReferenciaNombres" class="form-control" placeholder="Nombres" v-model="alumno.apoderado_nombres" >
                    </div>

                    <div class="col-md-6 col-12 form-group">
                        <label for="personaReferenciaApellidos">Apellidos <span class="text-danger">(*)</span></label>
                        <input type="text" name="personaReferenciaApellidos" id="personaReferenciaApellidos" class="form-control" placeholder="Apellidos" v-model="alumno.apoderado_apellidos" >
                    </div>

                    <div class="col-md-6 col-12 form-group">
                        <label for="personaReferenciaCorreo">Correo <span class="text-danger">(*)</span></label>
                        <input type="email" class="form-control" name="personaReferenciaCorreo" id="personaReferenciaCorreo" placeholder="Correo" v-model="alumno.apoderado_correo" >
                    </div>

                    <div class="col-md-6 col-12 form-group">
                        <label for="personaReferenciaTelefono">Teléfono <span class="text-danger">(*)</span></label>
                        <input type="text" class="form-control" @keypress="soloNumeros" name="personaReferenciaTelefono" id="personaReferenciaTelefono" placeholder="Teléfono" v-model="alumno.apoderado_telefono" >
                    </div>

                </div>

                <div class="col-md-4 col-12 row">


                    <div class="col-12 h-25 form-group">
                        <label for="imagenAlumno">Imagen</label>
                        <input type="file" id="imagenAlumno" name="imagenAlumno" class="form-control">
                    </div>

                    <div class="col-12 form-group">
                        <label for="nota">Nota</label>
                        <textarea class="form-control" name="nota" id="nota" placeholder="Nota" rows="3" v-model="alumno.nota" ></textarea>
                    </div>

                </div>






            </div>
        </Step>

        <Step :number="2" title="Matrícula" :currentValue="stepCurrent" @next="stepCurrent = 3" >

            <div class="row">

                <div class="col-md-8 col-12 form-group">
                    <label for="alumno">Alumno</label>
                    <input type="text" class="form-control bg-warning font-weight-bold" id="alumno" value="Juan Manual Perez Aguila" readonly placeholder="Alumno" >
                </div>
                <div class="col-md-4 col-12 form-group">
                    <label for="concepto">Concepto</label>
                    <select class="form-control" id="concepto" readonly>
                        <option hidden >[---Seleccione---]</option>
                        <option value="1" selected> Nueva matrícula</option>
                    </select>
                </div>
                <div class="col-md-4 col-12 form-group">
                    <label for="fecha">Fecha Inicion - Fin</label>
                    <DatePicker input-class="form-control" range v-model="matricula.fecha" ></DatePicker>
                </div>
                <div class="col-md-4 col-12 form-group">
                    <label for="temporada">Temporada</label>
                    <select class="form-control" id="temporada">
                        <option hidden >[---Seleccione---]</option>
                        <option value="1" selected >Verano 2023</option>
                        <option value="2">invierno 2023</option>
                    </select>
                </div>
                <div class="col-md-4 col-12 form-group">
                    <label for="programa">Programa</label>
                    <select class="form-control" id="programa">
                        <option hidden >[---Seleccione---]</option>
                        <option value="1" selected >Para adultos</option>
                        <option value="2">Para niños</option>
                    </select>
                </div>
                <div class="col-md-4 col-12 form-group">
                    <label for="pisciona">Piscina</label>
                    <select class="form-control" id="pisciona">
                        <option hidden >[---Seleccione---]</option>
                        <option value="1" selected >Piscina grande</option>
                        <option value="2">Piscina mediana</option>
                        <option value="3">Piscina pequeña</option>
                    </select>
                </div>
                <div class="col-md-4 col-12 form-group">
                    <label for="carril">Carril</label>
                    <select class="form-control" id="carril">
                        <option hidden >[---Seleccione---]</option>
                        <option value="1" selected>#1</option>
                        <option value="2">#2</option>
                        <option value="3">#3</option>
                        <option value="4">#4</option>
                        <option value="5">#5</option>
                        <option value="6">#6</option>
                        <option value="7">#7</option>
                        <option value="8">#8</option>
                        <option value="9">#9</option>
                        <option value="10">#10</option>
                    </select>
                </div>
                <div class="col-md-4 col-12 form-group">
                    <label for="diasDeActividad">Dias de actividad</label>
                    <select class="form-control" id="diasDeActividad">
                        <option hidden >[---Seleccione---]</option>
                        <option value="1" selected >L-M-V</option>
                        <option value="2" >M-J-S</option>
                    </select>
                </div>
                <div class="col-md-4 col-12 form-group">
                    <label for="cantidadDeSessiones">Cantidad de sessiones</label>
                    <select class="form-control" id="cantidadDeSessiones">
                        <option hidden  >[---Seleccione---]</option>
                        <option value="1" selected >8 sesiones  x S/. 350.00 </option>
                    </select>
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
                                <td class="active"><i class="fa-solid fa-check"></i></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="table-primary">2</td>
                                <td class="table-primary">08:00 am - 09:00 am </td>
                                <td></td>
                                <td class="active"><i class="fa-solid fa-check"></i></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="table-primary">3</td>
                                <td class="table-primary">09:00 am - 10:00 am </td>
                                <td></td>
                                <td class="active"><i class="fa-solid fa-check"></i></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="table-primary">4</td>
                                <td class="table-primary">10:00 am - 11:00 am </td>
                                <td></td>
                                <td></td>
                                <td class="active"><i class="fa-solid fa-check"></i></td>
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

        <Step :number="3" title="Ver registro" :currentValue="stepCurrent" @next="stepCurrent = 4" btnNextText="Guardar" >
            <h3>Alumno</h3>
            <p class="fs-12">
                <b>Nombre completo</b> Juan Manual Perez Aguila <br>
                <b>Correo</b> juanpa@gmail.com <br>
                <b>Teléfono</b> 987654321 <br>
                <b>Documento de identidad</b> DNI - 87654321 <br>
                <b>Direción</b> Lorem ipsum dolor sit amet consectetur. Lima / Lima / Lima
            </p>

            <h3>Matricula</h3>
            <p class="fs-12">
                <b>Codígo</b> 0000007<br>
                <b>Concepto</b> Nueva Matricula <br>
                <b>Empleado</b> Roberto raymundo espinoza <br>
                <b>Sucursal Direción</b> sucursal #1 - Lorem ipsum dolor sit amet consectetur. Lima / Lima / Lima  <br>
                <b>Fecha</b> 01/01/2023 - 01/02/2023 <br>
                <b>Temporada</b> Verano <br>
                <b>Programa</b> Para adultos <br>
                <b>Piscina</b> Piscina grande <br>
                <b>Carril</b> #6 <br>
                <b>Dias de actividad</b> L-M-V <br>
                <b>Cantidad de sessiones</b> 4 sessiones X 350 soles <br>
                <b>Horario: </b>
                <ul>
                    <li>Lunes : 08:00 AM - 09:00 AM</li>
                    <li>Martes : 08:00 AM - 09:00 AM</li>
                    <li>Miercoles : 08:00 AM - 09:00 AM</li>
                    <li>Lunes : 08:00 AM - 09:00 AM</li>
                </ul>

            </p>
        </Step>

        <Step :number="4" title="Final" :currentValue="stepCurrent" :showFooter="false" classContent="step-final" >
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
import AutoComplete from 'primevue/autocomplete';

export default {
    components: { StepsContainer, Step, AutoComplete },
    props: {
        alumnoCurrent: {
            type: Object,
            default() {
                return {};
            },
            required: false
        },
    },
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
                sucursal: [],
                temporadas: [],
                programas: [],
                piscinas: [],
                carriles: [],
                actividadSemanal: [],
                cantidadesDeSesiones: [],
                horarios: [],
                dias: [],
            },
            stepCurrent : 1,
            alumno: {
                idcliente: null,
                nombres: '',
                apellidos: '',
                correo: '',
                telefono: '',
                apoderado_nombres: '',
                apoderado_apellidos: '',
                apoderado_correo: '',
                apoderado_telefono: '',
                idtipo_documento_identidad: '',
                numero_documento_identidad: '',
                numero_documento_identidad_lemgth: 8,
                fecha_nacimiento: null,
                sexo: '',
                iddepartamento: '',
                idprovincia: '',
                iddistrito: '',
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
        soloNumeros: soloNumeros,
        resetData() {
            Object.assign(this.$data, this.$options.data.call(this));
            this.getResources();
            setTimeout(() => {
                $("#imagenAlumno").fileinput({});
            }, 100);
        },
        getResources() {
            axios(route('matricula.resources'))
            .then( response => {
                const data = response.data;
                this.resources.tipoDocumentoIdentidad = data.tipoDocumentoIdentidad;
                this.resources.departamentos        = data.departamentos;

                this.resources.conceptos            = data.conceptos;
                this.resources.empleado             = data.empleado;
                this.resources.sucursales           = data.sucursales;
                this.resources.sucrusal             = data.sucrusal;
                this.resources.temporadas           = data.temporadas;
                this.resources.piscinas             = data.piscinas;
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
        changeTipoDocumentoIdentidad() {
            const tipoDocumento = this.resources.tipoDocumentoIdentidad.find( ele => ele.idtipo_documento_identidad  === this.alumno.idtipo_documento_identidad);
            this.alumno.numero_documento_identidad_lemgth = tipoDocumento.caracteres_length;
        },
        getProvincias() {
            return axios.get(route('matricula.provincias',[ this.alumno.iddepartamento ]))
            .then( response => {
                const data = response.data;
                this.resources.provincias = data;
            })
        },
        getDistritos() {
            return axios.get(route('matricula.distritos',[ this.alumno.idprovincia ]))
            .then( response => {
                const data = response.data;
                this.resources.distritos = data;
            })
        },
        validateAlumno() {
            const errors = [];

            if (this.alumno.nombres.trim() === '') {
                errors.push('Por favor, ingrese su(s) nombre(s).')
            }

            if (this.alumno.apellidos.trim() === '') {
                errors.push('Por favor, ingrese su(s) apellido(s).')
            }

            if (!validarEmail(this.alumno.correo)) {
                errors.push('Por favor, proporcione una dirección de correo electrónico válida.')
            }

            if (this.alumno.telefono.trim() === '') {
                errors.push('Por favor, ingrese su número de teléfono de contacto.')
            }

            if (this.alumno.idtipo_documento_identidad === '' || this.alumno.idtipo_documento_identidad === null) {
                errors.push('Por favor, seleccione el tipo de documento de identidad válido.')
            }

            if (this.alumno.numero_documento_identidad.trim() === '') {
                errors.push('Por favor, ingrese el número de documento de identidad asociado.')
            }

            if (this.alumno.numero_documento_identidad.length > 0 && this.alumno.numero_documento_identidad.length < this.alumno.numero_documento_identidad_lemgth) {
                errors.push('Por favor, ingrese lo caracteres minimos del número de documento de identidad asociado.')
            }


            if (this.alumno.apoderado_nombres.trim() === '') {
                errors.push('Por favor, ingrese el nombre de una persona de referencia.')
            }

            if (this.alumno.apoderado_apellidos.trim() === '') {
                errors.push('Por favor, ingrese los apellidos de la persona de referencia.')
            }

            if (!validarEmail(this.alumno.apoderado_correo)) {
                errors.push('Por favor, proporcione una dirección de correo electrónico válida para la persona de referencia.')
            }

            if (this.alumno.apoderado_telefono.trim() === '') {
                errors.push('Por favor, ingrese el número de teléfono de contacto de la persona de referencia.')
            }

            return errors;
        },
        storeAlumno() {
            const errors = this.validateAlumno();
            if (errors.length > 0) {
                notificacion('error','Errores encontrados:', listErrorsForm(errors));
                return;
            }

            // const imagenes = $('#imagenAlumno').fileinput('getFileList');
            // const imagen = imagenes[0];
            // console.log(imagen);

            const alumnoData = jsonToFormData(this.alumno);

            axios.post(route('matricula.storeAlumno'), alumnoData)
            .then( response => {
                const data = response.data;
                this.stepCurrent = 2;
                this.alumno.idcliente = data.idcliente;
                console.log('stored alumno :)',this.alumno);
            })


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
        if (Object.keys(this.alumnoCurrent).length > 0) {
            this.alumno = Object.assign(this.alumno, this.alumnoCurrent);
            this.getProvincias().then( _ => {
                this.alumno.idprovincia = this.alumnoCurrent.idprovincia ?? '';
            });
            this.getDistritos().then( _ => {
                this.alumno.iddistrito = this.alumnoCurrent.iddistrito ?? '';
            });

        }
        const alumno = {
            idcliente: null,
            nombres: 'Juan Manual',
            apellidos: 'Perez Aguila',
            correo: 'JuanPa@gmail.com',
            telefono: '987654321',
            apoderado_nombres: 'Juan Manual',
            apoderado_apellidos: 'Perez Aguila',
            apoderado_correo: 'JuanPa@gmail.com',
            idtipo_documento_identidad: 1,
            numero_documento_identidad: '87654321',
            fecha_nacimiento: new Date('1990-5-10'),
            sexo: 'hombre',
            iddepartamento:  15,
            idprovincia: 1501,
            iddistrito: 150101,
            direccion: 'av mazanares lt 10',
            nota: null,
            imagen: null,
        };
        this.alumno = Object.assign(this.alumno, alumno);
        this.getProvincias().then( _ => {
            this.alumno.idprovincia = '1501';
        });
        this.getDistritos().then( _ => {
            this.alumno.iddistrito = '150101';
        });



        setTimeout(() => {
            $("#imagenAlumno").fileinput({});
        }, 100);
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
