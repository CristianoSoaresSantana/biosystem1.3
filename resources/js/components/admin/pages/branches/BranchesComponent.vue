<template>
  <div>
    <h1>Lista de Filias</h1>
    <div class="row">
      <div class="col">
        <button type="submit" class="btn btn-success" @click.prevent="criar()">Novo</button>
        <vodal :show="showVodal" animation="zoon" @hide="hideVodal" :width="620" :height="500">
          <formBranche
            :title="titulo"
            :filho_branche="propriedadeBranche"
            :filho_errors="propriedade_errors"
            :update="propriedadeupdate"
            @success="cadastroRealizado"
          ></formBranche>
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
            <th width="300px">Ações</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="branche in branches" :key="branche.id">
            <td v-text="branche.id"></td>
            <td v-text="branche.razao_social"></td>
            <td v-text="branche.cnpj"></td>
            <td>
              <a href="#" class="btn btn-primary btn-sm" @click.prevent="detalhes(branche.id)">Detalhes</a>
              <a href="#" class="btn btn-info btn-sm" @click.prevent="editar(branche.id)">Editar</a>
              <confirmDelete :resgistro="branche.id" @destroy="destroy"/>
            </td>
          </tr>
        </tbody>
      </table>
      <vodal :show="detalhesVodal" animation="zoon" @hide="hideDetalhesVodal" :width="920" :height="800">
          <detalhe
          :filho_branche="propriedadeBranche"
          >

          </detalhe>
      </vodal>
    </div>
  </div>
</template>

<script>
import Vodal from "vodal";
import FormBrancheComponent from "./partials/FormBrancheComponent";
import confirmDelete from "../../layouts/confirmDeleteComponent";
import detalheComponent from './partials/detalheComponent'

export default {
  created() {
    if(this.branches.length == 0){
        this.loadbranches();
    }
  },

  data() {
    return {
      titulo: "",
      showVodal: false,
      detalhesVodal: false,
      propriedadeupdate: false,
      propriedade_errors: {},
      propriedadeBranche: {
        id: "",
        razao_social: "",
        cnpj: "",
        users: Object,
        vendas: Object,
        compras: Object
      }
    };
  },

  computed: {
    branches() {
      return this.$store.state.branches.itens;
    }
  },

  methods: {
    loadbranches() {
      this.$store.dispatch("actionLoadBranches");
    },

    criar() {
      this.titulo = "Cadastrar Filial";
      this.showVodal = true;
      this.propriedadeupdate = false;
    },

    // pegar um registro e preencher o formulario!
    editar(id) {
      this.titulo = "Alterar Filial";
      this.$store
        .dispatch("actionLoadBranche", id)
        .then(response => {
          this.propriedadeBranche = response;
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

    detalhes (id) {
      this.$store
        .dispatch("actionLoadBranche", id)
        .then(response => {
          this.propriedadeBranche = response;
          this.detalhesVodal = true;
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
        (this.propriedadeBranche = {
          id: "",
          razao_social: "",
          cnpj: ""
        });
    },

    hideDetalhesVodal () {
        this.detalhesVodal = false,
        (this.propriedadeBranche = {
          id: "",
          razao_social: "",
          cnpj: ""
        });
    },

    cadastroRealizado() {
      this.hideVodal(), this.loadbranches();
    },

    //method que aciona uma action de filials.js
    destroy(id) {
      this.$store
        .dispatch("destroyBranche", id)
        .then(() => {
          this.$snotify.success("Registro Deletado!", "Sucesso");
          this.loadbranches();
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
    formBranche: FormBrancheComponent,
    confirmDelete,
    detalhe: detalheComponent
  }
};
</script>

<style scoped>
</style>
