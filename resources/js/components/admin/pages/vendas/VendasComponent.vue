<template>
  <div>
    <h1>Registros de Vendas</h1>
    <!-- <div class="row">
      <div class="col">
        <button type="submit" class="btn btn-success" @click.prevent="criar()">Novo</button>
        <vodal :show="showVodal" animation="zoon" @hide="hideVodal" :width="1024" :height="500">
          <formVenda
            :title="titulo"
            :venda="propriedadeVenda"
            :filho_errors="propriedade_errors"
            :update="propriedadeupdate"
            @success="cadastroRealizado"
          ></formVenda>
        </vodal>
      </div>
    </div> -->
    <div>
      <table class="table table-dark">
        <thead>
          <tr>
            <th>ID</th>
            <th>Cliente</th>
            <th>Usuario</th>
            <th>Tipo movimento</th>
            <th>Filial</th>
            <th>Valor total</th>
            <th>Desconto</th>
            <th>Valor com Desconto</th>
            <th>Data da Venda</th>
            <th>status</th>
            <th width="250px">Ações</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="venda in vendas.data" :key="venda.id">
            <td v-text="venda.id"></td>
            <td v-text="venda.cliente_id"></td>
            <td v-text="venda.user_id"></td>
            <td v-text="venda.tipo_mov_id"></td>
            <td v-text="venda.filial_id"></td>
            <td> {{ parseFloat(venda.valor_total).toFixed(2)}}</td>
            <td> {{ parseFloat(venda.desconto).toFixed(2) }}</td>
            <td> {{ parseFloat(venda.total_com_desconto).toFixed(2) }}</td>
            <td> {{ $moment(venda.created_at).format('DD/MM/YYYY HH:mm', 'L') }}</td>
            <td v-text="venda.status"></td>
            <td>
              <a href="#" class="btn btn-primary btn-sm" @click.prevent="detalhes(venda.id)">Detalhes</a>
              <!-- <a href="#" class="btn btn-info btn-sm" @click.prevent="editar(venda.id)">Editar</a> -->
              <confirmDelete :resgistro="venda.id" @destroy="destroy"/>
            </td>
          </tr>
        </tbody>
      </table>
        <!-- paginação -->
        <pagination :pagination="vendas" :offset="6" @paginate="loadIndex"></pagination>
      <vodal :show="detalhesVodal" animation="zoon" @hide="hideDetalhesVodal" :width="920" :height="500">
          <detalhe :filho_venda="propriedadeVenda"></detalhe>
      </vodal>
    </div>
  </div>
</template>

<script>
import Vodal from "vodal";
import PaginationComponent from "../../../layouts/PaginationComponent";
import formVendaComponent from "./partials/FormVendaComponent";
import confirmDelete from "../../layouts/confirmDeleteComponent";
import detalheComponent from './partials/detalheComponent';

export default {
  created() {
    this.loadIndex(1);
  },

  data() {
    return {
      input: "",
      titulo: "",
      showVodal: false,
      detalhesVodal: false,
      propriedadeupdate: false,
      propriedade_errors: {},
      propriedadeVenda: {
        id          : "",
        cliente_id  : "",
        filial_id   : "",
        tipo_mov_id : "",
        user_id     : "",
        valor_total : "",
        status      : "",
        created_at  : "",
        updated_at  : "",
        filial      : Object,
        user        : Object,
        cliente     : Object,
        tipo_movimento: Object
      }
    };
  },

  computed: {
    vendas() {
      return this.$store.state.vendas.itens;
    },

    params() {
      return {
        page: this.vendas.current_page,
        filter: this.input
      };
    }
  },

  methods: {
    loadIndex(page) {
      this.$store.dispatch("vendasIndex", { ...this.params, page });
    },

    detalhes (id) {
      this.$store
        .dispatch("vendasShow", id)
        .then(response => {
          this.propriedadeVenda = response;
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
      this.titulo = "Nova Venda";
      this.showVodal = true;
      this.propriedadeupdate = false;
      this.propriedadeVenda = {
        id          : "",
        cliente_id  : "",
        filial_id   : "",
        tipo_mov_id : "",
        user_id     : "",
        valor_total : "",
        status      : "",
        created_at  : "",
        updated_at  : "",
        filial      : Object,
        user        : Object,
        cliente     : Object,
        tipo_movimento: Object
      }
    },

    // pegar um registro e preencher o formulario!
    editar(id) {
      this.titulo = "Alterar Registro";
      this.$store
        .dispatch("vendasShow", id)
        .then(response => {
          this.propriedadeVenda = response;
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
        (this.propriedadeVenda = {
            id          : "",
            cliente_id  : "",
            filial_id   : "",
            tipo_mov_id : "",
            user_id     : "",
            valor_total : "",
            status      : "",
            created_at  : "",
            updated_at  : "",
            filial      : Object,
            user        : Object,
            cliente     : Object,
            tipo_movimento: Object
        });
    },

    hideDetalhesVodal () {
        this.detalhesVodal = false,
        (this.propriedadeVenda = {
          id          : "",
            cliente_id  : "",
            filial_id   : "",
            tipo_mov_id : "",
            user_id     : "",
            valor_total : "",
            status      : "",
            created_at  : "",
            updated_at  : "",
            filial      : Object,
            user        : Object,
            cliente     : Object,
            tipo_movimento: Object
        });
    },

    cadastroRealizado() {
      this.hideVodal(), this.loadIndex();
    },

    //method que aciona uma fornecedor de filials.js
    destroy(id) {
      this.$store
        .dispatch("vendasDestroy", id)
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
    formVenda: formVendaComponent,
    confirmDelete,
    detalhe: detalheComponent,
    pagination: PaginationComponent
  }
};
</script>

<style scoped>
</style>
