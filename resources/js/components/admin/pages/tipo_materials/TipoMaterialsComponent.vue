<template>
    <div>
        <h1>Lista Tipo de Materiais</h1>
        <div class="row">
            <div class="col">
                <button type="submit" class="btn btn-success" @click.prevent="criar()">Novo</button>
                <vodal :show="showVodal" animation="zoon" @hide="hideVodal" :width="620" :height="500">
                    <formTipo
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
                            <a href="#" class="btn btn-info btn-sm" @click.prevent="editar(tipo_material.id)">Editar</a>
                            <confirmDelete :resgistro="tipo_material.id" @destroy="destroy"/>
                        </td>
                    </tr>
                </tbody>
                </table>
        </div>
    </div>
</template>

<script>
import Vodal from 'vodal';
import FormTipoMaterialComponent from './partials/FormTipoMaterialComponent'
import confirmDelete from '../../layouts/confirmDeleteComponent'

export default {
    created () {
        this.loadTipoMaterials()
    },

    data () {
        return {
            input: '',
            showVodal: false,
            propriedadeupdate: false,
            propriedadeTipoMaterial: {
                id: '',
                tipo_material: '',
            }
        }
    },

    computed: {
        tipo_materials () {
            return this.$store.state.tipo_materials.itens
        },
    },

    methods: {
        loadTipoMaterials () {
            this.$store.dispatch('actionLoadTipoMaterials')
        },

        criar(){
            this.showVodal = true
            this.propriedadeupdate = false
            this.reset()
        },

        // pegar um registro e preencher o formulario!
        editar(id){
            this.reset()
            this.$store.dispatch('actionLoadTipoMaterial', id)
                    .then(response => {
                        this.propriedadeTipoMaterial = response
                        this.showVodal = true
                        this.propriedadeupdate = true
                    })
                    .catch((errors) => {
                        this.$snotify.errors('Registro não pode ser carregado!', 'Informativo')
                    })
        },

        hideVodal () {
            this.showVodal = false
        },

        cadastroRealizado () {
            this.hideVodal(),
            this.loadTipoMaterials()
        },

        //method que aciona uma action de filials.js
        destroy (id) {
            this.$store.dispatch('destroyTipoMaterial', id)
                .then(() => {
                    this.$snotify.success('Registro Deletado!', 'Sucesso')
                    this.loadTipoMaterials()
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
        formTipo: FormTipoMaterialComponent,
        confirmDelete
    },

}
</script>

<style scoped>

</style>
