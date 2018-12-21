<template>
  <div>
    <h1>Lista de Setores</h1>
    <div class="row">
      <div class="col">
        <button type="submit" class="btn btn-success" @click.prevent="criar()">Novo</button>
        <vodal :show="showVodal" animation="zoon" @hide="hideVodal" :width="620" :height="500">
          <formSetor
            :title="titulo"
            :setor="propriedadeSetor"
            :filho_errors="propriedade_errors"
            :update="propriedadeupdate"
            @success="cadastroRealizado"
          ></formSetor>
        </vodal>
      </div>
    </div>
    <div>
      <table class="table table-dark">
        <thead>
          <tr>
            <th>ID</th>
            <th>Setor</th>
            <th width="150px">Ações</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="setor in setors" :key="setor.id">
            <td v-text="setor.id"></td>
            <td v-text="setor.setor"></td>
            <td>
              <a href="#" class="btn btn-info btn-sm" @click.prevent="editar(setor.id)">Editar</a>
              <confirmDelete :resgistro="setor.id" @destroy="destroy"/>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import Vodal from "vodal";
import formSetorComponent from "./partials/FormSetorComponent";
import confirmDelete from "../../layouts/confirmDeleteComponent";

export default {
  created() {
    if(this.setors.length == 0){
        this.loadIndex();
    }
  },

  data() {
    return {
      titulo: "",
      showVodal: false,
      propriedadeupdate: false,
      propriedade_errors: {},
      propriedadeSetor: {
        id: "",
        setor: ""
      }
    };
  },

  computed: {
    setors() {
      return this.$store.state.setors.itens;
    }
  },

  methods: {
    loadIndex() {
      this.$store.dispatch("setorsLoadIndex");
    },

    criar() {
      this.titulo = "Cadastrar Setor";
      this.showVodal = true;
      this.propriedadeupdate = false;
    },

    // pegar um registro e preencher o formulario!
    editar(id) {
      this.titulo = "Alterar Setor";
      this.$store
        .dispatch("setorsLoadShow", id)
        .then(response => {
          this.propriedadeSetor = response;
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
        (this.propriedadeSetor = {
          id: "",
          setor: ""
        });
    },

    cadastroRealizado() {
      this.hideVodal(), this.loadIndex();
    },

    //method que aciona uma fornecedor de filials.js
    destroy(id) {
      this.$store
        .dispatch("setorsDestroy", id)
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
    formSetor: formSetorComponent,
    confirmDelete
  }
};
</script>

<style scoped>
</style>
