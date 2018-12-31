// import axios from 'axios'
// // importar url_base da group da api
// import { URL_BASE } from '../../../config/config'
// import { resolve } from "url";
// import { rejects } from "assert";

// // resource do crud
// const RESOURCE = 'compras'

export default {
    // comprasIndex (context) {
    //     context.commit('PRELOADER', true)

    //     axios.get(`${URL_BASE}${RESOURCE}`)
    //         .then(response => context.commit('MUTATION_LOAD_COMPRAS', response.data))
    //         .catch(errors => console.log(errors))
    //         .finally(() => context.commit('PRELOADER', false))
    // },

    // comprasShow (context, num_doc) {
    //     context.commit('PRELOADER', true)

    //     return new Promise((resolve, reject) => {
    //         axios.get(`${URL_BASE}${RESOURCE}/${num_doc}`)
    //             .then(response => resolve(response.data))
    //             .catch(errors => reject(errors))
    //             .finally(context.commit('PRELOADER', false))
    //     })
    // },

    // comprasStore (context, params) {
    //     context.commit('PRELOADER', true)

    //     return new Promise((resolve, reject) =>{
    //         axios.post(`${URL_BASE}${RESOURCE}`, params)
    //             // retorna resposta caso request teve success ou error!
    //             .then(response => resolve(response))
    //             .catch(errors => reject(errors))
    //             .finally(() => context.commit('PRELOADER', false))
    //     })
    // },

    // comprasUpdate (context, params) {
    //     context.commit('PRELOADER', true)

    //     return new Promise((resolve, reject) => {
    //         axios.put(`${URL_BASE}${RESOURCE}/${params.num_doc}`, params)
    //             // retorna resposta caso request teve success ou error!
    //             .then(response => resolve(response))
    //             .catch(errors => reject(errors))
    //             .finally(() => context.commit('PRELOADER', false))
    //     })
    // },

    // comprasDestroy (context, num_doc) {
    //     context.commit('PRELOADER', true)

    //     return new Promise((resolve, reject) => {
    //         axios.delete(`${URL_BASE}${RESOURCE}/${num_doc}`)
    //             // retorna resposta caso request teve success ou error!
    //             .then(response => resolve(response))
    //             .catch(errors => reject(errors))
    //             // recurso comentado para o preloader ser chamado ao recarregar table.
    //             .finally(() => context.commit('PRELOADER', false))
    //     })
    // },
}
