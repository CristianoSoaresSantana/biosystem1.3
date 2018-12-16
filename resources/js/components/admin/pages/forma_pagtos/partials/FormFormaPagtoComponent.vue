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
                  <div :class="['col-auto', {'has-error': errors.forma_pagto}]">
                    <div v-if="errors.forma_pagto">{{ errors.forma_pagto[0] }}</div>
                    <input
                      type="text"
                      v-model="forma_pagtos.forma_pagto"
                      class="form-control mb-2 mr-sm-2"
                      placeholder="Forma de Pagamento"
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

    forma_pagtos: {
      require: false,
      type: Object
    },

    title: {
      require: true,
      type: String
    },

    errors: {}
  },

  methods: {
    onSubmit() {
      let createOrUpdate = this.update ? "forma_pagtosUpdate" : "forma_pagtosStore";

      this.$store
        .dispatch(createOrUpdate, this.forma_pagtos)
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
