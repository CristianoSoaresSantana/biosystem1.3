export default {
    state: {
        loading: true,
    },

    mutations: {
        PRELOADER (state, Status) {
            state.loading = status
        }
    }
}