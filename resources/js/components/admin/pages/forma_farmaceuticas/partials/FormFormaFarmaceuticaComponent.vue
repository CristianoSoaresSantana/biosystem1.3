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
                  <div :class="['col-auto', {'has-error': errors.forma_farmaceutica}]">
                    <div v-if="errors.forma_farmaceutica">{{ errors.forma_farmaceutica[0] }}</div>
                    <input
                      type="text"
                      v-model="forma_farmaceutica.forma_farmaceutica"
                      class="form-control mb-2 mr-sm-2"
                      placeholder="Forma Farmacêutica"
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

    forma_farmaceutica: {
      require: false,
      type: Object
    },

    filho_errors: {},

    title: {
      require: true,
      type: String
    }
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
        ? "updateFormaFarmaceutica"
        : "storeFormaFarmaceutica";

      this.$store
        .dispatch(createOrUpdate, this.forma_farmaceutica)
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
