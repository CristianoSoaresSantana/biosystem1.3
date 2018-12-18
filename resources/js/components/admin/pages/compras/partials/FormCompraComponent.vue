<template>
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="form_main">
          <h4 class="heading">
            <strong>{{ title }}</strong>
            <span></span>
          </h4>
          <form class="form" @submit.prevent="onSubmit">
            <div class="form-group col-md-12">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <div :class="['col-auto', {'has-error': errors.num_doc}]">
                    <div v-if="errors.num_doc">{{ errors.num_doc[0] }}</div>
                    <input
                      type="text"
                      v-model="compra.num_doc"
                      class="form-control mb-2 mr-sm-2"
                      placeholder="num_doc"
                    >
                  </div>
                </div>
                <div class="form-group col-md-6">
                  <div :class="['col-auto', {'has-error': errors.valor_nota}]">
                    <div v-if="errors.valor_nota">{{ errors.valor_nota[0] }}</div>
                    <input
                      type="text"
                      v-model="compra.valor_nota"
                      class="form-control mb-2 mr-sm-2"
                      placeholder="Valor Nota"
                    >
                  </div>
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-md-6">
                  <div :class="['col-auto', {'has-error': errors.fornecedor_id}]">
                    <div v-if="errors.fornecedor_id">{{ errors.fornecedor_id[0] }}</div>
                    <select class="form-control mb-2 mr-sm-2" v-model="compra.fornecedor_id">
                      <option value>Fornecedor</option>
                      <option
                        v-for="fornecedor in fornecedors"
                        :key="fornecedor.id"
                        :value="fornecedor.id"
                      >{{ fornecedor.razao_social }}</option>
                    </select>
                  </div>
                </div>
                <div class="form-group col-md-6">
                  <div :class="['col-auto', {'has-error': errors.filial_id}]">
                    <div v-if="errors.filial_id">{{ errors.filial_id[0] }}</div>
                    <select class="form-control mb-2 mr-sm-2" v-model="compra.filial_id">
                      <option value>Filial</option>
                      <option
                        v-for="filial in filials"
                        :key="filial.id"
                        :value="filial.id"
                      >{{ filial.razao_social }}</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-md-6">
                  <div :class="['col-auto', {'has-error': errors.tipo_mov_id}]">
                    <div v-if="errors.tipo_mov_id">{{ errors.tipo_mov_id[0] }}</div>
                    <select class="form-control mb-2 mr-sm-2" v-model="compra.tipo_mov_id">
                      <option value>Tipo Movimento</option>
                      <option
                        v-for="tipo_movimento in tipo_movimentacao"
                        :key="tipo_movimento.id"
                        :value="tipo_movimento.id"
                      >{{ tipo_movimento.tipo_movimentacao }}</option>
                    </select>
                  </div>
                </div>
                <div class="form-group col-md-6">
                  <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Confirmar</button>
                  </div>
                </div>
              </div>
            </div>
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

    compra: {
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
      errors: {}
    };
  },

  computed: {
    filials() {
      return this.$store.state.branches.itens;
    },
    fornecedors() {
      return this.$store.state.fornecedors.itens;
    },
    tipo_movimentacao() {
      return this.$store.state.tipo_movimentos.itens;
    }
  },

  watch: {
    errorsParent() {
      this.errors = this.filho_errors;
    }
  },

  methods: {
    onSubmit() {
      let createOrUpdate = this.update ? "comprasUpdate" : "comprasStore";

      this.$store
        .dispatch(createOrUpdate, this.compra)
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
