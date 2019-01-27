<template>
  <div class="container">
      <h1>{{ title }}</h1>
        <form class="form" @submit.prevent="onSubmit">
            <ul class="col-md-12 list-group">
                <li v-for="(item, index) in dados_venda.itens_venda" :key="index" class="list-group-item list-group-item-primary">
                    Item: {{index}} Filial {{ item.filial_id }} SKU: {{ item.material_sku }} Preço {{ item.valor_venda }}
                </li>
                <br>
                <li class="list-group-item list-group-item-primary"> <h4> Total = {{ dados_venda.valor_total }} </h4> </li>
                <li class="list-group-item list-group-item-primary"> <h4> Desconto = <input type="text" v-model="desconto" size="4" placeholder="102.99"> </h4> </li>
                <li class="list-group-item list-group-item-primary"> <h3> Novo Total = {{ this.total_com_desconto = parseFloat(dados_venda.valor_total - desconto).toFixed(2) }} </h3> </li>
                <li class="list-group-item list-group-item-primary">
                    <h5>
                        Status =
                        <select name="" id="" v-model="status">
                            <option value="Aberto">Aberto</option>
                            <option value="Aguardando pagamento">Aguardando pagamento</option>
                            <option value="Fechado">Fechado</option>
                        </select>
                    </h5>
                    <h5>
                        Tipo movimento =
                        <select name="" id="" v-model="tipo_mov_id">
                            <option value="3">Saida</option>
                            <option value="2">Transferência</option>
                            <option value="1">Entrada</option>
                        </select>
                    </h5>
                    <h5>
                        Justifique o desconto =
                        <select name="" id="" v-model="justificativa">
                            <option value="Não houve descontos">Não houve descontos</option>
                            <option value="Voltou a comprar conosco">Voltou a comprar conosco</option>
                            <option value="Alegou um preço menor no concorrente">Alegou um preço menor no concorrente</option>
                            <option value="Faltou uma fração do valor Total">Faltou uma fração do valor Total</option>
                        </select>
                    </h5>
                </li>
                <button type="submit" class="btn btn-primary">Finalizar</button>
            </ul>
        </form>
  </div>
</template>

<script>
export default {
    props: {
        venda: {
            require: true,
            type: Object
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
            status: '',
            tipo_mov_id: ''
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
        }
    }
}
</script>
