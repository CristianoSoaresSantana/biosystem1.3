<template>
  <div>
    <h1>Lista de Clientes</h1>
    <div class="row">
      <div class="col">
        <button type="submit" class="btn btn-success" @click.prevent="criar">Novo</button>
        <vodal :show="showVodal" animation="zoon" @hide="hideVodal" :width="620" :height="500">
          <formCliente
            :title="titulo"
            :cliente="propriedadeCliente"
            :filho_errors="propriedade_errors"
            :statusInput="propriedade_statusInput"
            :update="propriedadeupdate"
            @success="cadastroRealizado"
          ></formCliente>
        </vodal>
      </div>
      <div class="col">
        <buscar @layoutBuscar="pageBuscar"></buscar>
      </div>
    </div>
    <div>
      <table class="table table-dark">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>CPF</th>
            <th>Celular</th>
            <th>Recados</th>
            <th>E-mail</th>
            <th width="200px">Ações</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="cliente in clientes.data" :key="cliente.id">
            <td v-text="cliente.id"></td>
            <td v-text="cliente.nome"></td>
            <td v-text="cliente.cpf"></td>
            <td v-text="cliente.celular"></td>
            <td v-text="cliente.celular_recado"></td>
            <td v-text="cliente.email"></td>
            <td>
              <a href="#" class="btn btn-primary btn-sm" @click.prevent="detalhes(cliente.id)">Detalhes</a>
              <a href="#" class="btn btn-info btn-sm" @click.prevent="editar(cliente.id)">Editar</a>
              <confirmDelete :resgistro="cliente.id" @destroy="destroy"/>
            </td>
          </tr>
        </tbody>
      </table>
      <vodal :show="detalhesVodal" animation="zoon" @hide="hideDetalhesVodal" :width="920" :height="600">
          <detalhe :filho_cliente="propriedadeCliente"></detalhe>
      </vodal>
      <!-- paginação -->
      <pagination :pagination="clientes" :offset="6" @paginate="loadIndex"></pagination>
    </div>
  </div>
</template>

<script>
import Vodal from "vodal";

import PaginationComponent from "../../../layouts/PaginationComponent.vue";
import BuscarComponent from "../../layouts/geralBuscarComponent";
import FormClienteComponent from "./partials/FormClienteComponent";
import confirmDelete from "../../layouts/confirmDeleteComponent";
import detalheComponent from './partials/detalheComponent';

export default {
  created() {
    if(this.clientes.data.length == 0){
        this.loadIndex(1);
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
      propriedadeCliente: {
        id: "",
        nome: "",
        cpf: "",
        celular: "",
        celular_recado: "",
        email: "",
        endereco: "",
        vendas: Object
      }
    };
  },

  computed: {
    clientes() {
      return this.$store.state.clientes.itens;
    },

    params() {
      return {
        page: this.clientes.current_page,
        filter: this.input
      };
    }
  },

  methods: {
    loadIndex(page) {
      this.$store.dispatch("clienteLoadIndex", { ...this.params, page });
    },

    criar() {
      (this.titulo = "Cadastrar Cliente"),
        (this.showVodal = true),
        (this.propriedadeupdate = false);
    },

    detalhes (id) {
      this.$store
        .dispatch("clienteLoadShow", id)
        .then(response => {
          this.propriedadeCliente = response;
          this.detalhesVodal = true;
        })
        .catch(errors => {
          this.$snotify.errors(
            "Registro não pode ser carregado!",
            "Informativo"
          );
        });
    },

    editar(id) {
      (this.titulo = "Alterar Cliente"),
        (this.propriedade_statusInput = true),
        this.$store
          .dispatch("clienteLoadShow", id)
          .then(response => {
            this.propriedadeCliente = response;
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

    pageBuscar(inputBuscar) {
      (this.input = inputBuscar), this.loadIndex(1);
    },

    hideVodal() {
      (this.showVodal = false),
        (this.propriedade_errors = {}),
        (this.propriedadeCliente = {
          id: "",
          nome: "",
          cpf: "",
          celular: "",
          recado: "",
          email: "",
          endereco: "",
          vendas: Object
        });
    },

    hideDetalhesVodal () {
        this.detalhesVodal = false,
        (this.propriedadeCliente = {
          id: "",
          nome: "",
          cpf: "",
          celular: "",
          recado: "",
          email: "",
          endereco: "",
          vendas: Object
        });
    },

    cadastroRealizado() {
      this.hideVodal(), this.loadIndex(1);
    },

    destroy(id) {
      this.$store
        .dispatch("clienteDestroy", id)
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
    pagination: PaginationComponent,
    buscar: BuscarComponent,
    vodal: Vodal,
    formCliente: FormClienteComponent,
    confirmDelete,
    detalhe: detalheComponent
  }
};
</script>



