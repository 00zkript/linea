require('./bootstrap');

import Vue from 'vue';
import { ZiggyVue } from 'ziggy';


// datapicker
import DatePicker from 'vue2-datepicker';
import 'vue2-datepicker/index.css';
import 'vue2-datepicker/locale/es';

import paginationLaravel from 'laravel-vue-pagination';

Vue.use(ZiggyVue, Ziggy);

// Register Vue Components Global
Vue.component('DatePicker', DatePicker);
Vue.component('pagination', paginationLaravel);


// Register Vue Pages
Vue.component('matricula-form', require('./views/Matricula/Form.vue').default);
Vue.component('matricula-gym-nuevo', require('./views/MatriculaGym/Nuevo.vue').default);

Vue.component('venta-form', require('./views/Venta/Form.vue').default);

// Initialize Vue
if (document.querySelector('#instanceVue')) {
    const InstanceVue = new Vue({
        el: '#instanceVue',
    });

}
