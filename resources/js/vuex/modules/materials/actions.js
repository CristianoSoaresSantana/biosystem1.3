import axios from 'axios'
// importar url_base da group da api
import { URL_BASE } from '../../../config/config'

// resource do crud
const RESOURCE = 'materials'

export default {
    actionLoadMaterials (context, params) {
        context.commit('PRELOADER', true)

        axios.get(`${URL_BASE}${RESOURCE}`, {params})
            .then(response => context.commit('MUTATION_LOAD_MATERIALS', response.data))
            .catch(error => console.log(error))
            .finally(() => context.commit('PRELOADER', false))
    }, 

    storeMaterial (context, params) {
        context.commit('PRELOADER', true)
            
        return new Promise((resolve, reject) =>{
            axios.post(`${URL_BASE}${RESOURCE}`, params)
                // retorna resposta caso request teve success ou error!
                .then(response => resolve(response))
                .catch(errors => reject(errors.response))
                .finally(() => context.commit('PRELOADER', false))
        })
    }
}