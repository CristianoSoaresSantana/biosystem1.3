/**
 * Configuração de rotas do app,  
 * Vue.use(VueRouter), essa linha serve para vue reconhecer nossas rotas.
 * routes, array com todas as rotas que a app terá para usar os componentes.
 * router, objeto de VueRouter. 
 * por ultimo exportar router
 */

import Vue from 'vue'
import VueRouter from 'vue-router'

import AdminComponent from '../components/admin/AdminComponent'
import DashboardComponent from '../components/admin/pages/dashboard/DashboardComponent'
import FilialsComponent from '../components/admin/pages/filials/FilialsComponent'
import CreateFilialComponent from '../components/admin/pages/filials/CreateFilialComponent'
import UpdateFilialComponent from '../components/admin/pages/filials/UpdateFilialComponent'

Vue.use(VueRouter)

const routes = [
    {
        path: '/admin', 
        component: AdminComponent,
        children: [
            {path: '', component: DashboardComponent, name: 'admin.dashboard'},
            {path: 'filials', component: FilialsComponent, name: 'admin.filials'},
            {path: 'filials/create', component: CreateFilialComponent, name: 'admin.filials.create'},
            {path: 'filials/:id/update', component: UpdateFilialComponent, name: 'admin.filials.update', props:true}
        ]
    },
]

const router = new VueRouter({
    routes
})

export default router