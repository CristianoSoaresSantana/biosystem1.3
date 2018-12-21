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
                  <div :class="['col-auto', {'has-error': errors.user_id}]">
                    <div v-if="errors.user_id">{{ errors.user_id[0] }}</div>
                    <select class="form-control mb-2 mr-sm-2" v-model="venda.user_id">
                      <option value>Usuario</option>
                      <option
                        v-for="user in users"
                        :key="user.id"
                        :value="user.id"
                      >{{ user.name }}</option>
                    </select>
                  </div>
                </div>
                <div class="form-group col-md-6">
                  <div :class="['col-auto', {'has-error': errors.filial_id}]">
                    <div v-if="errors.filial_id">{{ errors.filial_id[0] }}</div>
                    <select class="form-control mb-2 mr-sm-2" v-model="venda.filial_id">
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
                    <select class="form-control mb-2 mr-sm-2" v-model="venda.tipo_mov_id">
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
                  <div :class="['col-auto', {'has-error': errors.status}]">
                    <div v-if="errors.status">{{ errors.status[0] }}</div>
                    <input
                      type="text"
                      v-model="venda.status"
                      class="form-control mb-2 mr-sm-2"
                      placeholder="Status"
                    >
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <div :class="['col-auto', {'has-error': errors.cliente_id}]">
                    <div v-if="errors.cliente_id">{{ errors.cliente_id[0] }}</div>
                    <input
                      type="text"
                      v-model="venda.cliente_id"
                      class="form-control mb-2 mr-sm-2"
                      placeholder="Numero Cliente"
                    >
                  </div>
                </div>
                <div class="form-group col-md-6">
                  <div :class="['col-auto', {'has-error': errors.valor_total}]">
                    <div v-if="errors.valor_total">{{ errors.valor_total[0] }}</div>
                    <input
                      type="text"
                      v-model="venda.valor_total"
                      class="form-control mb-2 mr-sm-2"
                      placeholder="Valor Total"
                    >
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
      errors: {}
    };
  },

  computed: {
    filials() {
      return this.$store.state.branches.itens;
    },
    users() {
      return this.$store.state.usuarios.itens.data;
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
