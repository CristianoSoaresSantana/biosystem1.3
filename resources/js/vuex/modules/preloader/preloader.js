/**
 * Modulo preloader fica com status false até o mutations muda-lo para true!
 * No store eu exponho este component e na view eu declaro a tag deste component!
 * Isso acontece no modulo filials!
 */
export default {
    state: {
        loading: false,
    },

    mutations: {
        PRELOADER (state, status) {
            state.loading = status
        }
    }
}