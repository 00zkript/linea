<template lang="">
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
            <label for="tipoDocumentoIdentidad">Documento de identidad </label>
            <select name="tipoDocumentoIdentidad" id="tipoDocumentoIdentidad" class="form-control" v-model="alumno.idtipo_documento_identidad" @change="changeAlumnoTipoDocumentoIdentidad()" >
                <option :value="null" hidden selected >[---Seleccione---]</option>
                <option v-for="(item, index) in resources.tipoDocumentoIdentidad" :key="index" :value="item.idtipo_documento_identidad" v-text="item.nombre" ></option>
            </select>
        </div>

        <div class="col-md-6 col-12 form-group">
            <label for="numeroDocumentoIdentidad">N° de Documento </label>
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
                <option :value="null" hidden selected >[---Seleccione---]</option>
                <option v-for="(item, index) in resources.sexos" :key="index" :value="item.idsexo" v-text="item.nombre"></option>
            </select>
        </div>

        <div class="col-md-4 col-12 form-group">
            <label for="departamento">Departamento</label>
            <select class="form-control" name="departamento" id="departamento" title="Departamento" v-model="alumno.iddepartamento" @change="changeAlumnoDepartamento()" >
                <option :value="null" hidden selected >[---Seleccione---]</option>
                <option v-for="(item, index) in resources.departamentos" :key="index" :value="item.iddepartamento" v-text="item.nombre"></option>
            </select>
        </div>

        <div class="col-md-4 col-12 form-group">
            <label for="provincia">Provincia</label>
            <select class="form-control" name="provincia" id="provincia" title="Provincia" v-model="alumno.idprovincia" @change="changeAlumnoProvincia()" >
                <option :value="null" hidden selected >[---Seleccione---]</option>
                <option v-for="(item, index) in resources.provincias" :key="index" :value="item.idprovincia" v-text="item.nombre"></option>
            </select>
        </div>

        <div class="col-md-4 col-12 form-group">
            <label for="distrito">Distrito</label>
            <select class="form-control" name="distrito" id="distrito" title="Distrito" v-model="alumno.iddistrito">
                <option :value="null" hidden selected >[---Seleccione---]</option>
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
</template>
<script>
export default {
    props: {
        alumno: {
            type: Object,
            default() {
                return {};
            },
        },
        resources : {
            type: Object,
            default() {
                return {
                    tipoDocumentoIdentidad: [],
                    sexos: [
                        { idsexo: 'hombre', nombre: 'Hombre'},
                        { idsexo: 'mujer', nombre: 'Mujer'},
                        { idsexo: 'otro', nombre: 'Otro'}
                    ],
                    departamentos: [],
                    provincias: [],
                    distritos: [],
                }
            }
        }
    },
    methods: {
        soloNumeros: soloNumeros,
        catch(error) {
            if ( error.response === undefined) return console.error(error);

            const response = error.response;
            const data = response.data;

            if (response.status == 422){
                return alertModal({ type:'error', content: listErrors(data) });
            }

            if (response.status == 400){
                return alertModal({ type:'error', content: data.mensaje });
            }

            return alertModal({ type:'error', content: 'Error del servidor, contácte con soporte.' });


        },
        getProvincias() {
            return axios.get(route('matricula.provincias',[ this.alumno.iddepartamento ]))
            .then( response => {
                const data = response.data;
                this.resources.provincias = data;
            }).catch(this.catch);
        },
        getDistritos() {
            return axios.get(route('matricula.distritos',[ this.alumno.idprovincia ]))
            .then( response => {
                const data = response.data;
                this.resources.distritos = data;
            }).catch(this.catch);
        },
        changeAlumnoTipoDocumentoIdentidad() {
            const tipoDocumento = this.resources.tipoDocumentoIdentidad.find(ele => ele.idtipo_documento_identidad === this.alumno.idtipo_documento_identidad );

            this.alumno.numero_documento_identidad = this.alumno.numero_documento_identidad? this.alumno.numero_documento_identidad.slice(0,tipoDocumento.caracteres_length): '';
            this.alumno.numero_documento_identidad_lemgth = tipoDocumento.caracteres_length;
        },
        changeAlumnoDepartamento() {
            this.getProvincias().then( data => {
                this.alumno.idprovincia = null;

                this.resources.distritos = [];
                this.alumno.iddistrito = null;
            });
        },
        changeAlumnoProvincia() {
            this.getDistritos().then( data => {
                this.alumno.iddistrito = null;
            });
        },
    },
    mounted() {
    }

}
</script>
<style lang="">

</style>
