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

import BranchesComponent from '../components/admin/pages/branches/BranchesComponent'
import MaterialsComponent from '../components/admin/pages/materials/MaterialsComponent'
import TipoMaterialsComponent from '../components/admin/pages/tipo_materials/TipoMaterialsComponent'
import FormaFarmaceuticasComponent from '../components/admin/pages/forma_farmaceuticas/FormaFarmaceuticasComponent'

Vue.use(VueRouter)

const routes = [
    {
        path: '/',
        component: AdminComponent,
        children: [
            {path: 'admin', component: DashboardComponent, name: 'admin.dashboard'},
            // rotas de materials
            {path: 'branches', component: BranchesComponent, name: 'admin.branches'},
            {path: 'materials', component: MaterialsComponent, name: 'admin.materials'},
            {path: 'tipo_materials', component: TipoMaterialsComponent, name: 'admin.tipo_materials'},
            {path: 'forma_farmaceutica', component: FormaFarmaceuticasComponent, name: 'admin.forma_farmaceuticas'}
        ]
    },
]

const router = new VueRouter({
    routes
})

export default router
