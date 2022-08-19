require('./bootstrap');
import { createApp, h } from 'vue'
import { createInertiaApp, Link } from '@inertiajs/inertia-vue3'
import route from "ziggy-js";
import { InertiaProgress } from '@inertiajs/progress';
import VueApexCharts from "vue3-apexcharts";
import VueGoodTablePlugin from 'vue-good-table';
import 'vue-good-table/dist/vue-good-table.css'

var username = localStorage.getItem('username')
createInertiaApp({
  resolve: name => require(`./Pages/${name}`),
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin,VueApexCharts,VueGoodTablePlugin) // use the plugin
      .component('Link',Link,InertiaProgress.init({color: '#72FFFF',}))
      .provide('username', username)
      .mixin({ methods: { route }})
      .mount(el)
  },
})