require('./bootstrap');

import Vue from 'vue';
import { ZiggyVue } from 'ziggy';

// datapicker
import DatePicker from 'vue2-datepicker';
import 'vue2-datepicker/index.css';


// import route from 'ziggy';
Vue.use(ZiggyVue, Ziggy);

// Register Vue Components Global
Vue.component('DatePicker', DatePicker);


// Register Vue Pages
// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('matricula-nuevo', require('./Pages/Matricula/Nuevo.vue').default);
Vue.component('matricula-gym-nuevo', require('./Pages/MatriculaGym/Nuevo.vue').default);

// Initialize Vue
if (document.querySelector('#instanceVue')) {
    const InstanceVue = new Vue({
        el: '#instanceVue',
    });

}
