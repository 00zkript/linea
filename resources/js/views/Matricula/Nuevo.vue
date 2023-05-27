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
                        <label for="fechaNacimiento">Fecha de nacimiento </label>
                        <DatePicker input-class="form-control" value-type="format" v-model="alumno.fecha_nacimiento" ></DatePicker>
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
                            <option value="" hidden >[---Seleccione---]</option>
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
                        <input type="file" id="imagenAlumno" name="imagenAlumno" >
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
                    <label for="fecha">Periodo desde - hasta <span class="text-danger">(*)</span></label>
                    <DatePicker input-class="form-control" value-type="format" range v-model="matricula.fecha" placeholder="Periodo desde - hasta" ></DatePicker>
                </div>
                <div class="col-md-4 col-12 form-group">
                    <label for="temporada">Temporada <span class="text-danger">(*)</span></label>
                    <select class="form-control" id="temporada" v-model="matricula.idtemporada" @change="getProgramas()" >
                        <option value="" hidden >[---Seleccione---]</option>
                        <option v-for="(item, index) in resources.temporadas" :key="index" :value="item.idtemporada" v-text="item.nombre"></option>
                    </select>
                </div>
                <div class="col-md-4 col-12 form-group">
                    <label for="programa">Programa <span class="text-danger">(*)</span></label>
                    <select class="form-control" id="programa" v-model="matricula.idprograma">
                        <option value="" hidden >[---Seleccione---]</option>
                        <option v-for="(item, index) in resources.programas" :key="index" :value="item.idprograma" v-text="item.nombre"></option>
                    </select>
                </div>
                <div class="col-md-4 col-12 form-group">
                    <label for="pisciona">Piscina <span class="text-danger">(*)</span></label>
                    <select class="form-control" id="pisciona" v-model="matricula.idpiscina" @change="getCarriles()">
                        <option value="" hidden >[---Seleccione---]</option>
                        <option v-for="(item, index) in resources.piscinas" :key="index" :value="item.idpiscina" v-text="item.nombre"></option>
                    </select>
                </div>
                <div class="col-md-4 col-12 form-group">
                    <label for="carril">Carril <span class="text-danger">(*)</span></label>
                    <select class="form-control" id="carril" v-model="matricula.idcarril">
                        <option value="" hidden >[---Seleccione---]</option>
                        <option v-for="(item, index) in resources.carriles" :key="index" :value="item.idcarril" v-text="item.nombre"></option>
                    </select>
                </div>
                <div class="col-md-4 col-12 form-group">
                    <label for="diasDeActividad">Dias de actividad <span class="text-danger">(*)</span></label>
                    <select class="form-control" id="diasDeActividad" v-model="matricula.idactividad_semanal" @change="changeActividadSemanal()">
                        <option value="" hidden >[---Seleccione---]</option>
                        <option v-for="(item, index) in resources.actividadSemanal" :key="index" :value="item.idactividad_semanal" v-text="item.nombre"></option>
                    </select>
                </div>
                <div class="col-md-4 col-12 form-group">
                    <label for="cantidadDeSessiones">Cantidad de sessiones <span class="text-danger">(*)</span></label>
                    <select class="form-control" id="cantidadDeSessiones" v-model="matricula.idcantidad_sessiones">
                        <option value="" hidden >[---Seleccione---]</option>
                        <option v-for="(item, index) in resources.cantidadesDeSesiones" :key="index" :value="item.idcantidad_sesiion" v-text="item.nombre"></option>
                    </select>
                </div>
                <div class="col-12 mt-3 pl-0 pr-0" v-if="showTableSelectHorario" >
                    <table class="table table-bordered table-striped">
                        <thead class="table-primary">
                            <tr>
                                <th>N°</th>
                                <th>Horario</th>
                                <th v-for="(dia, index) in resources.dias" :key="index" v-text="dia.nombre"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(horario, index) in resources.horarios" :key="index">
                                <td class="table-primary" v-text="(index+1)"></td>
                                <td class="table-primary" v-text="horario.nombre"></td>
                                <td
                                    :class="{
                                        active: hasHorarioAnDia(horario.idhorario, dia.iddia)
                                    }"
                                    v-for="(dia, index2) in resources.dias" :key="index2"
                                    @click="selectDia( horario.idhorario, dia.iddia )"
                                    >
                                    <i class="fa-solid fa-check" v-if="hasHorarioAnDia(horario.idhorario, dia.iddia)"></i>
                                </td>
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

const settingFileInput = {
    theme : 'fa',
    language : 'es',
    uploadAsync : false,
    showUpload : false,
    allowedFileTypes : ["image"],
    // allowedFileExtensions :['jpg', 'png', 'jpeg','gif','webp','tiff','tif','svg','bmp','mp4'],
    overwriteInitial : false,
    initialPreviewAsData : true,
    removeFromPreviewOnError : true,
    fileActionSettings : {
        showRemove  : false,
        showUpload  : false,
        showZoom    : true,
        showDrag    : false
    },
}


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
            current: {
                empleado: {},
                sucursal: {},
                temporada: {},
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
                idconcepto: 1,
                idempleado: '',
                idsucursal: '',
                idtemporada: '',
                idprograma: '',
                idpiscina: '',
                idcarril: '',
                idactividad_semanal: '',
                idcantidad_sessiones: '',
            },
            matriculaDetalle: [],
            showTableSelectHorario: false,
        };
    },
    methods: {
        soloNumeros: soloNumeros,
        resetData() {
            Object.assign(this.$data, this.$options.data.call(this));
            this.getResources();
            setTimeout(() => {
                $("#imagenAlumno").fileinput('destroy').fileinput(settingFileInput);
            }, 100);
        },
        getResources() {
            axios(route('matricula.resources'))
            .then( response => {
                const data = response.data;
                this.resources.tipoDocumentoIdentidad = data.resources.tipoDocumentoIdentidad;
                this.resources.departamentos        = data.resources.departamentos;
                this.resources.conceptos            = data.resources.conceptos;
                this.resources.sucursales           = data.resources.sucursales;
                this.resources.temporadas           = data.resources.temporadas;
                this.resources.programas           = data.resources.programas;
                this.resources.piscinas             = data.resources.piscinas;
                this.resources.actividadSemanal     = data.resources.actividadSemanal;
                this.resources.cantidadesDeSesiones = data.resources.cantidadesDeSesiones;
                this.resources.horarios             = data.resources.horarios;
                this.resources.dias                 = data.resources.dias;

                this.current.sucursal = data.current.sucursal;
                this.current.temporada = data.current.temporada;
                this.current.empleado = data.current.empleado;

                this.matricula.idsucursal = data.current.sucursal.idsucursal;
                this.matricula.idtemporada = data.current.temporada.idtemporada;

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
            // console.log(imagenes);
            // return;

            const alumnoData = jsonToFormData(this.alumno);

            axios.post(route('matricula.storeAlumno'), alumnoData)
            .then( response => {
                const data = response.data;
                this.stepCurrent = 2;
                this.alumno.idcliente = data.idcliente;
            })


        },
        getProgramas() {
            const idtemporada = this.matricula.idtemporada;
            const temporada = this.resources.temporadas.find( ele => ele.idtemporada === idtemporada);
            const programas = temporada.programas;
            this.resources.programas = programas;
            this.matricula.idprograma = '';
        },
        getCarriles() {
            const idpiscina = this.matricula.idpiscina;
            const piscina = this.resources.piscinas.find( ele => ele.idpiscina === idpiscina);
            const carriles = piscina.carriles;
            this.resources.carriles = carriles;
            this.matricula.idcarril = '';
        },
        changeActividadSemanal() {
            const idactividadSemanal = this.matricula.idactividad_semanal;
            const actividadSemanal = this.resources.actividadSemanal.find( ele => ele.idactividad_semanal === idactividadSemanal );
            const dias = actividadSemanal.dias;

            this.resources.dias = dias;
            this.matriculaDetalle = [];
            this.showTableSelectHorario = true;
        },
        hasHorarioAnDia( idmatricula, iddia) {
            return this.matriculaDetalle.some( ele => ele.idmatricula === idmatricula && ele.iddia === iddia)
        },
        selectDia( idmatricula, iddia) {

            if (this.hasHorarioAnDia( idmatricula, iddia)) {
                this.matriculaDetalle = this.matriculaDetalle.filter( ele => ele.idmatricula === idmatricula && ele.iddia !== iddia || ele.idmatricula !== idmatricula && ele.iddia === iddia || ele.idmatricula !== idmatricula && ele.iddia !== iddia )
                return ;
            }

            this.matriculaDetalle.push({
                idmatricula: idmatricula,
                iddia: iddia,
                matricula_nombre: '',
                dia_nombre: '',
            })

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
            idcliente: 3,
            nombres: 'Juan Manual',
            apellidos: 'Perez Aguila',
            correo: 'JuanPa@gmail.com',
            telefono: '987654321',
            apoderado_nombres: 'Juan Manual',
            apoderado_apellidos: 'Perez Aguila',
            apoderado_correo: 'JuanPa@gmail.com',
            apoderado_telefono: '987654321',
            idtipo_documento_identidad: 1,
            numero_documento_identidad: '87654321',
            fecha_nacimiento: '1990-05-10',
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
            $("#imagenAlumno").fileinput(settingFileInput);
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
