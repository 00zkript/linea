require('./bootstrap');

import Vue from 'vue';
import { ZiggyVue } from 'ziggy';

// datapicker
import DatePicker from 'vue2-datepicker';
import 'vue2-datepicker/index.css';

// primeVue
// import PrimeVue from 'primevue/config';

// import 'primevue/resources/themes/lara-light-indigo/theme.css'
// import 'primevue/resources/primevue.min.css'
// import 'primeicons/primeicons.css'

// import route from 'ziggy';
Vue.use(ZiggyVue, Ziggy);
// Vue.use(PrimeVue);

// Register Vue Components Global
Vue.component('DatePicker', DatePicker);


// Register Vue Pages
// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('matricula-nuevo', require('./views/Matricula/Nuevo.vue').default);
Vue.component('matricula-gym-nuevo', require('./views/MatriculaGym/Nuevo.vue').default);

Vue.component('venta-nuevo', require('./views/Venta/Nuevo.vue').default);

// Initialize Vue
if (document.querySelector('#instanceVue')) {
    const InstanceVue = new Vue({
        el: '#instanceVue',
    });

}
