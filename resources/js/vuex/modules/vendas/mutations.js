export default {
    MUTATION_LOAD_VENDAS (state, vendas) {
        state.itens = vendas
    },

    MUTATION_ITENS_VENDA (state, item) {
        state.itens_venda.push(item)
    },

    MUTATION_ADD_CLIENTE (state, cliente) {
        state.cliente = cliente
    },

    MUTATION_REMOVE_CLIENTE (state) {
        state.cliente = null
    },

    MUTATION_ADD_USUARIO (state, usuario) {
        state.usuario = usuario
    },

    MUTATION_SOMA(state, valor) {
        parseFloat(valor).toFixed(2);
        state.valor_total += valor
    }
}
