<template>
  <div>
    <h1>Lista Tipo de Materiais</h1>
    <div class="row">
      <div class="col">
        <button type="submit" class="btn btn-success" @click.prevent="criar()">Novo</button>
        <vodal :show="showVodal" animation="zoon" @hide="hideVodal" :width="620" :height="500">
          <formTipo
            :title="titulo"
            :filho_errors="propriedade_errors"
            :tipo_material="propriedadeTipoMaterial"
            :update="propriedadeupdate"
            @success="cadastroRealizado"
          ></formTipo>
        </vodal>
      </div>
    </div>
    <div>
      <table class="table table-dark">
        <thead>
          <tr>
            <th>ID</th>
            <th>Tipo Material</th>
            <th width="150px">Ações</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="tipo_material in tipo_materials" :key="tipo_material.id">
            <td v-text="tipo_material.id"></td>
            <td v-text="tipo_material.tipo_material"></td>
            <td>
              <a
                href="#"
                class="btn btn-info btn-sm"
                @click.prevent="editar(tipo_material.id)"
              >Editar</a>
              <confirmDelete :resgistro="tipo_material.id" @destroy="destroy"/>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import Vodal from "vodal";
import FormTipoMaterialComponent from "./partials/FormTipoMaterialComponent";
import confirmDelete from "../../layouts/confirmDeleteComponent";

export default {
  created() {
    this.loadTipoMaterials();
  },

  data() {
    return {
      showVodal: false,
      propriedade_errors: {},
      propriedadeupdate: false,
      propriedadeTipoMaterial: {
        id: "",
        tipo_material: ""
      },
      titulo: ""
    };
  },

  computed: {
    tipo_materials() {
      return this.$store.state.tipo_materials.itens;
    }
  },

  methods: {
    loadTipoMaterials() {
      this.$store.dispatch("actionLoadTipoMaterials");
    },

    criar() {
      this.titulo = "Cadastrar Tipo de Material";
      this.showVodal = true;
      this.propriedadeupdate = false;
    },

    // pegar um registro e preencher o formulario!
    editar(id) {
      this.titulo = "Alterar Tipo de Material";
      this.$store
        .dispatch("actionLoadTipoMaterial", id)
        .then(response => {
          this.propriedadeTipoMaterial = response;
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
        (this.propriedadeTipoMaterial = {
          id: "",
          tipo_material: ""
        });
    },

    cadastroRealizado() {
      this.hideVodal(), this.loadTipoMaterials();
    },

    //method que aciona uma action de filials.js
    destroy(id) {
      this.$store
        .dispatch("destroyTipoMaterial", id)
        .then(() => {
          this.$snotify.success("Registro Deletado!", "Sucesso");
          this.loadTipoMaterials();
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
    formTipo: FormTipoMaterialComponent,
    confirmDelete
  }
};
</script>

<style scoped>
</style>
