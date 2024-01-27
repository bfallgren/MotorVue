require('./bootstrap');

import Vue from 'vue';

import BootstrapVue from "bootstrap-vue"
Vue.use (BootstrapVue)

import VueRouter from 'vue-router';
Vue.use(VueRouter);

import VueAxios from 'vue-axios';
import axios from 'axios';

import App from './App.vue';
Vue.use(VueAxios, axios);

import Vuelidate from 'vuelidate';
Vue.use(Vuelidate);

import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
Vue.use(Vuetify);

import Swal from "sweetalert2";
window.Swal = Swal;

//import '@fortawesome/fontawesome-free/css/all.css';
//import '@fortawesome/fontawesome-free/js/all.js';
import { library } from '@fortawesome/fontawesome-svg-core';
import { far } from '@fortawesome/free-regular-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

library.add(far);
Vue.component('font-awesome-icon', FontAwesomeIcon);

import HomeComponent from './components/vehicles/HomeComponent.vue';

import CreateVehicleComponent from './components/vehicles/CreateComponent.vue';
import IndexVehicleComponent from './components/vehicles/IndexComponentNew.vue';
import EditVehicleComponent from './components/vehicles/EditComponent.vue';
import ShowVehicleComponent from './components/vehicles/ShowComponent.vue';

import CreatePowerDevComponent from './components/powerdevs/CreateComponent.vue';
import IndexPowerDevComponent from './components/powerdevs/IndexComponentNew.vue';
import EditPowerDevComponent from './components/powerdevs/EditComponent.vue';
import ShowPowerDevComponent from './components/powerdevs/ShowComponent.vue';

import CreateTaskComponent from './components/tasks/CreateComponent.vue';
import IndexTaskComponent from './components/tasks/IndexComponentNew.vue';
import EditTaskComponent from './components/tasks/EditComponent.vue';

import CreateServiceComponent from './components/services/CreateComponent.vue';
import IndexServiceComponent from './components/services/IndexComponentNew.vue';
import EditServiceComponent from './components/services/EditComponent.vue';

import CreateLinksComponent from './components/links/CreateComponent.vue';
import IndexLinksComponent from './components/links/IndexComponentNew.vue';
import EditLinksComponent from './components/links/EditComponent.vue';

const routes = [
  {
      name: 'home',
      path: '/',
      component: HomeComponent
  },
  //vehicles
  {
      name: 'createVehicle',
      path: '/vehicles/create',
      component: CreateVehicleComponent
  },
  {
      name: 'vehicles',
      path: '/vehicles/index',
      component: IndexVehicleComponent
  },
  {
      name: 'showVehicle',
      path: '/vehicles/show/:id',
      component: ShowVehicleComponent
  },
  {
      name: 'editVehicle',
      path: '/vehicles/edit/:id',
      component: EditVehicleComponent
  },
  //power devs
  {
    name: 'createPowerDev',
    path: '/powerdevs/create',
    component: CreatePowerDevComponent
},
{
    name: 'powerdevs',
    path: '/powerdevs/index',
    component: IndexPowerDevComponent
},
{
    name: 'showPowerDev',
    path: '/powerdevs/show/:id',
    component: ShowPowerDevComponent
},
{
    name: 'editPowerDev',
    path: '/powerdevs/edit/:id',
    component: EditPowerDevComponent
},
  //tasks
  {
      name: 'createTask',
      path: '/tasks/create',
      component: CreateTaskComponent
  },
  {
      name: 'tasks',
      path: '/tasks/index/:id',
      component: IndexTaskComponent
  },
  {
      name: 'editTask',
      path: '/tasks/edit/:id',
      component: EditTaskComponent
  },

  //services
  {
    name: 'createService',
    path: '/services/create',
    component: CreateServiceComponent
  },
  {
    name: 'services',
    path: '/services/index/:id',
    component: IndexServiceComponent
  },
  {
    name: 'editService',
    path: '/services/edit/:id',
    component: EditServiceComponent
  },

  //links
  {
    name: 'createLinks',
    path: '/links/create',
    component: CreateLinksComponent
  },
  {
    name: 'links',
    path: '/links/index',
    component: IndexLinksComponent
  },
  {
    name: 'editLinks',
    path: '/links/edit/:id',
    component: EditLinksComponent
  }
];

Vue.config.productionTip = true

const packageJson = require('../../package.json');
//console.log('packageJsonVersion:', packageJson.devDependencies.version);
Vue.prototype.axios_version = packageJson.devDependencies.axios;
Vue.prototype.bootstrap_version = packageJson.devDependencies.bootstrap;
Vue.prototype.jquery_version = packageJson.devDependencies.jquery;
Vue.prototype.vue_version = packageJson.devDependencies.vue;

const router = new VueRouter({ mode: 'history', routes: routes});
//const app = new Vue(Vue.util.extend({ router }, App)).$mount('#app');

new Vue({
    el: '#app',
    vuetify: new Vuetify(),
    router,
    template: '<App/>',
    components: { App }
  })


