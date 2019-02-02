<template>
  <div class="container">
      <h1>{{ title }}</h1>
        <form class="form" @submit.prevent="onSubmit">
            <h4><small>Informe o status e o tipo de movimentação</small></h4>
            <div class="row">
                <div class="input-group input-group-sm mb-3">
                    <label for="exampleFormControlSelect1">Status:</label>
                    <select class="form-control" id="exampleFormControlSelect1" v-model="status">
                        <option value="Aberto">Aberto</option>
                        <option value="Aguardando pagamento">Aguardando pagamento</option>
                        <option value="Fechado">Fechado</option>
                    </select>
                    <label for="exampleFormControlSelect1">Tipo de movimentação:</label>
                    <select class="form-control" id="exampleFormControlSelect1" v-model="tipo_mov_id">
                        <option value="3">Saida</option>
                        <option value="2">Transferência</option>
                        <option value="1">Entrada</option>
                    </select>
                </div>
            </div>
            <h4>Itens da venda</h4>
            <div class="form-group" display="flex" justify-content="space-evelyn">
                <div class="row" v-for="(item, index) in dados_venda.itens_venda" :key="index">
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Sku</span>
                        </div>
                        <input v-model="item.sku" type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" size="8" readonly>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Lote</span>
                        </div>
                        <input v-model="item.lote" type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" size="8">
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">quantidade</span>
                        </div>
                        <input v-model="item.quantidade" @blur="item.sub_total = multiplicarItens(item.valor_unitario, item.quantidade)" type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm"  size="8">
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Preço</span>
                        </div>
                        <input v-model="item.valor_unitario" type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm"  size="8" readonly>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">Sub-Total</span>
                        </div>
                        <input v-model="item.sub_total" @blur="somarItens(item.sub_total)" type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm"  size="6" readonly>
                    </div>
                </div>
            </div>
            <h4>Dados da venda</h4>
            <div class="row">
                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Cliente_id</span>
                    </div>
                    <input v-model="dados_venda.cliente_id" type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" readonly>
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Usuário_id</span>
                    </div>
                    <input v-model="dados_venda.cliente_id" type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" readonly>
                </div>
                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Valor Total</span>
                    </div>
                    <input v-model="valor_total" type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" readonly>
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Desconto</span>
                    </div>
                    <input v-model="desconto" type="text" @blur="total_com_desconto = aplicarDesconto(valor_total, desconto)" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Total com desconto</span>
                    </div>
                    <input v-model="total_com_desconto" type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" readonly>
                </div>
            </div>
            <div class="row">
                <div class="input-group input-group-md col-12">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Justifique o desconto</span>
                    </div>
                    <input v-model="justificativa" type="text" size="20" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                </div>
                <div class="input-group input-group-md col-12">
                     <button type="submit" class="btn btn-primary">Finalizar</button>
                </div>
            </div>
        </form>
  </div>
</template>

<script>
export default {
    props: {
        venda: {
            require: true
        },

        title: {
            require: true,
            type: String
        }
    },

    data() {
        return {
            dados_venda: [],
            desconto: '',
            total_com_desconto: '',
            justificativa: '',
            status: 'Aberto',
            tipo_mov_id: '3',
            valor_total: ''
        }
    },

    watch: {
        venda() {
            this.dados_venda = this.venda;
        }
    },

    methods: {
        onSubmit() {
            this.dados_venda['desconto'] = this.desconto;
            this.dados_venda['justificativa'] = this.justificativa;
            this.dados_venda['status'] = this.status;
            this.dados_venda['tipo_mov_id'] = this.tipo_mov_id;
            this.dados_venda['valor_total'] = this.valor_total;
            this.dados_venda['total_com_desconto'] = this.total_com_desconto;

            this.$store.dispatch("vendasStore", this.dados_venda)
            .then(() => {
                // notificação para usuario.
                this.$snotify.success("Ação realizada com sucesso!", "Parabéns...");
                this.$emit("success");
            }).catch(errors => {
                // notificação para usuario.
                this.$snotify.error("Você Errou!", "Atenção");
                this.errors = errors.response.data.errors;
            });
        },

        multiplicarItens(valor, quantidade){
            return parseFloat(valor * quantidade).toFixed(2);
        },

        aplicarDesconto(valor, quantidade){
            return parseFloat(valor - quantidade).toFixed(2);
        },

        somarItens(valor) {
            var valorFloat = parseFloat(valor);
            this.$store.commit('MUTATION_SOMA', valorFloat);
            this.valor_total = parseFloat(this.$store.state.vendas.valor_total).toFixed(2)
        }
    }
}
</script>
<style scoped>
.row {
    display: flex;
    flex-wrap: wrap;
    margin-right: 0px;
    margin-left: 0px;
}

.col-12 {
    -webkit-box-flex: 0;
    flex: 0 0 100%;
    max-width: 100%;
    margin-left: -15px;
}
</style>
