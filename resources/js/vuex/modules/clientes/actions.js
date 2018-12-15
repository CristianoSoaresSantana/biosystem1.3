import axios from 'axios'
// importar url_base da group da api
import { URL_BASE } from '../../../config/config'
import { resolve } from "url";
import { rejects } from "assert";

// resource do crud
const RESOURCE = 'clientes'

export default {
    clienteLoadIndex (context, params) {
        context.commit('PRELOADER', true)

        axios.get(`${URL_BASE}${RESOURCE}`, {params})
            .then(response => context.commit('MUTATION_LOAD_CLIENTES', response.data))
            .catch(errors => console.log(errors))
            .finally(() => context.commit('PRELOADER', false))
    },

    clienteLoadShow (context, id) {
        context.commit('PRELOADER', true)

        return new Promise((resolve, reject) => {
            axios.get(`${URL_BASE}${RESOURCE}/${id}`)
                .then(response => resolve(response.data))
                .catch(errors => reject(errors))
                .finally(context.commit('PRELOADER', false))
        })
    },

    clienteStore (context, params) {
        context.commit('PRELOADER', true)

        return new Promise((resolve, reject) =>{
            axios.post(`${URL_BASE}${RESOURCE}`, params)
                // retorna resposta caso request teve success ou error!
                .then(response => resolve(response))
                .catch(errors => reject(errors))
                .finally(() => context.commit('PRELOADER', false))
        })
    },

    clienteUpdate (context, params) {
        context.commit('PRELOADER', true)

        return new Promise((resolve, reject) => {
            axios.put(`${URL_BASE}${RESOURCE}/${params.id}`, params)
                // retorna resposta caso request teve success ou error!
                .then(response => resolve(response))
                .catch(errors => reject(errors))
                .finally(() => context.commit('PRELOADER', false))
        })
    },

    clienteDestroy (context, sku) {
        context.commit('PRELOADER', true)

        return new Promise((resolve, reject) => {
            axios.delete(`${URL_BASE}${RESOURCE}/${sku}`)
                // retorna resposta caso request teve success ou error!
                .then(response => resolve(response))
                .catch(errors => reject(errors))
                // recurso comentado para o preloader ser chamado ao recarregar table.
                // .finally(() => context.commit('PRELOADER', false))
        })
    },
}
