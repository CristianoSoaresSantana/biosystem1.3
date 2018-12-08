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
// rotas de filials
import FilialsComponent from '../components/admin/pages/filials/FilialsComponent'
import CreateFilialComponent from '../components/admin/pages/filials/CreateFilialComponent'
import UpdateFilialComponent from '../components/admin/pages/filials/UpdateFilialComponent'
// rotas de materials
import MaterialsComponent from '../components/admin/pages/materials/MaterialsComponent'
Vue.use(VueRouter)

const routes = [
    {
        path: '/',
        component: AdminComponent,
        children: [
            {path: 'admin', component: DashboardComponent, name: 'admin.dashboard'},
            // rotas de filials
            {path: 'filials', component: FilialsComponent, name: 'admin.filials'},
            {path: 'filials/create', component: CreateFilialComponent, name: 'admin.filials.create'},
            {path: 'filials/:id/update', component: UpdateFilialComponent, name: 'admin.filials.update', props:true},

            // rotas de materials
            {path: 'materials', component: MaterialsComponent, name: 'admin.materials'},
        ]
    },
]

const router = new VueRouter({
    routes
})

export default router