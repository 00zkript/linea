require('./bootstrap');

import Vue from 'vue';
import { ZiggyVue } from 'ziggy';



Vue.use(ZiggyVue, Ziggy);

// import route from 'ziggy';

// Register Vue Components
// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('Matricula', require('./pages/Matricula.vue').default);

// Initialize Vue
const InstanceVue = new Vue({
    el: '#instanceVue',
});
