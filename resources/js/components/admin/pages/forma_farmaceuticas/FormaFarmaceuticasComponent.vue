<template>
    <div>
        <h1>Lista Forma Farmacêutica</h1>
        <div class="row">
            <div class="col">
                <button type="submit" class="btn btn-success" @click.prevent="criar()">Novo</button>
                    <vodal :show="showVodal" animation="zoon" @hide="hideVodal" :width="620" :height="500">
                    <formTipo
                    :title="titulo"
                    :errors="propriedade_errors"
                    :forma_farmaceutica="propriedadeFormaFarmaceutica"
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
                    <th>Forma Farmacêutica</th>
                    <th width="150px">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="forma_farmaceutica in forma_farmaceuticas" :key="forma_farmaceutica.id">
                        <td v-text="forma_farmaceutica.id"></td>
                        <td v-text="forma_farmaceutica.forma_farmaceutica"></td>
                        <td>
                            <a href="#" class="btn btn-info btn-sm" @click.prevent="editar(forma_farmaceutica.id)">Editar</a>
                            <confirmDelete :resgistro="forma_farmaceutica.id" @destroy="destroy"/>
                        </td>
                    </tr>
                </tbody>
                </table>
        </div>
    </div>
</template>

<script>
import Vodal from 'vodal';
import FormFormaFarmaceuticaComponent from './partials/FormFormaFarmaceuticaComponent'
import confirmDelete from '../../layouts/confirmDeleteComponent'

export default {
    created () {
        this.loadFormaFarmaceuticas()
    },

    data () {
        return {
            titulo: '',
            propriedade_errors: {},
            showVodal: false,
            propriedadeupdate: false,
            propriedadeFormaFarmaceutica: {
                id: '',
                forma_farmaceutica: '',
            },
        }
    },

    computed: {
        forma_farmaceuticas () {
            return this.$store.state.forma_farmaceuticas.itens
        },
    },

    methods: {
        loadFormaFarmaceuticas () {
            this.$store.dispatch('actionLoadFormaFarmaceuticas')
        },

        criar(){
            this.titulo = "Cadastrar Forma Farmacêutica"
            this.showVodal = true
            this.propriedadeupdate = false
        },

        // pegar um registro e preencher o formulario!
        editar(id){
            this.titulo = "Alterar Forma Farmacêutica"
            this.$store.dispatch('actionLoadFormaFarmaceutica', id)
                    .then(response => {
                        this.propriedadeFormaFarmaceutica = response
                        this.showVodal = true
                        this.propriedadeupdate = true
                    })
                    .catch((errors) => {
                        this.$snotify.errors('Registro não pode ser carregado!', 'Informativo')
                    })
        },

        hideVodal () {
            this.showVodal = false,
            this.propriedade_errors = {},
            this.propriedadeFormaFarmaceutica = {
                id: '',
                forma_farmaceutica: '',
            }
        },

        cadastroRealizado () {
            this.hideVodal(),
            this.loadFormaFarmaceuticas()
        },

        //method que aciona uma action de filials.js
        destroy (id) {
            this.$store.dispatch('destroyFormaFarmaceutica', id)
                .then(() => {
                    this.$snotify.success('Registro Deletado!', 'Sucesso')
                    this.loadFormaFarmaceuticas()
                })
                .catch(errors => {
                    this.$snotify.errors('Registro não pode ser Deletado!', 'Fracasso')
                })
        },
    },

    components: {
        vodal: Vodal,
        formTipo: FormFormaFarmaceuticaComponent,
        confirmDelete
    },
}

</script>

<style scoped>

</style>
