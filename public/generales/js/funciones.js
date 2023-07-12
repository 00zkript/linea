

try {
    PNotify.defaults.textTrusted = true;
    PNotify.defaults.styling = 'brighttheme';
    PNotify.defaults.icons = 'fontawesome4';
} catch (error) {
    // console.log("no se importo pnotify");
}

let timeoutAlerModalId = null;
const alertModal = ({ title = '', content = '', time = 5000, type = 'error' }) => {
    // Limpiar el timeout anterior si existe
    if (timeoutAlerModalId) {
        clearTimeout(timeoutAlerModalId);
        timeoutAlerModalId = null;
    }

    const classArr = {
        error: 'bg-danger',
        success: 'bg-success',
        warning: 'bg-warning',
    }
    const classValue = classArr[type] ?? classArr['error'];
    const newTitle = title == 'Error' || (title == '' && type == 'error') ? '¡Atención!': title;


    $('#alertModalCenter #alertModalCenterTitle').html(newTitle);
    $('#alertModalCenter .contentAlertModal').html(content);
    $('#alertModalCenter .modal-content').addClass( classValue );
    $('#alertModalCenter').modal('show');


    timeoutAlerModalId = setTimeout(() => {
        $('#alertModalCenter').modal('hide');
        $('#alertModalCenter #alertModalCenterTitle').html('');
        $('#alertModalCenter .contentAlertModal').html('');
        $('#alertModalCenter .modal-content').removeClass( classValue );
    }, time);

}



let notificacion = function (tipo,titulo,mensaje,tiempo = 5*1000, options = null) {
    if (tipo === 'error' || tipo === 'success') {
        alertModal({
            type: tipo,
            title: titulo,
            content: mensaje,
            time: tiempo,
        });
        return ;
    }

    let config = {
        type:tipo,
        title: titulo,
        text: mensaje,
        // addClass: 'border_custom',
        cornerClass: 'ui-pnotify-sharp',
        // shadow: true,
        // width: '100%',
        delay: tiempo,
        stack:{
            dir1: 'down',
            firstpos1: 25,
            modal: true,
            maxOpen: Infinity
        },
    }

    if (options) {
        config = Object.assign(config,options);
    }


    PNotify.alert(config)

}

let cargando = function (texto = 'Cargando') {
    $('body').waitMe({
        effect : 'timer',
        text : texto,
        bg : 'rgba(255,255,255,0.7)',
        color : '#3F53FF',
        maxSize : '',
        waitTime : -1,
        textPos : 'vertical',
        fontSize : '',
        source : '',
    });
}

let stop = function () {
    $('body').waitMe("hide");
}

const empty = (param = "") => (param === "" || param === 0 || param === null || param.toString().trim() === "");


let waitMeEffectBounce = {
    effect: 'bounce',
    text: 'POR FAVOR ESPERA...',
    bg: 'rgba(255,255,255,0.7)',
    color: '#000',
    maxSize: '',
    waitTime: -1,
    source: 'img.svg',
    textPos: 'vertical',
    fontSize: '',
    onClose: function(el) {}
}



// funcion que simplifica las opcion y configuracion de la libreria toastr
const toast = ({ type, message, title = "", time = 5000, positionClass = "toast-top-full-width"}) => {
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": positionClass,
        // "positionClass": "toast-top-right",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": time,
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut",
        "escapeHtml": false
    }

    toastr[type](message,title)
}

// funcion para devolver una alerta personalizada  en cualquier div que tenga la clase "alerta"
const alerta = ({
    el = ".alerta",
    align = 'left',
    title = '',
    message = '',
    type = 'error',
    time = 5000,
    position = "relative"
} = '')  => {

    align = title == "" ? "center" : align;
    type = type == "error" ? "danger" : type;

    const titleHtml = title == "" ? "" : `<h4 class="alert-heading" style="font-size: 20px;text-align: ${align}">${title}</h4>`;
    const html = `
        <div class="alert alert-${ type } alerta-body" role="alert" style="border-radius: 10px;position: ${position}">
          ${titleHtml}
          <div style="word-break: break-word; text-align: ${align}">
            ${ message }
          </div>
        </div>
    `;
    $(el).html(html);

    setTimeout(function () {
        $(el).html("");
    },time)

}






// funcion  perzonalixada para la convercion de un numero a formato telefonico . resultado : 333-333-333
const formatPhone = (numero) => {
    return numero.toString().replace(/([0-9]{3})(\B)/g,"$1-");
}

// funcion que sirve de valdiacion para los input de  tipo text que se necesita convertir en numero
const numberToString = function(){
    this.value = this.value.replace(/[^0-9]/g, "");
}

const stringAlone = function(e) {
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();

    letras = " Ã¡Ã©Ã­Ã³ÃºabcdefghijklmnñÃ±opqrstuvwxyz";
    especiales = "8-37-39-46";

    tecla_especial = false
    for (var i in especiales) {
        if (key == especiales[i]) {
            tecla_especial = true;
            break;
        }
    }

    if (letras.indexOf(tecla) != -1 || tecla_especial){
        return true
    }

    return e.preventDefault();


}

const numberAlone = function(e) {

    var charCode = (e.which) ? e.which : e.keyCode;
    e.target.value = e.target.value.replace(/[^0-9]/g, "");

    if (charCode > 31 && (charCode < 48 || charCode > 57)){
        return e.preventDefault();
    }

    return true;
}








/** función apra valdiar el el eamil
 * @param { string } valor Correo
 * @return { bool }
 */
const validarEmail = (valor) => {
    // const regex = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
    const regex = /^[\w]+@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
    return regex.test(valor);
}

// funcion para validar contraseñas  con un minimo 8 caracteres y un maxiomo de 15 caracteres
const validarPassword = (valor) => {
    const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])([A-Za-z\d$@$!%*?&]|[^ ]){8,15}$/;
    return regex.test(valor)
}




// funcion para formatear fecha . entrada: 2021-12-31 => resultado : 31/12/2021
const reformatDate = (date) => {
    return date.split('-').reverse().join('/');
}

const reformatDateTime = (date) => {
    let result = 'SIN FECHA';

    if(! empty(date)){
        const $arrData = date.split(" ");
        const $date = reformatDate($arrData[0]);
        const $time = $arrData[1];
        result = $date+" "+$time;
    }

    return result;
}


const $nowDate = {
    unix() {
        return Date.now();
    } ,
    fechaString() {
        return new Date(this.unix())
    } ,
    anio() {
        return this.fechaString().getFullYear();
    } ,
    mes() {
        return (this.fechaString().getMonth() + 1).toString().padStart(2,0);
    } ,
    dia() {
        return this.fechaString().getDate().toString().padStart(2,0);
    } ,
    hora() {
        return this.fechaString().getHours().toString().padStart(2,0);
    } ,
    min() {
        return this.fechaString().getMinutes().toString().padStart(2,0);
    } ,
    seg() {
        return this.fechaString().getSeconds().toString().padStart(2,0);
    } ,
    date() {
        return this.anio() +'-'+ this.mes() +'-'+ this.dia();
    } ,
    time() {
        return this.hora() +':'+ this.min() +':'+ this.seg();
    } ,
    now() {
        return this.date()+' '+this.time();
    } ,
}


/**
 * función para dara formato a un numero
 * @param { float } number Numero
 * @param { int } decimals Decimal
 * @param { string } dec_point Separador de decimal
 * @param { string } thousands_sep  Separador de centenas
 * @return {string}
 */
const number_format = (number, decimals = 2, dec_point= ".", thousands_sep = "") => {
    // Strip all characters but numerical ones.
    number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
        };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
}

const convertFloat = (number,decimal = 2) => {
    return parseFloat(number).toFixed(decimal);
}


/**
* quita las etiquetas html del texto ingresado
* @param { string } html
* @return String
 */
const removeHmlFromText = (html) => {
    return html.replace(/(<([^>]+)>)/ig, '');
}


/**
* funcion para remoover un item de un arreglo
* @param { array } arr
* @param { string } item
* @return Array
 */
const removeItemArray = ( arr, item ) => {
    return arr.filter( function( e ) {
        return e !== item;
    } );
};



// funcion para devolver la posicion actual del scroll
const getOffset = (el) => {
    const rect = el.getBoundingClientRect();
    return {
        top: rect.top + window.scrollY,
        left: rect.left + window.scrollX,
    };
}

// funcion para hacer un scroll en un pocion espeicfica
const scrollTo = (selector, less = 100, time = 100 ) => {
    setTimeout(function(){
        window.scrollTo({
            top: getOffset(document.querySelector(selector)).top - less ,
            behavior: 'smooth'
        });
    }, time)

}

const scrollToAnimate = (offset, less = 0, speed = 1000 ) => {
    $('html, body').animate(
        {scrollTop: offset - less
        }, speed);

}



/**
 * función para eliminar los caracteres no numéricos y los guiones, de una cadena de texto
 * @param { string } text texto
 * @return int
 */
const numberAndDash = (text) => {
    return text.replace(/([^0-9-])/g,'');
}





const convertToFormData = (formData, data, parentKey) => {
    if (data && typeof data === 'object' && !(data instanceof Date) && !(data instanceof File)) {
        Object.keys(data).forEach(key => {
            convertToFormData(formData, data[key], parentKey ? `${parentKey}[${key}]` : key);
        });
    } else {
        const value = data == null ? '' : data;

        formData.append(parentKey, value);
    }
}

/**
 * función para convertirn un json a un formdata
 * @param {json} data Json a transformar
 * @return {FormData}
 */
const jsonToFormData = (data) => {
    const formData = new FormData();

    convertToFormData(formData, data);

    return formData;
}

const formDataToJson = (form) => {
    return Object.fromEntries(form);
}

/**
 * Retorna un número aleatorio entre 0 (incluido) y 1 (excluido)
 * @return {number}
 */
const getRandom = () => {
    return Math.random();
}

/**
 * Retorna un número aleatorio entre min (incluido) y max (excluido)
 * @param { float } min numero
 * @param { float } max numero
 * @return { float }
 */
const getRandomArbitrary = (min, max) => {
    return Math.random() * (max - min) + min;
}

// Retorna un entero aleatorio entre min (incluido) y max (excluido)
// ¡Usando Math.round() te dará una distribución no-uniforme!
const getRandomInt = (min, max) => {
    return Math.floor(Math.random() * (max - min)) + min;
}


/**
 * función para recorrer una lista de errores y traformarlo en una lista html
 * @param errors
 * @return {string}
 */
const listErrorsForm = (errors) => {
    let html = "<ul style='text-align: left'>";
    errors.forEach(error => {
        html += "<li>"+error+"</li>";
    } )
    html += "</ul>";

    return html;
}

/**
 * funcion para el caso de haber un error 427 (error de validación) en la peticion de axios
 * @param { array } data Lista de errores
 * @return string
  */
const listErrors = (data) => {
    let errors = data.errors;

    let msj = `<ul style="text-align: left">`;
    for(const key in errors){
        msj += `<li> ${ errors[key][0] } </li>`;
    }

    msj += `</ul>`;

    return msj;
}



const getFirstElemnto = (data) => {
    return data[Object.keys(data)[0]]
}

/**
 * Funcion para traer un objeto con las url y los setting necesarios del Fileinpput
 * @param { string } path ruta de la carpeta de las imagenes ejemplo "htttp::/example.com/imagense/etc..."
 * @param { array } data coleccion de objetos a transformar
 * @param { string || null } type Tipo de datos ejemplo "pdf"
 * @return {{settings: [], urls: []}}
 */
const allFilesData = (path, data, type = null ) => {

    const $urls = [];
    const $settings = [];

    if ( data.length > 0 ){

        data.forEach( (item ,idx) => {

            $urls.push(path+'/'+item.nombre);
            const setting = { caption : item.nombre , width : "120px", height : "120px", key : getFirstElemnto(item) };

            if (type){
                setting.type = type;
            }

            $settings.push(setting);

        })

    }

    return {urls : $urls, settings : $settings };
}



const validarSoloNumeros = (e) => {
    var charCode = (e.which) ? e.which : e.keyCode;
    e.target.value = e.target.value.replace(/[^0-9]/g, "");

    if (charCode > 31 && (charCode < 48 || charCode > 57)){
        return e.preventDefault();
    }

    return true;
}

const STR_PAD_LEFT = 0;
const STR_PAD_RIGHT = 1;
const str_pad = (string,maxLength ,pad_string = " ",pad_type = STR_PAD_RIGHT) => {

    if (pad_type === STR_PAD_LEFT){
        return string.toString().padStart(maxLength,pad_string)
    }

    return string.toString().padEnd(maxLength,pad_string)
}


// create function return str random
const str_random = (length) => {
    var result           = '';
    var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var charactersLength = characters.length;
    for ( var i = 0; i < length; i++ ) {
        result += characters.charAt(Math.floor(Math.random() * charactersLength));
    }
    return result;
}


const basename = (path) => {
    return path.split('/').pop();
}



function soloNumeros(e) {
    // e.preventDefault();

    // Backspace = 8, Enter = 13, ‘0′ = 48, ‘9′ = 57, ‘.’ = 46, ‘-’ = 43
    const key = window.Event ? e.which : e.keyCode;


    if( ( key >= 48 && key <= 57 ) || key == 8 || key == 13 || key == 0 ){
        return true;
    }

    return e.preventDefault();
}

function soloNumerosFloat(e) {
    // e.preventDefault();
    // const formatValid = /(^\d+|^)(\.\d+|\.|\d+)$/;
    const formatValid = /^\d+(\.\d+|\.|)$/;

    // Backspace = 8, Enter = 13, ‘0′ = 48, ‘9′ = 57, ‘.’ = 46, ‘-’ = 43
    const key = window.Event ? e.which : e.keyCode;
    const chark = String.fromCharCode(key);
    const tempValue = this.value+chark;

    if(key == 8 || key == 13 || key == 0) {
        return true;
    }

    if( ( key >= 48 && key <= 57 ) || key == 46){
        return formatValid.test(tempValue) ? true : e.preventDefault();
    }

    return e.preventDefault();

}

function soloNumerosPrice(e) {
    // e.preventDefault();
    const formatValid = /^\d+(\.\d{0,4}|\.|)$/;

    // Backspace = 8, Enter = 13, ‘0′ = 48, ‘9′ = 57, ‘.’ = 46, ‘-’ = 43
    const key = window.Event ? e.which : e.keyCode;
    const chark = String.fromCharCode(key);
    const tempValue = this.value+chark;

    if(key == 8 || key == 13 || key == 0) {
        return true;
    }

    if( ( key >= 48 && key <= 57 ) || key == 46){
        return formatValid.test(tempValue) ? true : e.preventDefault();
    }

    return e.preventDefault();

}

function soloLetras(e) {
    const key = e.keyCode || e.which;
    const tecla = String.fromCharCode(key).toLowerCase();
    const letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
    const especiales = [8, 37, 39, 46];
    const tecla_especial = false;

    for (var i in especiales) {
        if (key == especiales[i]) {
            tecla_especial = true;
            break;
        }
    }

    if (letras.indexOf(tecla) == -1 && !tecla_especial) {
        return e.preventDefault();
    }
}


$('.format-number').on('keypress', soloNumeros);
$('.format-number').on('paste', function () {
    const clipboard = event.clipboardData.getData('text/plain')
    const value = clipboard.replace(/[^\d]/g,'');
    $(this).val(value);
    event.preventDefault();
});

$('.format-number-float').on('keypress', soloNumerosFloat);
$('.format-number-float').on('paste', function () {
    const clipboard = event.clipboardData.getData('text/plain')
    const value = clipboard.replace(/[^\d\.]/g,'').split('.').filter(ele => ele).join('-').replace(/\-/i,'.').replace(/\-/g,'')
    $(this).val(value);
    event.preventDefault();
});

$('.format-number-price').on('keypress', soloNumerosPrice);
$('.format-number-price').on('paste', function () {
    const clipboard = event.clipboardData.getData('text/plain')
    const value = clipboard.replace(/[^\d\.]/g,'').split('.').filter(ele => ele).join('-').replace(/\-/i,'.').replace(/\-/g,'')
    const search = value.indexOf('.');
    if (search === -1) {
        $(this).val(value);
        return event.preventDefault();
    }


    $(this).val(value.slice(0,search+5));
    return event.preventDefault();
});

$('.format-text').on('keypress', soloLetras);


