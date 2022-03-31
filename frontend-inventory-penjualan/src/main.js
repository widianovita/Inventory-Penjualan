import Vue from 'vue'
import App from './App.vue'

Vue.config.productionTip = false

// import bootstrap css & js
import 'bootstrap/dist/css/bootstrap.css'
import 'jquery/dist/jquery.min'
import 'popper.js/dist/popper.min'
import 'bootstrap/dist/js/bootstrap.min'

// import vue router
import VueRouter from 'vue-router'

Vue.use(VueRouter);

// import component
import ItemIndex from './components/items/Index'
import ItemCreate from './components/items/Create'
import ItemEdit from './components/items/Edit'

const router = new VueRouter({
  routes: [{
      path: '/',
      name: 'items',
      component: ItemIndex
    },
    {
      path: '/create',
      name: '/create',
      component: ItemCreate
    },
    {
      path: '/edit/:id',
      name: 'edit',
      component: ItemEdit
    }
  ],
  mode: 'history'
})

new Vue({
  router,
  render: h => h(App)
}).$mount('#app')
