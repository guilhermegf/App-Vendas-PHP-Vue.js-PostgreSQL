import { createApp } from 'vue'
import App from './App.vue'
import router from './router.js'
import 'bootstrap/dist/css/bootstrap.min.css'
import 'bootstrap/dist/js/bootstrap.min.js'

import '@mdi/font/css/materialdesignicons.min.css'
import 'material-design-icons-iconfont/dist/material-design-icons.css'


const app = createApp(App)
app.use(router)
app.mount('#app')

