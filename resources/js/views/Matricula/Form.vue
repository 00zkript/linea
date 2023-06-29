<template>
    <StepsContainer>

        <Step :number="1" id="step-1" title="Nuevo Alumno" :currentValue="stepCurrent" @next="storeAlumno()"  >
            <div class="row">
                <div class="col-md-6 col-12 form-group">
                    <label for="nombres">Nombres <span class="text-danger">(*)</span></label>
                    <input type="text" name="nombres" id="nombres" class="form-control" placeholder="Nombres" v-model="alumno.nombres" >
                </div>

                <div class="col-md-6 col-12 form-group">
                    <label for="apellidos">Apellidos <span class="text-danger">(*)</span></label>
                    <input type="text" name="apellidos" id="apellidos" class="form-control" placeholder="Apellidos" v-model="alumno.apellidos" >
                </div>

                <div class="col-md-6 col-12 form-group">
                    <label for="correo">Correo </label>
                    <input type="email" name="correo" id="correo" class="form-control" placeholder="Correo" v-model="alumno.correo"  >
                </div>

                <div class="col-md-6 col-12 form-group">
                    <label for="telefono">Teléfono </label>
                    <input type="text" name="telefono" id="telefono" class="form-control" @keypress="soloNumeros" placeholder="Teléfono" v-model="alumno.telefono" >
                </div>

                <div class="col-md-6 col-12 form-group">
                    <label for="tipoDocumentoIdentidad">Documento de identidad <span class="text-danger">(*)</span></label>
                    <select name="tipoDocumentoIdentidad" id="tipoDocumentoIdentidad" class="form-control" v-model="alumno.idtipo_documento_identidad" @change="changeAlumnoTipoDocumentoIdentidad()" >
                        <option value="" hidden selected >[---Seleccione---]</option>
                        <option v-for="(item, index) in resources.tipoDocumentoIdentidad" :key="index" :value="item.idtipo_documento_identidad" v-text="item.nombre" ></option>
                    </select>
                </div>

                <div class="col-md-6 col-12 form-group">
                    <label for="numeroDocumentoIdentidad">N° de Documento <span class="text-danger">(*)</span></label>
                    <input type="text" name="numeroDocumentoIdentidad" id="numeroDocumentoIdentidad" class="form-control" @keypress="soloNumeros"  :minlength="alumno.numero_documento_identidad_lemgth" :maxlength="alumno.numero_documento_identidad_lemgth" placeholder="N°" v-model="alumno.numero_documento_identidad" >
                </div>

                <div class="col-md-6 col-12 form-group">
                    <label for="fechaNacimiento">Fecha de nacimiento </label>
                    <DatePicker input-class="form-control" value-type="format" v-model="alumno.fecha_nacimiento" ></DatePicker>
                </div>

                <div class="col-md-6 col-12 form-group">
                    <label for="sexo">Sexo</label>
                    <select class="form-control" name="sexo" id="sexo" v-model="alumno.sexo"
                        @change=" temp.alumno.sexo = resources.sexos.find(ele => ele.idsexo === alumno.idsexo ); "
                        >
                        <option value="" hidden selected >[---Seleccione---]</option>
                        <option v-for="(item, index) in resources.sexos" :key="index" :value="item.idsexo" v-text="item.nombre"></option>
                    </select>
                </div>

                <div class="col-md-4 col-12 form-group">
                    <label for="departamento">Departamento</label>
                    <select class="form-control" name="departamento" id="departamento" title="Departamento" v-model="alumno.iddepartamento" @change="changeAlumnoDepartamento()" >
                        <option value="" hidden >[---Seleccione---]</option>
                        <option v-for="(item, index) in resources.departamentos" :key="index" :value="item.iddepartamento" v-text="item.nombre"></option>
                    </select>
                </div>

                <div class="col-md-4 col-12 form-group">
                    <label for="provincia">Provincia</label>
                    <select class="form-control" name="provincia" id="provincia" title="Provincia" v-model="alumno.idprovincia" @change="changeAlumnoProvincia()" >
                        <option value="" hidden selected>[---Seleccione---]</option>
                        <option v-for="(item, index) in resources.provincias" :key="index" :value="item.idprovincia" v-text="item.nombre"></option>
                    </select>
                </div>

                <div class="col-md-4 col-12 form-group">
                    <label for="distrito">Distrito</label>
                    <select class="form-control" name="distrito" id="distrito" title="Distrito" v-model="alumno.iddistrito">
                        <option value="" hidden >[---Seleccione---]</option>
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
                    <label for="personaReferenciaCorreo">Correo </label>
                    <input type="email" class="form-control" name="personaReferenciaCorreo" id="personaReferenciaCorreo" placeholder="Correo" v-model="alumno.apoderado_correo" >
                </div>

                <div class="col-md-6 col-12 form-group">
                    <label for="personaReferenciaTelefono">Teléfono </label>
                    <input type="text" class="form-control" @keypress="soloNumeros" name="personaReferenciaTelefono" id="personaReferenciaTelefono" placeholder="Teléfono" v-model="alumno.apoderado_telefono" >
                </div>


                <div class="col-12 form-group">
                    <label for="nota">Nota</label>
                    <textarea class="form-control" name="nota" id="nota" placeholder="Nota" rows="3" v-model="alumno.nota" ></textarea>
                </div>







            </div>
        </Step>

        <Step :number="2" id="step-2" title="Matrícula" :currentValue="stepCurrent" @next="saveMatricula()" >
            <div class="row">

                <div class="col-md-8 col-12 form-group">
                    <label for="alumno">Alumno</label>
                    <input type="text" class="form-control bg-warning font-weight-bold" id="alumno" :value="alumno.nombres+' '+alumno.apellidos" readonly placeholder="Alumno" >
                </div>
                <div class="col-md-4 col-12 form-group">
                    <label for="concepto">Concepto <span class="text-danger">(*)</span></label>
                    <select class="form-control" id="concepto" readonly v-model="matricula.idconcepto">
                        <option value="" hidden >[---Seleccione---]</option>
                        <option v-for="(item, index) in resources.conceptos" :key="index" :value="item.idconcepto" v-text="item.nombre"></option>
                    </select>
                </div>
                <div class="col-md-4 col-12 form-group">
                    <label for="temporada">Temporada <span class="text-danger">(*)</span></label>
                    <select class="form-control" id="temporada" v-model="matricula.idtemporada" @change="getProgramas()">
                        <option value="" hidden >[---Seleccione---]</option>
                        <option v-for="(item, index) in resources.temporadas" :key="index" :value="item.idtemporada" v-text="item.nombre"></option>
                    </select>
                </div>
                <div class="col-md-4 col-12 form-group">
                    <label for="programa">Programa <span class="text-danger">(*)</span></label>
                    <select class="form-control" id="programa" v-model="matricula.idprograma" @change="getNiveles()">
                        <option value="" hidden >[---Seleccione---]</option>
                        <option v-for="(item, index) in resources.programas" :key="index" :value="item.idprograma" v-text="item.nombre"></option>
                    </select>

                </div>
                <div class="col-md-4 col-12 form-group">
                    <label for="nivel">Nivel <span class="text-danger">(*)</span></label>
                    <select class="form-control" id="nivel" v-model="matricula.idnivel" @change="getCarriles()">
                        <option value="" hidden >[---Seleccione---]</option>
                        <option v-for="(item, index) in resources.niveles" :key="index" :value="item.idnivel" v-text="item.nombre"></option>
                    </select>
                </div>
                <div class="col-md-4 col-12 form-group">
                    <label for="carril">Carril <span class="text-danger">(*)</span></label>
                    <select class="form-control" id="carril" v-model="matricula.idcarril" @change="getFrecuencias()">
                        <option value="" hidden >[---Seleccione---]</option>
                        <option v-for="(item, index) in resources.carriles" :key="index" :value="item.idcarril" v-text="item.nombre"></option>
                    </select>
                </div>
                <div class="col-md-4 col-12 form-group">
                    <label for="frecuencia">Frecuencia <span class="text-danger">(*)</span></label>
                    <select class="form-control" id="frecuencia" v-model="matricula.idfrecuencia" @change="getHorarios()">
                        <option value="" hidden >[---Seleccione---]</option>
                        <option v-for="(item, index) in resources.frecuencias" :key="index" :value="item.idfrecuencia" v-text="item.nombre"></option>
                    </select>
                </div>
                <div class="col-md-4 col-12 form-group">
                    <label for="horario">Horario <span class="text-danger">(*)</span></label>
                    <select class="form-control" id="horario" v-model="matricula.idhorario">
                        <option value="" hidden >[---Seleccione---]</option>
                        <option v-for="(item, index) in resources.horarios" :key="index" :value="item.idhorario" v-text="item.nombre"></option>
                    </select>
                </div>
                <div class="col-md-4 col-12 form-group">
                    <label for="cantidadClases">Cantidad de clases <span class="text-danger">(*)</span></label>
                    <select class="form-control" id="cantidadClases" v-model="matricula.idcantidad_clases">
                        <option value="" hidden >[---Seleccione---]</option>
                        <option v-for="(item, index) in resources.cantidadClases" :key="index" :value="item.idcantidad_clases" v-text="item.nombre"></option>
                    </select>
                </div>

                <div class="col-12 form-group">
                    <label for="fecha">Periodo desde - hasta <span class="text-danger">(*)</span></label>
                    <DatePicker input-class="form-control" value-type="format" range v-model="matricula.fecha" placeholder="Periodo desde - hasta" :disabled-date="disabledDatesRange" ></DatePicker>
                </div>

                <div class="col-12" v-if="capacidadMaxima">
                    <div class="mt-3 mb-3 pr-5  alert alert-warning">
                        <h5><u>NOTA:</u></h5>
                        <h5>Actualmente hay {{ cantidadMatriculados }} matriculados y la capacidad máxima es de {{ capacidadMaxima }}.</h5>
                    </div>
                </div>
            </div>
        </Step>


        <Step :number="3" id="step-3" title="Datos de matrícula" :currentValue="stepCurrent" @next="storeMatriculaHorario()" btnNextText="Guardar" >


            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th colspan="2" class="text-center">Alumno</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="2"><b>Nombre completo:</b> {{ alumno.nombres+' '+alumno.apellidos }} <br></td>
                    </tr>
                    <tr>
                        <td><b>Correo:</b> {{ alumno.correo }} <br></td>
                        <td><b>Teléfono:</b> {{ alumno.telefono }} <br></td>
                    </tr>
                    <tr>
                        <td><b>Documento de identidad:</b> {{ temp.alumno.tipoDocumentoIdentidad.nombre }} - {{ alumno.numero_documento_identidad }} <br></td>
                        <td><b>Direción:</b> {{ alumno.direccion }}</td>
                    </tr>
                </tbody>
            </table>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th colspan="4"> NOTA: Actualmente hay {{ cantidadMatriculados }} matriculados y la capacidad máxima es de {{ capacidadMaxima }}. </th>
                    </tr>
                    <tr>
                        <th colspan="4" class="text-center">Matrícula</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="1"><b>Periodo:</b> {{ formatDate(matricula.fecha[0]) }} - {{ formatDate(matricula.fecha[1]) }} <br></td>
                        <td colspan="1"><b>Concepto:</b> Nueva Matricula <br></td>
                        <td colspan="2"><b>Empleado:</b> {{ temp.empleado.nombres }} <br></td>
                    </tr>
                    <tr>
                        <td colspan="4"><b>Sucursal Direción:</b> {{ temp.sucursal.nombre }} - {{ temp.sucursal.direccion }} <br></td>
                    </tr>
                    <tr>
                        <td><b>Temporada:</b> {{ temp.temporada.nombre }} <br></td>
                        <td><b>Programa:</b> {{ temp.programa.nombre }} <br></td>
                        <td><b>Nivel:</b> {{ temp.nivel.nombre }} <br></td>
                        <td><b>Carril:</b> {{ temp.carril.nombre }} <br></td>
                    </tr>
                    <tr>
                        <td colspan="2"><b>Frecuencia:</b> {{ temp.frecuencias.nombre }} <br></td>
                        <td colspan="2"><b>Cantidad de clases:</b> {{ temp.cantidadClases.nombre }} <br></td>
                    </tr>
                </tbody>
            </table>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th colspan="2" class="text-center">Horario</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, index) in matriculaHorarioDia" :key="index">
                        <td class="text-center">{{ item.dia_name }}</td>
                        <td class="text-center">{{ item.horario_nombre }}</td>
                    </tr>

                </tbody>
            </table>



        </Step>

        <Step :number="4" id="step-4" title="Final" :currentValue="stepCurrent" :showFooter="false" classContent="step-final" >
            <div class="alert alert-success text-center">
                <h2>¡Felicidades, la matrícula se realizó con éxito!</h2>
                <h4>Codígo :  {{ codigoMatricula }}</h4>
            </div>
            <div class="div-btn-reset">
                <a :href="route('matricula.create')" class="btn btn-primary">Nueva matrícula</a>
            </div>
        </Step>

    </StepsContainer>
</template>

<script>
import StepsContainer from "../../components/StepsContainerComponent.vue";
import Step from '../../components/StepComponent.vue';
import moment from 'moment';
moment.locale('es-mx');


export default {
    components: { StepsContainer, Step },
    props: {
        alumno_id: {
            type: Number,
            default: null,
            required: false
        },
        matricula_id: {
            type: Number,
            default: null,
            required: false
        },
        type: String,
    },
    data() {
        return {
            resources: {
                tipoDocumentoIdentidad: [],
                sexos: [
                    { idsexo: 'hombre', nombre: 'Hombre'},
                    { idsexo: 'mujer', nombre: 'Mujer'},
                    { idsexo: 'otro', nombre: 'Otro'}
                ],
                departamentos: [],
                provincias: [],
                distritos: [],

                conceptos: [],
                sucursales: [],
                sucursal: [],
                temporadas: [],
                programas: [],
                niveles: [],
                carriles: [],
                frecuencias: [],
                horarios: [],
                cantidadClases: [],
                dias: [],
            },
            temp: {
                alumno: {
                    tipoDocumentoIdentidad: {},
                    sexo: {},
                    departamento: {},
                    provincia: {},
                    distrito: {},
                },

                empleado: {},
                sucursal: {},
                temporada: {},
                programa: {},
                nivel: {},
                carril: {},
                frecuencias: {},
                cantidadClases: {},
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
                idmatricula: '',
                fecha: [],
                idconcepto: 1,
                idempleado: '',
                idsucursal: '',
                idtemporada: '',
                idprograma: '',
                idnivel: '',
                idcarril: '',
                idfrecuencia: '',
                idhorario: '',
                idcantidad_clases: '',
            },
            matriculaHorarioDia: [],
            codigoMatricula: null,
            capacidadMaxima: null,
            cantidadMatriculados: null,
            cantidadClasesMaxima: null,
        };
    },
    methods: {
        soloNumeros: soloNumeros,
        disabledDatesRange(date) {
            const currentDate = new Date();
            currentDate.setHours(0, 0, 0, 0); // Establecer las horas, minutos, segundos y milisegundos a cero para comparación precisa

            return date < currentDate;
        },
        getAlumno(clienteID) {
            return axios(route('matricula.alumno',clienteID))
                .then( (response) => {
                    const data = response.data;
                    this.alumno = Object.assign(this.alumno, data);
                    this.getProvincias();
                    this.getDistritos();

                })
        },
        getMatricula(matriculaID) {
            return axios(route('matricula.matricula',matriculaID))
                .then( (response) => {
                    const data = response.data;
                    const { resources, matricula, alumno } = data;

                    this.alumno = Object.assign(this.alumno, alumno);
                    this.getProvincias();
                    this.getDistritos();


                    this.resources.programas   = resources.programas;
                    this.resources.niveles     = resources.niveles;
                    this.resources.carriles    = resources.carriles;
                    this.resources.frecuencias = resources.frecuencias;
                    this.resources.horarios    = resources.horarios;
                    const horarioFind = resources.horarios.find(ele => ele.idhorario === matricula.detalle[0].idhorario );


                    this.matricula.idmatricula       = matricula.idmatricula;
                    this.matricula.fecha             = [
                        matricula.fecha_inicio.split('/').reverse().join('-'),
                        matricula.fecha_fin.split('/').reverse().join('-')
                    ];
                    this.matricula.idconcepto        = matricula.idconcepto;
                    this.matricula.idempleado        = matricula.idempleado;
                    this.matricula.idsucursal        = matricula.idsucursal;
                    this.matricula.idtemporada       = matricula.idtemporada;
                    this.matricula.idprograma        = matricula.idprograma;
                    this.matricula.idnivel           = matricula.idnivel;
                    this.matricula.idcarril          = matricula.idcarril;
                    this.matricula.idfrecuencia      = matricula.idfrecuencia;
                    this.matricula.idhorario         = matricula.detalle[0].idhorario;
                    this.matricula.idcantidad_clases = matricula.idcantidad_clases;



                    this.matriculaHorarioDia = matricula.detalle.map(ele => ({
                        fecha: ele.fecha,
                        dia_name: ele.dia_nombre,
                        idhorario: ele.idhorario,
                        horario_nombre: horarioFind.nombre,
                    }))

                    this.codigoMatricula = matricula.idmatricula.toString().padStart(7,0);
                    this.getCountMatriculados();

                })
        },
        formatDate(date){
            return moment(date).format('DD/MM/YYYY');
        },
        resetData() {
            Object.assign(this.$data, this.$options.data.call(this));
            this.getResources();
        },
        getResources() {
            axios(route('matricula.resources'))
            .then( response => {
                const data = response.data;
                this.resources.tipoDocumentoIdentidad = data.resources.tipoDocumentoIdentidad;
                this.resources.departamentos        = data.resources.departamentos;
                this.resources.conceptos            = data.resources.conceptos;
                this.resources.temporadas           = data.resources.temporadas;
                this.resources.programas            = data.resources.programas;
                this.resources.cantidadClases     = data.resources.cantidadClases;

                this.temp.sucursal = data.current.sucursal;
                this.temp.temporada = data.current.temporada;
                this.temp.empleado = data.current.empleado;

                this.matricula.idsucursal = data.current.sucursal.idsucursal;
                this.matricula.idempleado = data.current.empleado.idusuario;
                this.matricula.idtemporada = data.current.temporada.idtemporada;

            })
            .catch( error => {
                const response = error.response;
                const data = response.data;
            })
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
        changeAlumnoTipoDocumentoIdentidad() {
            const tipoDocumento = this.resources.tipoDocumentoIdentidad.find(ele => ele.idtipo_documento_identidad === this.alumno.idtipo_documento_identidad );

            this.alumno.numero_documento_identidad = this.alumno.numero_documento_identidad.slice(0,tipoDocumento.caracteres_length);
            this.alumno.numero_documento_identidad_lemgth = tipoDocumento.caracteres_length;
        },
        changeAlumnoDepartamento() {
            this.getProvincias().then( data => {
                this.alumno.idprovincia = '';

                this.resources.distritos = [];
                this.alumno.iddistrito = '';
            });
        },
        changeAlumnoProvincia() {
            this.getDistritos().then( data => {
                this.alumno.iddistrito = '';
            });
        },
        validateAlumno() {
            const errors = [];
            const { alumno } = this;

            if (alumno.nombres.trim() === '') {
                errors.push('Por favor, ingrese su(s) nombre(s).')
            }

            if (alumno.apellidos.trim() === '') {
                errors.push('Por favor, ingrese su(s) apellido(s).')
            }

            if ( alumno.correo && !validarEmail(alumno.correo)) {
                errors.push('Por favor, proporcione una dirección de correo electrónico válida.')
            }

            // if (alumno.telefono.trim() === '') {
            //     errors.push('Por favor, ingrese su número de teléfono de contacto.')
            // }

            if (alumno.idtipo_documento_identidad === '' || alumno.idtipo_documento_identidad === null) {
                errors.push('Por favor, seleccione el tipo de documento de identidad válido.')
            }

            if (alumno.numero_documento_identidad.trim() === '') {
                errors.push('Por favor, ingrese el número de documento de identidad asociado.')
            }

            if (alumno.numero_documento_identidad.length > 0 && alumno.numero_documento_identidad.length < alumno.numero_documento_identidad_lemgth) {
                errors.push('Por favor, ingrese lo caracteres minimos del número de documento de identidad asociado.')
            }


            if (alumno.apoderado_nombres.trim() === '') {
                errors.push('Por favor, ingrese el nombre de una persona de referencia.')
            }

            if (alumno.apoderado_apellidos.trim() === '') {
                errors.push('Por favor, ingrese los apellidos de la persona de referencia.')
            }

            if (alumno.apoderado_correo && !validarEmail(alumno.apoderado_correo)) {
                errors.push('Por favor, proporcione una dirección de correo electrónico válida para la persona de referencia.')
            }

            // if (alumno.apoderado_telefono.trim() === '') {
            //     errors.push('Por favor, ingrese el número de teléfono de contacto de la persona de referencia.')
            // }

            return errors;
        },
        storeAlumno() {
            const errors = this.validateAlumno();
            if (errors.length > 0) {
                notificacion('error','Errores encontrados:', listErrorsForm(errors));
                return;
            }


            const alumnoData = jsonToFormData(this.alumno);

            axios.post(route('matricula.storeAlumno'), alumnoData)
            .then( response => {
                const data = response.data;
                this.alumno.idcliente = data.idcliente;
                this.stepCurrent = 2;
                scrollTo('#step-2',50,0);
            })


        },




        getProgramas(programaID = '') {
            return axios(route('matricula.programas',this.matricula.idtemporada))
            .then( response => {
                const data = response.data;
                this.resources.programas = data;
                this.matricula.idprograma = programaID;
            });
        },
        getNiveles(nivelID = '') {
            return axios(route('matricula.niveles',this.matricula.idprograma))
            .then( response => {
                const data = response.data;
                this.resources.niveles = data;
                this.matricula.idnivel = nivelID;
            });
        },
        getCarriles(carrilID = '') {
            return axios(route('matricula.carriles',this.matricula.idnivel))
            .then( response => {
                const data = response.data;
                this.resources.carriles = data;
                this.matricula.idcarril = carrilID;
            });
        },
        getFrecuencias(frecuenciaID = '') {
            return axios(route('matricula.frecuencias',this.matricula.idcarril))
            .then( response => {
                const data = response.data;
                this.resources.frecuencias = data;
                this.matricula.idfrecuencia = frecuenciaID;
            });
        },
        getHorarios(horarioID = '') {
            this.getCountMatriculados();
            return axios(route('matricula.horarios',this.matricula.idfrecuencia))
            .then( response => {
                const data = response.data;
                this.resources.horarios = data;
                this.matricula.idhorario = horarioID;
            });
        },
        getCountMatriculados() {
            const {idtemporada, idprograma, idnivel, idcarril, idfrecuencia} = this.matricula;

            if (!idtemporada || !idprograma || !idnivel || !idcarril || !idfrecuencia) return;


            return axios.get(route('matricula.cantidadDeAlumnosMatriculados'),{
                params: {
                    idtemporada: idtemporada,
                    idprograma: idprograma,
                    idnivel: idnivel,
                    idcarril: idcarril,
                    idfrecuencia: idfrecuencia
                }
            })
            .then( response => {
                const data = response.data;

                this.capacidadMaxima = data.capacidad_maxima;
                this.cantidadMatriculados = data.cantidad_matriculados;
            });
        },
        getDaysFromDate( fechaInicio, fechaFin, daysValid ) {
            const fechasDeseadas = [];

            while (fechaInicio.isSameOrBefore(fechaFin)) {
                const diaSemana = fechaInicio.day();

                if ( daysValid.includes(diaSemana.toString())) {
                    // fechasDeseadas.push(fechaInicio.clone());
                    fechasDeseadas.push({
                        name: fechaInicio.format('dddd (DD/MM/YYYY)'),
                        dia: fechaInicio.format('dddd'),
                        fecha: fechaInicio.format('YYYY-MM-DD'),
                    });
                }

                fechaInicio = fechaInicio.add(1, 'days');
            }

            return fechasDeseadas;
        },
        validateMatricula() {
            const errors = [];

            const { matricula } = this;

            if (!matricula.fecha || matricula.fecha.length !== 2) {
                errors.push('Por favor, ingrese un rango de fechas válido para la matrícula.');
            } else {
                const [fechaInicio, fechaFin] = matricula.fecha;

                if (!fechaInicio || !fechaFin || fechaInicio > fechaFin) {
                    errors.push('Por favor, ingrese un rango de fechas válido para la matrícula.');
                }

            }

            if (!matricula.idconcepto) {
                errors.push('Por favor, seleccione un concepto válido.');
            }

            if (!matricula.idtemporada) {
                errors.push('Por favor, seleccione una temporada válida.');
            }

            if (!matricula.idprograma) {
                errors.push('Por favor, seleccione un programa válido.');
            }

            if (!matricula.idnivel) {
                errors.push('Por favor, seleccione una nivel válida.');
            }

            if (!matricula.idcarril) {
                errors.push('Por favor, seleccione un carril válido.');
            }

            if (!matricula.idfrecuencia) {
                errors.push('Por favor, seleccione una actividad semanal válida.');
            }

            if (!matricula.idhorario) {
                errors.push('Por favor, seleccione un horario válido.');
            }

            if (!matricula.idcantidad_clases) {
                errors.push('Por favor, seleccione una cantidad de sesiones válida.');
            }

            return errors;
        },
        saveMatricula() {
            const errors = this.validateMatricula();

            if (errors.length > 0) {
                notificacion('error','Errores encontrados:', listErrorsForm(errors));
                return;
            }

            this.getCountMatriculados();

            const { matricula, resources: { tipoDocumentoIdentidad, departamentos, provincias, distritos, temporadas, programas, niveles, carriles, frecuencias, cantidadClases, horarios } } = this;

            const frecuenciasFind    = frecuencias.find(ele => ele.idfrecuencia === this.matricula.idfrecuencia );
            const cantidadClasesFind = cantidadClases.find(ele => ele.idcantidad_clases === this.matricula.idcantidad_clases );
            const horarioFind        = horarios.find(ele => ele.idhorario === this.matricula.idhorario );
            const daysValid          = frecuenciasFind.dias.split('-');


            const fechaInicio     = moment(matricula.fecha[0]);
            const fechaFin        = moment(matricula.fecha[1]);
            const dias            = this.getDaysFromDate( fechaInicio, fechaFin , daysValid );
            const diasAMatricular = dias.slice(0,daysValid.length).map(ele => ({
                fecha: ele.fecha,
                dia_name: ele.name,
                idhorario: horarioFind.idhorario,
                horario_nombre: horarioFind.nombre,
            }));



            this.temp.alumno.tipoDocumentoIdentidad = tipoDocumentoIdentidad.find(ele => ele.idtipo_documento_identidad === this.alumno.idtipo_documento_identidad );
            this.temp.alumno.departamento           = departamentos.find(ele => ele.iddepartamento === this.alumno.iddepartamento );
            this.temp.alumno.provincia              = provincias.find(ele => ele.idprovincia === this.alumno.idprovincia );
            this.temp.alumno.distrito               = distritos.find(ele => ele.iddistrito === this.alumno.iddistrito );

            this.temp.temporada      = temporadas.find(ele => ele.idtemporada === this.matricula.idtemporada );
            this.temp.programa       = programas.find(ele => ele.idprograma === this.matricula.idprograma );
            this.temp.nivel          = niveles.find(ele => ele.idnivel === this.matricula.idnivel );
            this.temp.carril         = carriles.find(ele => ele.idcarril === this.matricula.idcarril );
            this.temp.frecuencias    = frecuenciasFind;
            this.temp.cantidadClases = cantidadClasesFind;


            this.cantidadClasesMaxima = cantidadClasesFind.cantidad;
            this.matriculaHorarioDia  = diasAMatricular;
            this.resources.dias       = dias;
            this.stepCurrent          = 3;
            scrollTo('#step-3',50,0);

        },

        storeMatriculaHorario(){

            const { matricula, alumno, matriculaHorarioDia } = this;

            const matriculaData = {
                ...matricula,
                idcliente: alumno.idcliente,
                detalle : matriculaHorarioDia,
            };

            let URL_ACTION = route('matricula.storeMatricula');
            if (this.type == 'editar' ) {
                URL_ACTION = route('matricula.updateMatricula');
            }

            axios.post(URL_ACTION, matriculaData)
            .then( response => {
                const data = response.data;

                this.codigoMatricula = data.codigo;
                this.stepCurrent = 4;
                scrollTo('#step-4',50,0);

            });


        },
    },
    mounted(){
        this.getResources();

        if ( this.alumno_id ) {
            this.getAlumno(this.alumno_id)
            .then(() => {
                this.stepCurrent = 2;
            })
        }

        if ( this.matricula_id ) {
            this.getMatricula(this.matricula_id);
        }



    }



}
</script>

<style>

    .tableSelectHorario{
        overflow: hidden;
    }

    .tableSelecthorario-content{
        overflow: auto;
        white-space: nowrap;
    }

    .tableSelecthorario-content tr td.active{
        background-color: darkgreen;
        color: #fff;
        text-align: center;
    }

    .tableSelecthorario-content tr td>span{
        color: #aaa;
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
