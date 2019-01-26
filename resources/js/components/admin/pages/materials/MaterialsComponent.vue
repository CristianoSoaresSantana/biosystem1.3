<template>
  <div>
    <h1>Lista de Materiais</h1>
    <div class="row">
      <div class="col">
        <button type="submit" class="btn btn-success" @click.prevent="criar">Novo</button>
        <vodal :show="showVodal" animation="zoon" @hide="hideVodal" :width="620" :height="500">
          <formMaterial
            :title="titulo"
            :material="propriedadeMaterial"
            :filho_errors="propriedade_errors"
            :statusInput="propriedade_statusInput"
            :update="propriedadeupdate"
            @success="cadastroRealizado"
          ></formMaterial>
        </vodal>
      </div>
      <div class="col">
        <buscar @layoutBuscar="pageMaterialsBuscar"></buscar>
      </div>
    </div>
    <div>
      <table class="table table-dark">
        <thead>
          <tr>
            <th>Imagem</th>
            <th>SKU</th>
            <th>Cod. Barra</th>
            <th>Descrição</th>
            <th>Forma</th>
            <th>Tipo</th>
            <th>Fornecedor</th>
            <th>Status</th>
            <th>Valor Compra</th>
            <th>Valor Revenda</th>
            <th width="250px">Ações</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="material in materials.data" :key="material.sku">
            <td v-text="material.image"></td>
            <td v-text="material.sku"></td>
            <td v-text="material.cod_barra"></td>
            <td v-text="material.descricao"></td>
            <td v-text="material.forma_farmaceutica_id"></td>
            <td v-text="material.tipo_material_id"></td>
            <td v-text="material.fornecedor_id"></td>
            <td v-text="material.status"></td>
            <td v-text="material.valor_compra"></td>
            <td v-text="material.valor_revenda"></td>
            <td>
              <a href="#" class="btn btn-primary btn-sm" @click.prevent="detalhes(material.sku)">Detalhes</a>
              <a href="#" class="btn btn-info btn-sm" @click.prevent="editar(material.sku)">Editar</a>
              <confirmDelete :resgistro="material.sku" @destroy="destroy"/>
            </td>
          </tr>
        </tbody>
      </table>
      <vodal :show="detalhesVodal" animation="zoon" @hide="hideDetalhesVodal" :width="600" :height="350">
          <detalhe :filho_materials="propriedadeMaterial"></detalhe>
      </vodal>
      <!-- paginação -->
      <pagination :pagination="materials" :offset="6" @paginate="loadMaterials"></pagination>
    </div>
  </div>
</template>

<script>
import Vodal from "vodal";

import PaginationComponent from "../../../layouts/PaginationComponent.vue";
import BuscarComponent from "../../layouts/geralBuscarComponent";
import FormMaterialComponent from "./partials/FormMaterialComponent";
import confirmDelete from "../../layouts/confirmDeleteComponent";
import detalheComponent from './partials/detalheComponent';

export default {
  created() {
    if(this.materials.data.length == 0){
        this.loadMaterials(1);
    }
  },

  data() {
    return {
      input: "",
      titulo: "",
      showVodal: false,
      detalhesVodal: false,
      propriedade_errors: {},
      propriedadeupdate: false,
      propriedade_statusInput: false,
      propriedadeMaterial: {
        sku: "",
        cod_barra: "",
        descricao: "",
        forma_farmaceutica_id: "",
        tipo_material_id: "",
        fornecedor_id: "",
        status: "",
        valor_compra: "",
        valor_revenda: "",
        tipo_material: Object,
        forma_farmaceutica: Object,
        fornecedor: Object
        // image: '',

      }
    };
  },

  computed: {
    materials() {
      return this.$store.state.materials.itens;
    },

    params() {
      return {
        page: this.materials.current_page,
        filter: this.input
      };
    }
  },

  methods: {
    loadMaterials(page) {
      this.$store.dispatch("actionLoadMaterials", { ...this.params, page });
    },

    detalhes (sku) {
      this.$store
        .dispatch("actionLoadMaterial", sku)
        .then(response => {
          this.propriedadeMaterial = response;
          this.detalhesVodal = true;
        })
        .catch(errors => {
          this.$snotify.errors(
            "Registro não pode ser carregado!",
            "Informativo"
          );
        });
    },

    criar() {
      (this.titulo = "Cadastrar Material"),
        (this.showVodal = true),
        (this.propriedadeupdate = false),
        (this.propriedade_statusInput = false),
      (this.propriedadeMaterial = {
        sku: "",
        cod_barra: "",
        descricao: "",
        forma_farmaceutica_id: "",
        tipo_material_id: "",
        fornecedor_id: "",
        status: "ativo",
        valor_compra: "",
        valor_revenda: "",
        tipo_material: Object,
        forma_farmaceutica: Object,
        fornecedor: Object
        // image: '',
      });
    },

    // pegar um registro e preencher o formulario!
    editar(sku) {
      (this.titulo = "Alterar Material"),
        (this.propriedade_statusInput = true),
        this.$store
          .dispatch("actionLoadMaterial", sku)
          .then(response => {
            this.propriedadeMaterial = response;
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

    // nome desta var representa o path do component! ex page.materialsComponent
    pageMaterialsBuscar(inputBuscar) {
      (this.input = inputBuscar), this.loadMaterials(1);
    },

    hideVodal() {
      (this.showVodal = false),
        (this.propriedade_errors = {}),
        (this.propriedadeMaterial = {
        sku: "",
        cod_barra: "",
        descricao: "",
        forma_farmaceutica_id: "",
        tipo_material_id: "",
        fornecedor_id: "",
        status: "",
        valor_compra: "",
        valor_revenda: "",
        tipo_material: Object,
        forma_farmaceutica: Object,
        fornecedor: Object
        // image: '',
      });
    },

    hideDetalhesVodal () {
        this.detalhesVodal = false,
        (this.propriedadeMaterial = {
            sku: "",
            cod_barra: "",
            descricao: "",
            forma_farmaceutica_id: "",
            tipo_material_id: "",
            fornecedor_id: "",
            status: "",
            valor_compra: "",
            valor_revenda: "",
            tipo_material: Object,
            forma_farmaceutica: Object,
            fornecedor: Object
            // image: '',
      });
    },

    cadastroRealizado() {
      this.hideVodal(), this.loadMaterials(1);
    },

    //method que aciona uma action de filials.js
    destroy(sku) {
      this.$store
        .dispatch("destroyMaterial", sku)
        .then(() => {
          this.$snotify.success("Registro Deletado!", "Sucesso");
          this.loadMaterials();
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
    pagination: PaginationComponent,
    buscar: BuscarComponent,
    vodal: Vodal,
    formMaterial: FormMaterialComponent,
    confirmDelete,
    detalhe: detalheComponent
  }
};
</script>


<style scoped>
</style>
