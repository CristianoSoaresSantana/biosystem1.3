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
                  <div :class="['col-auto', {'has-error': errors.tipo_movimentacao}]">
                    <div v-if="errors.tipo_movimentacao">{{ errors.tipo_movimentacao[0] }}</div>
                    <input
                      type="text"
                      v-model="tipo_movimentos.tipo_movimentacao"
                      class="form-control mb-2 mr-sm-2"
                      placeholder="Tipo de Movimento"
                    >
                  </div>
                </div>
              </div>
              <div class="form-row">
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

    tipo_movimentos: {
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
      }
  },

  watch: {
      filho_errors() {
          this.errors = this.filho_errors;
      }
  },

  methods: {
    onSubmit() {
      let createOrUpdate = this.update
        ? "tipo_movimentosUpdate"
        : "tipo_movimentosStore";

      this.$store
        .dispatch(createOrUpdate, this.tipo_movimentos)
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
