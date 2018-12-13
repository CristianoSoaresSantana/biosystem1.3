<template>
    <div>
        <h1>Lista de Filias</h1>
        <div class="row">
            <div class="col">
                <button type="submit" class="btn btn-success" @click.prevent="criar()">Novo</button>
                <vodal :show="showVodal" animation="zoon" @hide="hideVodal" :width="620" :height="500">
                    <formBranche
                    :title="titulo"
                    :branche="propriedadeBranche"
                    :errors="errors"
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
                    <th width="150px">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="branche in branches" :key="branche.id">
                        <td v-text="branche.id"></td>
                        <td v-text="branche.razao_social"></td>
                        <td v-text="branche.cnpj"></td>
                        <td>
                            <a href="#" class="btn btn-info btn-sm" @click.prevent="editar(branche.id)">Editar</a>
                            <confirmDelete :resgistro="branche.id" @destroy="destroy"/>
                        </td>
                    </tr>
                </tbody>
                </table>
        </div>
    </div>
</template>

<script>
import Vodal from 'vodal';
import FormBrancheComponent from './partials/FormBrancheComponent'
import confirmDelete from '../../layouts/confirmDeleteComponent'

export default {
    created () {
        this.loadbranches()
    },

    data () {
        return {
            showVodal: false,
            propriedadeupdate: false,
            propriedadeBranche: {
                id: '',
                razao_social: '',
                cnpj: '',
            },
            titulo: '',
            errors: {}
        }
    },

    computed: {
        branches () {
            return this.$store.state.branches.itens
        },
    },

    methods: {
        loadbranches () {
            this.$store.dispatch('actionLoadBranches')
        },

        criar(){
            this.titulo = "Cadastrar Filial"
            this.showVodal = true
            this.propriedadeupdate = false
            this.reset()
        },

        // pegar um registro e preencher o formulario!
        editar(id){
            this.reset()
            this.titulo = "Alterar Filial"
            this.$store.dispatch('actionLoadBranche', id)
                    .then(response => {
                        this.propriedadeBranche = response
                        this.showVodal = true
                        this.propriedadeupdate = true
                    })
                    .catch((errors) => {
                        this.$snotify.errors('Registro não pode ser carregado!', 'Informativo')
                    })
        },

        hideVodal () {
            this.showVodal = false,
            this.errors = {},
            this.propriedadeBranche = {
                id : '',
                razao_social: '',
                cnpj: ''
            }

        },

        cadastroRealizado () {
            this.hideVodal(),
            this.loadbranches()
        },

        //method que aciona uma action de filials.js
        destroy (id) {
            this.$store.dispatch('destroyBranche', id)
                .then(() => {
                    this.$snotify.success('Registro Deletado!', 'Sucesso')
                    this.loadbranches()
                })
                .catch(errors => {
                    this.$snotify.errors('Registro não pode ser Deletado!', 'Fracasso')
                })
        },

        reset () {
            this.propriedadeTipoMaterial = {
                id: '',
                tipo_material: '',
            }
        },
    },

    components: {
        vodal: Vodal,
        formBranche: FormBrancheComponent,
        confirmDelete
    },

}
</script>

<style scoped>

</style>
