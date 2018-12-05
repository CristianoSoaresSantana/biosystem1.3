/**
 * Configuração de rotas do app,  
 * Vue.use(VueRouter), essa linha serve para vue reconhecer nossas rotas.
 * routes, array com todas as rotas que a app terá para usar os componentes.
 * router, objeto de VueRouter. 
 * por ultimo exportar router
 */

import Vue from 'vue'
import VueRouter from 'vue-router'


import FilialsComponet from '../components/admin/pages/filials/FilialsComponent'
Vue.use(VueRouter)

const routes = [
    {path: '/filials', component: FilialsComponet, name: 'filials'}
]

const router = new VueRouter({
    routes
})

export default router