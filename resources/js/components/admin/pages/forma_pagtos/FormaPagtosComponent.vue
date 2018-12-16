<template>
  <div>
    <h1>Lista de Formas de Pagamento</h1>
    <div class="row">
      <div class="col">
        <button type="submit" class="btn btn-success" @click.prevent="criar()">Novo</button>
        <vodal :show="showVodal" animation="zoon" @hide="hideVodal" :width="620" :height="500">
          <formFormaPagto
            :title="titulo"
            :forma_pagtos="propriedadeFormaPagto"
            :errors="propriedade_errors"
            :update="propriedadeupdate"
            @success="cadastroRealizado"
          ></formFormaPagto>
        </vodal>
      </div>
    </div>
    <div>
      <table class="table table-dark">
        <thead>
          <tr>
            <th>ID</th>
            <th>Forma de Pagamento</th>
            <th width="150px">Ações</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="forma_pagto in forma_pagtos" :key="forma_pagto.id">
            <td v-text="forma_pagto.id"></td>
            <td v-text="forma_pagto.forma_pagto"></td>
            <td>
              <a href="#" class="btn btn-info btn-sm" @click.prevent="editar(forma_pagto.id)">Editar</a>
              <confirmDelete :resgistro="forma_pagto.id" @destroy="destroy"/>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import Vodal from "vodal";
import formFormaPagtoComponent from "./partials/FormFormaPagtoComponent";
import confirmDelete from "../../layouts/confirmDeleteComponent";

export default {
  created() {
    this.forma_pagtosIndex();
  },

  data() {
    return {
      titulo: "",
      showVodal: false,
      propriedadeupdate: false,
      propriedade_errors: {},
      propriedadeFormaPagto: {
        id: "",
        forma_pagto: ""
      }
    };
  },

  computed: {
    forma_pagtos() {
      return this.$store.state.forma_pagtos.itens;
    }
  },

  methods: {
    forma_pagtosIndex() {
      this.$store.dispatch("forma_pagtosIndex");
    },

    criar() {
      this.titulo = "Cadastrar Forma de Pagamento";
      this.showVodal = true;
      this.propriedadeupdate = false;
    },

    // pegar um registro e preencher o formulario!
    editar(id) {
      this.titulo = "Alterar Forma de Pagamento";
      this.$store
        .dispatch("forma_pagtosShow", id)
        .then(response => {
          this.propriedadeFormaPagto = response;
          this.showVodal = true;
          this.propriedadeupdate = true;
        })
        .catch(errors => {
          this.$snotify.errors(
            "Registro não pode ser carregado!",
            "Informativo"
          );
        });
    },

    hideVodal() {
      (this.showVodal = false),
        (this.propriedade_errors = {}),
        (this.propriedadeFormaPagto = {
          id: "",
          forma_pagto: ""
        });
    },

    cadastroRealizado() {
      this.hideVodal(), this.forma_pagtosIndex();
    },

    //method que aciona uma fornecedor de filials.js
    destroy(id) {
      this.$store
        .dispatch("forma_pagtosDestroy", id)
        .then(() => {
          this.$snotify.success("Registro Deletado!", "Sucesso");
          this.forma_pagtosIndex();
        })
        .catch(errors => {
          this.$snotify.errors("Registro não pode ser Deletado!", "Fracasso");
        });
    }
  },

  components: {
    vodal: Vodal,
    formFormaPagto: formFormaPagtoComponent,
    confirmDelete
  }
};
</script>

<style scoped>
</style>
