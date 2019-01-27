<template>
  <div>
    <h1>Lista de Fornecedores</h1>
    <div class="row">
      <div class="col">
        <button type="submit" class="btn btn-success" @click.prevent="criar()">Novo</button>
        <vodal :show="showVodal" animation="zoon" @hide="hideVodal" :width="620" :height="500">
          <formFornecedor
            :title="titulo"
            :fornecedor="propriedadeFornecedor"
            :errors="propriedade_errors"
            :update="propriedadeupdate"
            @success="cadastroRealizado"
          ></formFornecedor>
        </vodal>
      </div>
    </div>
    <div>
      <table class="table table-dark">
        <thead>
          <tr>
            <th>ID</th>
            <th>Razão Social</th>
            <th>CNPJ</th>
            <th width="250px">Ações</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="fornecedor in fornecedors" :key="fornecedor.id">
            <td v-text="fornecedor.id"></td>
            <td v-text="fornecedor.razao_social"></td>
            <td v-text="fornecedor.cnpj"></td>
            <td>
                <a href="#" class="btn btn-primary btn-sm" @click.prevent="detalhes(fornecedor.id)">Detalhes</a>
              <a href="#" class="btn btn-info btn-sm" @click.prevent="editar(fornecedor.id)">Editar</a>
              <confirmDelete :resgistro="fornecedor.id" @destroy="destroy"/>
            </td>
          </tr>
        </tbody>
      </table>
      <vodal :show="detalhesVodal" animation="zoon" @hide="hideDetalhesVodal" :width="920" :height="400">
          <detalhe :filho_fornecedor="propriedadeFornecedor"></detalhe>
      </vodal>
    </div>
  </div>
</template>

<script>
import Vodal from "vodal";
import FormFornecedorComponent from "./partials/FormFornecedorComponent";
import confirmDelete from "../../layouts/confirmDeleteComponent";
import detalheComponent from './partials/detalheComponent';

export default {
  created() {
    if(this.fornecedors.length == 0){
        this.loadIndex();
    }
  },

  data() {
    return {
      titulo: "",
      showVodal: false,
      detalhesVodal: false,
      propriedadeupdate: false,
      propriedade_errors: {},
      propriedadeFornecedor: {
        id: "",
        razao_social: "",
        cnpj: "",
        materials: Object
      }
    };
  },

  computed: {
    fornecedors() {
      return this.$store.state.fornecedors.itens;
    }
  },

  methods: {
    loadIndex() {
      this.$store.dispatch("fornecedorLoadIndex");
    },

    criar() {
      this.titulo = "Cadastrar Fornecedor";
      this.showVodal = true;
      this.propriedadeupdate = false;
    },

    detalhes (id) {
      this.$store
        .dispatch("fornecedorLoadShow", id)
        .then(response => {
          this.propriedadeFornecedor = response;
          this.detalhesVodal = true;
        })
        .catch(errors => {
          this.$snotify.errors(
            "Registro não pode ser carregado!",
            "Informativo"
          );
        });
    },

    // pegar um registro e preencher o formulario!
    editar(id) {
      this.titulo = "Alterar Fornecedor";
      this.$store
        .dispatch("fornecedorLoadShow", id)
        .then(response => {
          this.propriedadeFornecedor = response;
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
        (this.propriedadeFornecedor = {
          id: "",
          razao_social: "",
          cnpj: "",
          materials: Object
        });
    },

    hideDetalhesVodal () {
        this.detalhesVodal = false,
        (this.propriedadeFornecedor = {
           id: "",
           razao_social: "",
           cnpj: "",
           materials: Object
        });
    },

    cadastroRealizado() {
      this.hideVodal(), this.loadIndex();
    },

    //method que aciona uma fornecedor de filials.js
    destroy(id) {
      this.$store
        .dispatch("fornecedorDestroy", id)
        .then(() => {
          this.$snotify.success("Registro Deletado!", "Sucesso");
          this.loadIndex();
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
    formFornecedor: FormFornecedorComponent,
    confirmDelete,
    detalhe: detalheComponent
  }
};
</script>

<style scoped>
</style>
