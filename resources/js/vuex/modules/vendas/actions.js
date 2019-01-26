import axios from 'axios'
// importar url_base da group da api
import { URL_BASE } from '../../../config/config'
import { resolve } from "url";
import { rejects } from "assert";

// resource do crud
const RESOURCE = 'vendas'

export default {
    vendasIndex (context) {
        context.commit('PRELOADER', true)

        axios.get(`${URL_BASE}${RESOURCE}`)
            .then(response => context.commit('MUTATION_LOAD_VENDAS', response.data))
            .catch(errors => console.log(errors))
            .finally(() => context.commit('PRELOADER', false))
    },

    vendasShow (context, id) {
        context.commit('PRELOADER', true)

        return new Promise((resolve, reject) => {
            axios.get(`${URL_BASE}${RESOURCE}/${id}`)
                .then(response => resolve(response.data))
                .catch(errors => reject(errors))
                .finally(context.commit('PRELOADER', false))
        })
    },

    vendasStore (context, params) {
        context.commit('PRELOADER', true)

        return new Promise((resolve, reject) =>{
            console.log(params);
            axios.post(`${URL_BASE}${RESOURCE}`, params)
                // retorna resposta caso request teve success ou error!
                .then(response => resolve(response))
                .catch(errors => reject(errors))
                .finally(() => context.commit('PRELOADER', false))
        })
    },

    vendasUpdate (context, params) {
        context.commit('PRELOADER', true)

        return new Promise((resolve, reject) => {
            axios.put(`${URL_BASE}${RESOURCE}/${params.id}`, params)
                // retorna resposta caso request teve success ou error!
                .then(response => resolve(response))
                .catch(errors => reject(errors))
                .finally(() => context.commit('PRELOADER', false))
        })
    },

    vendasDestroy (context, id) {
        context.commit('PRELOADER', true)

        return new Promise((resolve, reject) => {
            axios.delete(`${URL_BASE}${RESOURCE}/${id}`)
                // retorna resposta caso request teve success ou error!
                .then(response => resolve(response))
                .catch(errors => reject(errors))
                // recurso comentado para o preloader ser chamado ao recarregar table.
                .finally(() => context.commit('PRELOADER', false))
        })
    },
}
