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
        }
    },

    getters: {

    }
}