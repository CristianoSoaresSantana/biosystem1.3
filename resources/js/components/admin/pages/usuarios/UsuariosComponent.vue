<template>
  <div>
    <h1>Lista de Usuários</h1>
    <div class="row">
      <div class="col">
        <button type="submit" class="btn btn-success" @click.prevent="criar">Novo</button>
        <vodal :show="showVodal" animation="zoon" @hide="hideVodal" :width="660" :height="600">
          <formUsuario
            :title="titulo"
            :usuario="propriedadeUsuario"
            :filho_errors="propriedade_errors"
            :statusInput="propriedade_statusInput"
            :update="propriedadeupdate"
            @success="cadastroRealizado"
          ></formUsuario>
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
            <th width="150px">Ações</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="usuario in usuarios.data" :key="usuario.id">
            <td v-text="usuario.id"></td>
            <td v-text="usuario.name"></td>
            <td v-text="usuario.cpf"></td>
            <td v-text="usuario.celular"></td>
            <td v-text="usuario.celular_recado"></td>
            <td v-text="usuario.email"></td>
            <td>
              <a href="#" class="btn btn-info btn-sm" @click.prevent="editar(usuario.id)">Editar</a>
              <confirmDelete :resgistro="usuario.id" @destroy="destroy"/>
            </td>
          </tr>
        </tbody>
      </table>
      <!-- paginação -->
      <pagination :pagination="usuarios" :offset="6" @paginate="loadIndex"></pagination>
    </div>
  </div>
</template>

<script>
import Vodal from "vodal";

import PaginationComponent from "../../../layouts/PaginationComponent.vue";
import BuscarComponent from "../../layouts/geralBuscarComponent";
import formUsuarioComponent from "./partials/FormUsuarioComponent";
import confirmDelete from "../../layouts/confirmDeleteComponent";

export default {
  created() {
    this.loadIndex(1);
  },

  data() {
    return {
      input: "",
      titulo: "",
      showVodal: false,
      propriedade_errors: {},
      propriedadeupdate: false,
      propriedade_statusInput: false,
      propriedadeUsuario: {
        id: "",
        name: "",
        cpf: "",
        data_nascimento: "",
        celular: "",
        celular_recado: "",
        email: "",
        endereco: "",
        setor_id: "",
        filial_id: "",
        permissao: "",
        status: "",
        filial: Object,
        setor: Object
      }
    };
  },

  computed: {
    usuarios() {
      return this.$store.state.usuarios.itens;
    },

    params() {
      return {
        page: this.usuarios.current_page,
        filter: this.input
      };
    }
  },

  methods: {
    loadIndex(page) {
      this.$store.dispatch("usuarioLoadIndex", { ...this.params, page });
    },

    criar() {
      (this.titulo = "Cadastrar Usuário"),
        (this.showVodal = true),
        (this.propriedadeupdate = false),
        (this.propriedadeUsuario = {
          id: "",
          name: "",
          cpf: "",
          data_nascimento: "",
          celular: "",
          celular_recado: "",
          email: "",
          endereco: "",
          setor_id: "",
          filial_id: "",
          permissao: "app.user",
          status: "ativo",
          filial: Object,
          setor: Object
        });
    },

    // pegar um registro e preencher o formulario!
    editar(id) {
      (this.titulo = "Alterar Usuário"),
        (this.propriedade_statusInput = true),
        this.$store
          .dispatch("usuarioLoadShow", id)
          .then(response => {
            this.propriedadeUsuario = response;
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
    pageBuscar(inputBuscar) {
      (this.input = inputBuscar), this.loadIndex(1);
    },

    hideVodal() {
      (this.showVodal = false),
        (this.propriedade_errors = {}),
        (this.propriedadeUsuario = {
          id: "",
          name: "",
          cpf: "",
          data_nascimento: "",
          celular: "",
          celular_recado: "",
          email: "",
          endereco: "",
          setor_id: "",
          filial_id: "",
          permissao: "",
          status: "",
          filial: Object,
          setor: Object
        });
    },

    cadastroRealizado() {
      this.hideVodal(), this.loadIndex(1);
    },

    //method que aciona uma usuario de filials.js
    destroy(id) {
      this.$store
        .dispatch("usuarioDestroy", id)
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
    formUsuario: formUsuarioComponent,
    confirmDelete
  }
};
</script>


<style scoped>
</style>
