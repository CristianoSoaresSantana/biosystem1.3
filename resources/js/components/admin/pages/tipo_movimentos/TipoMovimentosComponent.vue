<template>
  <div>
    <h1>Lista de Tipos de Movimentos</h1>
    <div class="row">
      <div class="col">
        <button type="submit" class="btn btn-success" @click.prevent="criar()">Novo</button>
        <vodal :show="showVodal" animation="zoon" @hide="hideVodal" :width="620" :height="500">
          <formTipoMovimento
            :title="titulo"
            :tipo_movimentos="propriedadeTipoMovimentos"
            :filho_errors="propriedade_errors"
            :update="propriedadeupdate"
            @success="cadastroRealizado"
          ></formTipoMovimento>
        </vodal>
      </div>
    </div>
    <div>
      <table class="table table-dark">
        <thead>
          <tr>
            <th>ID</th>
            <th>Tipo de Movimento</th>
            <th width="250px">Ações</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="tipo_movimento in tipo_movimentos" :key="tipo_movimento.id">
            <td v-text="tipo_movimento.id"></td>
            <td v-text="tipo_movimento.tipo_movimentacao"></td>
            <td>
              <a
                href="#"
                class="btn btn-info btn-sm"
                @click.prevent="editar(tipo_movimento.id)"
              >Editar</a>
              <confirmDelete :resgistro="tipo_movimento.id" @destroy="destroy"/>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import Vodal from "vodal";
import formTipoMovimentoComponent from "./partials/FormTipoMovimentoComponent";
import confirmDelete from "../../layouts/confirmDeleteComponent";

export default {
  created() {
    if(this.tipo_movimentos.length == 0){
        this.tipo_movimentosIndex();
    }
  },

  data() {
    return {
      titulo: "",
      showVodal: false,
      propriedadeupdate: false,
      propriedade_errors: {},
      propriedadeTipoMovimentos: {
        id: "",
        tipo_movimentacao: ""
      }
    };
  },

  computed: {
    tipo_movimentos() {
      return this.$store.state.tipo_movimentos.itens;
    }
  },

  methods: {
    tipo_movimentosIndex() {
      this.$store.dispatch("tipo_movimentosIndex");
    },

    criar() {
      this.titulo = "Cadastrar Tipo de Movimento";
      this.showVodal = true;
      this.propriedadeupdate = false;
    },

    // pegar um registro e preencher o formulario!
    editar(id) {
      this.titulo = "Alterar Tipo de Movimento";
      this.$store
        .dispatch("tipo_movimentosShow", id)
        .then(response => {
          this.propriedadeTipoMovimentos = response;
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
        (this.propriedadeTipoMovimentos = {
          id: "",
          tipo_movimentacao: ""
        });
    },

    cadastroRealizado() {
      this.hideVodal(), this.tipo_movimentosIndex();
    },

    //method que aciona uma fornecedor de filials.js
    destroy(id) {
      this.$store
        .dispatch("tipo_movimentosDestroy", id)
        .then(() => {
          this.$snotify.success("Registro Deletado!", "Sucesso");
          this.tipo_movimentosIndex();
        })
        .catch(errors => {
          this.propriedade_errors = errors.response.data.error;
          this.$snotify.html(
            `<h4 class="snotifyToast__title"> <b>Fracasso!</b> </h4>
                         <div class="snotifyToast__body">
                            <b>Registro não pode ser apagado!<br></b>
                            <b>${this.propriedade_errors}</b>
                         </div>
                         <style scoped>
                            .snotifyToast {
                                background-color: #f99e94;
                                margin: 11px -100px;
                                opacity: 0;
                                width: 400px;
                            }
                            .snotifyToast__inner {
                                color: #e3342f;
                                max-width: 500;
                            }
                            </style>`,
            {
              timeout: 5000,
              showProgressBar: true,
              closeOnClick: true,
              pauseOnHover: true,
              position: "centerTop"
            }
          );
        });
    }
  },

  components: {
    vodal: Vodal,
    formTipoMovimento: formTipoMovimentoComponent,
    confirmDelete
  }
};
</script>

<style scoped>
</style>
