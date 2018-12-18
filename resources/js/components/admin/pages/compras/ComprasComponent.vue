<template>
  <div>
    <h1>Registros de Entrada</h1>
    <div class="row">
      <div class="col">
        <button type="submit" class="btn btn-success" @click.prevent="criar()">Novo</button>
        <vodal :show="showVodal" animation="zoon" @hide="hideVodal" :width="620" :height="500">
          <formCompra
            :title="titulo"
            :compra="propriedadeCompra"
            :filho_errors="propriedade_errors"
            :update="propriedadeupdate"
            @success="cadastroRealizado"
          ></formCompra>
        </vodal>
      </div>
    </div>
    <div>
      <table class="table table-dark">
        <thead>
          <tr>
            <th>Num_doc</th>
            <th>Filial</th>
            <th>Fornecedor</th>
            <th>Tipo Movimento</th>
            <th>Valor da Nota</th>
            <th>Data de Entrada</th>
            <th>Data de Alteração</th>
            <th width="150px">Ações</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="compra in compras" :key="compra.num_doc">
            <td v-text="compra.num_doc"></td>
            <td v-text="compra.filial_id"></td>
            <td v-text="compra.fornecedor_id"></td>
            <td v-text="compra.tipo_mov_id"></td>
            <td v-text="compra.valor_nota"></td>
            <td>{{ $moment(compra.created_at).format('DD/MM/YYYY HH:mm', 'L') }}</td>
            <td>{{ $moment(compra.updated_at).format('DD/MM/YYYY HH:mm', 'L') }}</td>
            <td>
              <a href="#" class="btn btn-info btn-sm" @click.prevent="editar(compra.num_doc)">Editar</a>
              <confirmDelete :resgistro="compra.num_doc" @destroy="destroy"/>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import Vodal from "vodal";
import formCompraComponent from "./partials/FormCompraComponent";
import confirmDelete from "../../layouts/confirmDeleteComponent";

export default {
  created() {
    this.loadIndex();
  },

  data() {
    return {
      titulo: "",
      showVodal: false,
      propriedadeupdate: false,
      propriedade_errors: {},
      propriedadeCompra: {
            num_doc: '',
            filial_id: '',
            fornecedor_id: '',
            tipo_mov_id: '',
            valor_nota: '',
            created_at: '',
            updated_at: ''
      }
    };
  },

  computed: {
    compras() {
      return this.$store.state.compras.itens.data;
    }
  },

  methods: {
    loadIndex() {
      this.$store.dispatch("comprasIndex");
    },

    criar() {
      this.titulo = "Entrada de NFe";
      this.showVodal = true;
      this.propriedadeupdate = false;
    },

    // pegar um registro e preencher o formulario!
    editar(num_doc) {
      this.titulo = "Alterar Registro";
      this.$store
        .dispatch("comprasShow", num_doc)
        .then(response => {
          this.propriedadeCompra = response;
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
        (this.propriedadeCompra = {
            num_doc: '',
            filial_id: '',
            fornecedor_id: '',
            tipo_mov_id: '',
            valor_nota: '',
            created_at: '',
            updated_at: ''
        });
    },

    cadastroRealizado() {
      this.hideVodal(), this.loadIndex();
    },

    //method que aciona uma fornecedor de filials.js
    destroy(num_doc) {
      this.$store
        .dispatch("comprasDestroy", num_doc)
        .then(() => {
          this.$snotify.success("Registro Deletado!", "Sucesso");
          this.loadIndex();
        })
        .catch(errors => {
          this.$snotify.errors("Registro não pode ser Deletado!", "Fracasso");
        });
    }
  },

  components: {
    vodal: Vodal,
    formCompra: formCompraComponent,
    confirmDelete
  }
};
</script>

<style scoped>
</style>
