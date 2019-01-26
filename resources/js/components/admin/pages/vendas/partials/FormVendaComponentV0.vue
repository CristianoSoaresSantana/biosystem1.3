<template>
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="form_main">
          <h4 class="heading"><strong>{{ title }}</strong></h4>
          <form class="form" @submit.prevent="onSubmit">
            <ul class="col-md-12 list-group">
                <li><h4>dados da venda</h4></li>
                <li class="list-group-item list-group-item-info">
                    <select class=" mb-2 mr-sm-2" display="inline" v-model="dataVenda.tipo_mov_id">
                      <option value>Tipo da movimentação</option>
                      <option
                        v-for="tipo_movimentacao in tipos_movimentacao"
                        :key="tipo_movimentacao.id"
                        :value="tipo_movimentacao.id"
                      >{{ tipo_movimentacao.tipo_movimentacao }}</option>
                    </select>
                    <select class=" mb-2 mr-sm-2" v-model="dataVenda.status">
                      <option value>Status</option>
                      <option>Aberto</option>
                      <option>Fechado</option>
                    </select>
                </li>
                <li class="list-group-item list-group-item-info">
                    Id_cliente: {{ dataVenda.cliente_id }} - Id_usuario: {{ dataVenda.user_id }} - Id_filial: {{dataVenda.filial_id}} - Tipo da movimentação: {{ dataVenda.tipo_mov_id }}
                </li>
                <li class="list-group-item list-group-item-info">
                    Status: {{dataVenda.status}} - Total da venda: R${{ dataVenda.valor_total }}
                </li>
            </ul>

            <ul class="col-md-12 list-group">
                <li><h4>Itens da venda</h4></li>
                <li class="list-group-item list-group-item-info" v-for="(item, index) in dataVenda.itens_venda" :key="index">
                    sku: {{ item.material_sku }} preço: R${{ item.valor_venda }}
                </li>
            </ul>
            <button type="submit" class="btn btn-primary">Finalizar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    update: {
      require: false,
      type: Boolean,
      default: false
    },

    venda: {
      require: false,
      type: Object
    },

    title: {
      require: true,
      type: String
    },

    filho_errors: {}
  },

  data() {
    return {
      errors: {},
      dataVenda: {
        cliente_id: '',
        filial_id: '',
        itens_venda: [],
        status: '',
        tipo_mov_id: '',
        user_id: '',
        valor_total: ''
      }
    }
  },

  computed: {
    filials() {
      return this.$store.state.branches.itens;
    },
    users() {
      return this.$store.state.usuarios.itens.data;
    },
    tipos_movimentacao() {
      return this.$store.state.tipo_movimentos.itens;
    }
  },

  watch: {
    errorsParent() {
      this.errors = this.filho_errors;
    },
    venda() {
        this.dataVenda = this.venda;
    }
  },

  methods: {
    onSubmit() {
      let createOrUpdate = this.update ? "vendasUpdate" : "vendasStore";

      this.$store
        .dispatch(createOrUpdate, this.venda)
        .then(() => {
          // notificação para usuario.
          this.$snotify.success("Ação realizada com sucesso!", "Parabéns...");
          this.$emit("success");
        })
        .catch(errors => {
          // notificação para usuario.
          this.$snotify.error("Você Errou!", "Atenção");
          this.errors = errors.response.data.errors;
        });
    }
  }
};
</script>

<style scoped>
.has-error {
  color: red;
}
.has-error input {
  border: 1px solid red;
}
</style>
