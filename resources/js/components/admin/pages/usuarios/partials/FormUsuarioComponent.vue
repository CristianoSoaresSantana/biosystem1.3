<template>
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="form_main">
          <h4 class="heading">
            <strong>{{title}}</strong>
            <span></span>
          </h4>
          <form class="form" @submit.prevent="onSubmit">
            <div class="form-group col-md-12">
              <div class="form-row">
                <div class="form-group col-md-12">
                  <div :class="['col-auto', {'has-error': errors.name}]">
                    <div v-if="errors.name">{{ errors.name[0] }}</div>
                    <input
                      type="text"
                      v-model="usuario.name"
                      class="form-control mb-2 mr-sm-2"
                      placeholder="Nome"
                    >
                  </div>
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-md-7">
                  <div :class="['col-auto', {'has-error': errors.cpf}]">
                    <div v-if="errors.cpf">{{ errors.cpf[0] }}</div>
                    <input
                      type="text"
                      v-model="usuario.cpf"
                      class="form-control mb-2 mr-sm-2"
                      placeholder="CPF"
                    >
                  </div>
                </div>

                <div class="form-group col-md-5">
                  <div :class="['col-auto', {'has-error': errors.data_nascimento}]">
                    <div v-if="errors.data_nascimento">{{ errors.data_nascimento[0] }}</div>
                    <input
                      type="text"
                      v-model="usuario.data_nascimento"
                      class="form-control mb-2 mr-sm-2"
                      placeholder="Data Nascimento"
                    >
                  </div>
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-md-7">
                  <div :class="['col-auto', {'has-error': errors.email}]">
                    <div v-if="errors.email">{{ errors.email[0] }}</div>
                    <input
                      type="text"
                      v-model="usuario.email"
                      class="form-control mb-2 mr-sm-2"
                      placeholder="E-mail"
                    >
                  </div>
                </div>
                <div class="form-group col-md-5">
                  <div :class="['col-auto', {'has-error': errors.permissao}]">
                    <div v-if="errors.permissao">{{ errors.permissao[0] }}</div>
                    <input
                      type="text"
                      v-model="usuario.permissao"
                      class="form-control mb-2 mr-sm-2"
                      placeholder="Permissão de acesso"
                    >
                  </div>
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-md-6">
                  <div :class="['col-auto', {'has-error': errors.celular}]">
                    <div v-if="errors.celular">{{ errors.celular[0] }}</div>
                    <input
                      type="text"
                      v-model="usuario.celular"
                      class="form-control mb-2 mr-sm-2"
                      placeholder="Celular"
                    >
                  </div>
                </div>

                <div class="form-group col-md-6">
                  <div :class="['col-auto', {'has-error': errors.celular_recado}]">
                    <div v-if="errors.celular_recado">{{ errors.celular_recado[0] }}</div>
                    <input
                      type="text"
                      v-model="usuario.celular_recado"
                      class="form-control mb-2 mr-sm-2"
                      placeholder="Recado"
                    >
                  </div>
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-md-6">
                  <div :class="['col-auto', {'has-error': errors.filial_id}]">
                    <div v-if="errors.filial_id">{{ errors.filial_id[0] }}</div>
                    <select class="form-control mb-2 mr-sm-2" v-model="usuario.filial_id">
                      <option value>Filial</option>
                      <option
                        v-for="filial in filials"
                        :key="filial.id"
                        :value="filial.id"
                      >{{ filial.razao_social }}</option>
                    </select>
                  </div>
                </div>
                <div class="form-group col-md-6">
                  <div :class="['col-auto', {'has-error': errors.setor_id}]">
                    <div v-if="errors.setor_id">{{ errors.setor_id[0] }}</div>
                    <select class="form-control mb-2 mr-sm-2" v-model="usuario.setor_id">
                      <option value>Setor</option>
                      <option
                        v-for="setor in setors"
                        :key="setor.id"
                        :value="setor.id"
                      >{{ setor.setor }}</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-md-12">
                  <div :class="['col-auto', {'has-error': errors.endereco}]">
                    <div v-if="errors.endereco">{{ errors.endereco[0] }}</div>
                    <textarea
                      v-model="usuario.endereco"
                      class="form-control"
                      placeholder="Endereço"
                    ></textarea>
                  </div>
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-md-4">
                  <div :class="['col-auto', {'has-error': errors.status}]">
                    <div v-if="errors.status">{{ errors.status[0] }}</div>
                    <input
                      type="text"
                      v-model="usuario.status"
                      class="form-control mb-2 mr-sm-2"
                      placeholder="Status"
                    >
                  </div>
                </div>
                <div class="form-group col-md-4">
                  <div :class="['col-auto', {'has-error': errors.password}]">
                    <div v-if="errors.password">{{ errors.password[0] }}</div>
                    <input
                      type="text"
                      v-model="usuario.password"
                      class="form-control mb-2 mr-sm-2"
                      placeholder="Senha"
                    >
                  </div>
                </div>
                <div class="form-group col-md-4">
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

    errors: {},

    statusInput: "",

    usuario: {
      require: false,
      type: Object
    },

    title: {
      require: true,
      type: String
    }
  },

  computed: {
    filials() {
      return this.$store.state.branches.itens;
    },
    setors() {
        return this.$store.state.setors.itens;
    }
  },

  methods: {
    onSubmit() {
      let createOrUpdate = this.update ? "usuarioUpdate" : "usuarioStore";

      this.$store
        .dispatch(createOrUpdate, this.usuario)
        .then(() => {
          // notificação para usuario.
          this.$snotify.success(
            "Cadastro realizado com sucesso!",
            "Parabéns..."
          );
          this.$emit("success");
        })
        .catch(errors => {
          // notificação para usuario.
          this.$snotify.error("Você Errou!", "Atenção");
          console.log(errors.response.data.errors);
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
