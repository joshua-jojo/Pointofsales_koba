require('./bootstrap');
import { createApp, h } from 'vue'
import { createInertiaApp, Link } from '@inertiajs/inertia-vue3'
import route from "ziggy-js";
import { InertiaProgress } from '@inertiajs/progress';
import VueApexCharts from "vue3-apexcharts";
import Vue3EasyDataTable from 'vue3-easy-data-table';
import 'vue3-easy-data-table/dist/style.css';
import AOS from 'aos';
import 'aos/dist/aos.css'


var username = localStorage.getItem('username')
createInertiaApp({
  resolve: name => require(`./Pages/${name}`),
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin,VueApexCharts,AOS.init()) // use the plugin
      .component('Link',Link,InertiaProgress.init({color: '#72FFFF',}))
      .component('DataTable',Vue3EasyDataTable)
      .provide('username', username)
      .mixin({ methods: { route }})
      .mount(el)
  },
})