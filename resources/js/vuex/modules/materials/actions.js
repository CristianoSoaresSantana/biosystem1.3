import axios from 'axios'
// importar url_base da group da api
import { URL_BASE } from '../../../config/config'

// resource do crud
const RESOURCE = 'materials'

export default {
    actionLoadMaterials (context) {
        context.commit('PRELOADER', true)

        axios.get(`${URL_BASE}${RESOURCE}`)
            .then(response => context.commit('MUTATION_LOAD_MATERIALS', response.data))
            .catch(error => console.log(error))
            .finally(() => context.commit('PRELOADER', false))
    }
}