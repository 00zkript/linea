require('./bootstrap');

import Vue from 'vue';
import { ZiggyVue } from 'ziggy';

import DatePicker from 'vue2-datepicker';
import 'vue2-datepicker/index.css';

Vue.use(ZiggyVue, Ziggy);

// import route from 'ziggy';

// Register Vue Components Global
Vue.component('DatePicker', DatePicker);


// Register Vue Pages
// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('matricula-nuevo', require('./Pages/Matricula/Nuevo.vue').default);

// Initialize Vue
if (document.querySelector('#instanceVue')) {
    const InstanceVue = new Vue({
        el: '#instanceVue',
    });

}
