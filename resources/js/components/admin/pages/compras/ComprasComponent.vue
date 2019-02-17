<template>
  <div>
    <h1>Registros de Entrada - Transferencia - Saida</h1>
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
            <th>Origem</th>
            <th>Destino</th>
            <th>Tipo Movimento</th>
            <th>Valor da Nota</th>
            <th>Data de Entrada</th>
            <th>Data de Alteração</th>
            <th width="250px">Ações</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="compra in compras" :key="compra.num_doc">
            <td v-text="compra.num_doc"></td>
            <td v-text="compra.fornecedor_id"></td>
            <td v-text="compra.filial_id"></td>
            <td v-text="compra.tipo_mov_id"></td>
            <td v-text="compra.valor_nota"></td>
            <td>{{ $moment(compra.created_at).format('DD/MM/YYYY HH:mm', 'L') }}</td>
            <td>{{ $moment(compra.updated_at).format('DD/MM/YYYY HH:mm', 'L') }}</td>
            <td>
              <a href="#" class="btn btn-primary btn-sm" @click.prevent="detalhes(compra.num_doc)">Detalhes</a>
              <a href="#" class="btn btn-info btn-sm" @click.prevent="editar(compra.num_doc)">Editar</a>
              <confirmDelete :resgistro="compra.num_doc" @destroy="destroy"/>
            </td>
          </tr>
        </tbody>
      </table>
      <vodal :show="detalhesVodal" animation="zoon" @hide="hideDetalhesVodal" :width="1224" :height="700">
          <detalhe :filho_compra="propriedadeCompra"></detalhe>
      </vodal>
      <vodal :show="itensCompraVodal" @hide="hideItensCompra" :width="920" :height="400">
          <itensCompra :num_docUltimoCreate="num_docUltimoCreate"
                        @success="itensCompraFinalizado"></itensCompra>
      </vodal>
    </div>
  </div>
</template>

<script>
import Vodal from "vodal";
import formCompraComponent from "./partials/FormCompraComponent";
import formItensCompra from "./partials/FormItensCompraComponent";
import confirmDelete from "../../layouts/confirmDeleteComponent";
import detalheComponent from './partials/detalheComponent';

export default {
  created() {
    this.loadIndex();
  },

  data() {
    return {
      titulo: "",
      num_docUltimoCreate: "",
      showVodal: false,
      detalhesVodal: false,
      itensCompraVodal: false,
      propriedadeupdate: false,
      propriedade_errors: {},
      propriedadeCompra: {
        num_doc: "",
        filial_id: "",
        fornecedor_id: "",
        tipo_mov_id: "",
        valor_nota: "",
        created_at: "",
        updated_at: "",
        filial: Object,
        fornecedor: Object,
        tipo_movimento: Object,
        materials: Array
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

    detalhes (num_doc) {
      this.$store
        .dispatch("comprasShow", num_doc)
        .then(response => {
          this.propriedadeCompra = response;
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
          num_doc: "",
          filial_id: "",
          fornecedor_id: "",
          tipo_mov_id: "",
          valor_nota: "",
          created_at: "",
          updated_at: "",
          filial: Object,
          fornecedor: Object,
          tipo_movimento: Object,
          materials: Array
        });
    },

    hideDetalhesVodal () {
        this.detalhesVodal = false,
        (this.propriedadeCompra = {
          num_doc: "",
          filial_id: "",
          fornecedor_id: "",
          tipo_mov_id: "",
          valor_nota: "",
          created_at: "",
          updated_at: "",
          filial: Object,
          fornecedor: Object,
          tipo_movimento: Object,
          materials: Array
        });
    },

    hideItensCompra () {
        this.itensCompraVodal = false,
        this.num_docUltimoCreate ="";
    },

    itensCompraFinalizado() {
        this.itensCompraVodal = false,
        window.location.reload(true);
    },

    cadastroRealizado(payload) {
      this.hideVodal(),
      this.loadIndex(),
      this.num_docUltimoCreate = payload.num_doc,
      this.propriedadeupdate ? "" : this.itensCompraVodal = true;
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
    formCompra: formCompraComponent,
    confirmDelete,
    detalhe: detalheComponent,
    itensCompra: formItensCompra
  }
};
</script>

<style scoped>
</style>
