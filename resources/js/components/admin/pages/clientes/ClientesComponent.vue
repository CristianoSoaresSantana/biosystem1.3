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
                    :errors="propriedade_errors"
                    :statusInput="propriedade_statusInput"
                    :update="propriedadeupdate"
                    @success="cadastroRealizado">
                    </formCliente>
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
                    <tr v-for="cliente in clientes.data" :key="cliente.id">
                        <td v-text="cliente.id"></td>
                        <td v-text="cliente.nome"></td>
                        <td v-text="cliente.cpf"></td>
                        <td v-text="cliente.celular"></td>
                        <td v-text="cliente.celular_recado"></td>
                        <td v-text="cliente.email"></td>
                        <td>
                            <a href="#" class="btn btn-info btn-sm" @click.prevent="editar(cliente.id)">Editar</a>
                            <confirmDelete :resgistro="cliente.id" @destroy="destroy"/>
                        </td>
                    </tr>
                </tbody>
                </table>
                <!-- paginação -->
            <pagination :pagination="clientes" :offset="6" @paginate="loadIndex"></pagination>
        </div>

    </div>
</template>

<script>
import Vodal from 'vodal';

import PaginationComponent from '../../../layouts/PaginationComponent.vue'
import BuscarComponent from '../../layouts/geralBuscarComponent'
import FormClienteComponent from './partials/FormClienteComponent'
import confirmDelete from '../../layouts/confirmDeleteComponent'

export default {

    created () {
        this.loadIndex(1)
    },

    data () {
        return {
            input: '',
            titulo: '',
            showVodal: false,
            propriedade_errors: {},
            propriedadeupdate: false,
            propriedade_statusInput: false,
            propriedadeCliente: {
                id: '',
                nome: '',
                cpf: '',
                celular: '',
                celular_recado: '',
                email: '',
                endereco: ''
            }
        }
    },

    computed: {
        clientes () {
            return this.$store.state.clientes.itens
        },

        params () {
            return {
                page: this.clientes.current_page,
                filter: this.input,
            }
        }
    },

    methods: {
        loadIndex (page) {
            this.$store.dispatch('clienteLoadIndex', {...this.params, page})
        },

        criar () {
            this.titulo = "Cadastrar Cliente",
            this.showVodal = true,
            this.propriedadeupdate = false
        },

        // pegar um registro e preencher o formulario!
        editar(id){
            this.titulo = "Alterar Cliente",
            this.propriedade_statusInput = true,
            this.$store.dispatch('clienteLoadShow', id)
                    .then(response => {
                        this.propriedadeCliente = response
                        this.showVodal = true
                        this.propriedadeupdate = true
                    })
                    .catch((errors) => {
                        this.$snotify.errors('Registro não pode ser carregado!', 'Informativo')
                    })
        },

        // nome desta var representa o path do component! ex page.materialsComponent
        pageBuscar (inputBuscar) {
            this.input = inputBuscar,
            this.loadIndex(1)
        },

        hideVodal () {
            this.showVodal = false,
            this.propriedade_errors = {},
            this.propriedadeCliente = {
                id: '',
                nome: '',
                cpf: '',
                celular: '',
                recado: '',
                email: '',
                endereco: ''
            }
        },

        cadastroRealizado () {
            this.hideVodal(),
            this.loadIndex(1)
        },

        //method que aciona uma cliente de filials.js
        destroy (id) {
            this.$store.dispatch('clienteDestroy', id)
                .then(() => {
                    this.$snotify.success('Registro Deletado!', 'Sucesso')
                    this.loadIndex()
                })
                .catch(errors => {
                    this.$snotify.errors('Registro não pode ser Deletado!', 'Fracasso')
                })
        }
    },

    components: {
        pagination: PaginationComponent,
        buscar:     BuscarComponent,
        vodal:      Vodal,
        formCliente: FormClienteComponent,
        confirmDelete,
    }
}

</script>


<style scoped>

</style>
