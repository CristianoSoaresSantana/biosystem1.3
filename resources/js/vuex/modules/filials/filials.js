import { resolve } from "url";
import { rejects } from "assert";

/**
 * Este modulo gerenciar filials!
 */
export default {
    state: {
        itens: {
            data: []
        },
    },

    mutations: {
        LOAD_FILIALS (state, filials){
            state.itens = filials
        }
    },

    actions: {
        /**
         * Carrega uma lista de filiais, atraves do api/filials.
         * Alterando estado do preloader.
         * @param {*} context 
         */
        loadFilials (context) {

            context.commit('PRELOADER', true)

            axios.get('/api/filials')
                .then(response => {
                    console.log(response)
                    context.commit('LOAD_FILIALS', response)
                })
                .catch(errors => {
                    console.log(errors)
                })
                .finally(() => context.commit('PRELOADER', false))
        },

        /**
         * Carrega uma filial especifica, atraves do api/filials.
         * Alterando estado do preloader.
         * @param {*} context 
         */
        loadFilial (context, id) {

            context.commit('PRELOADER', true)
            return new Promise((resolve, reject) =>{
                axios.get(`/api/filials/${id}`)
                    // retorna resposta caso request teve success ou error!
                    .then(response => resolve(response.data))
                    .catch(errors => reject(errors))
                    .finally(() => context.commit('PRELOADER', false))
            })

        },

        /**
         * Cadastrar nova filial com uma chamada ajax.
         * Utiliza api/filials no metodo store
         * @param {*} context, propria referencia do VUEjs
         * @param {*} params, recebe os dados submetidos!
         */
        storeFilial (context, params) {
            context.commit('PRELOADER', true)
            
            return new Promise((resolve, reject) =>{
                axios.post('/api/filials', params)
                    // retorna resposta caso request teve success ou error!
                    .then(response => resolve(response))
                    .catch(errors => reject(errors))
                    .finally(() => context.commit('PRELOADER', false))
            })
        }


    },

    getters: {

    }
}