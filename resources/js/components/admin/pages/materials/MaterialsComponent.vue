<template>
    <div>
        <h1>Lista de Materiais</h1>
        <div class="row">
            <div class="col">
                <button type="submit" class="btn btn-success" @click.prevent="showVodal = true">Novo</button>
                <vodal :show="showVodal" animation="zoon" @hide="hideVodal" :width="620" :height="500">
                    <formMaterial
                    :material="propriedadeMaterial"
                    :errors="propriedade_errors"
                    :update="propriedadeupdate"
                    @success="cadastroRealizado">
                    </formMaterial>
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
                    <th>Status</th>
                    <th>Valor Compra</th>
                    <th>Valor Revenda</th>
                    <th width="150px">Ações</th>
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
                        <td v-text="material.status"></td>
                        <td v-text="material.valor_compra"></td>
                        <td v-text="material.valor_revenda"></td>
                        <td>
                            <a href="#" class="btn btn-info btn-sm" @click.prevent="carregarMaterial(material.sku)">Editar</a>
                            <confirmDelete :resgistro="material.sku" @destroy="destroy"/>
                        </td>
                    </tr>
                </tbody>
                </table>
                <!-- paginação -->
            <pagination :pagination="materials" :offset="6" @paginate="loadMaterials"></pagination>
        </div>

    </div>
</template>

<script>
import Vodal from 'vodal';

import PaginationComponent from '../../../layouts/PaginationComponent.vue'
import BuscarComponent from '../../layouts/geralBuscarComponent'
import FormMaterialComponent from './partials/FormMaterialComponent'
import confirmDelete from '../../layouts/confirmDeleteComponent'

export default {

    created () {
        this.loadMaterials(1)
    },

    data () {
        return {
            input: '',
            titulo: '',
            showVodal: false,
            propriedade_errors: {},
            propriedadeupdate: false,
            propriedadeMaterial: {
                sku: '',
                cod_barra: '',
                descricao: '',
                forma_farmaceutica_id: '',
                tipo_material_id: '',
                status: '',
                valor_compra: '',
                valor_revenda: '',
                // image: '',
            }
        }
    },

    computed: {
        materials () {
            return this.$store.state.materials.itens
        },

        params () {
            return {
                page: this.materials.current_page,
                filter: this.input,
            }
        }
    },

    methods: {
        loadMaterials (page) {
            this.$store.dispatch('actionLoadMaterials', {...this.params, page})
        },

        // pegar um registro e preencher o formulario!
        carregarMaterial(sku){
            this.$store.dispatch('actionLoadMaterial', sku)
                    .then(response => {
                        this.propriedadeMaterial = response
                        this.showVodal = true
                        this.propriedadeupdate = true
                    })
                    .catch((errors) => {
                        this.$snotify.errors('Registro não pode ser carregado!', 'Informativo')
                    })
        },

        // nome desta var representa o path do component! ex page.materialsComponent
        pageMaterialsBuscar (inputBuscar) {
            this.input = inputBuscar,
            this.loadMaterials(1)
        },

        hideVodal () {
            this.showVodal = false,
            this.propriedade_errors = {}
        },

        cadastroRealizado () {
            this.hideVodal(),
            this.loadMaterials(1)
        },

        //method que aciona uma action de filials.js
        destroy (sku) {
            this.$store.dispatch('destroyMaterial', sku)
                .then(() => {
                    this.$snotify.success('Registro Deletado!', 'Sucesso')
                    this.loadMaterials()
                })
                .catch(errors => {
                    this.$snotify.errors('Registro não pode ser Deletado!', 'Fracasso')
                })
        },
    },

    components: {
        pagination: PaginationComponent,
        buscar:     BuscarComponent,
        vodal:      Vodal,
        formMaterial: FormMaterialComponent,
        confirmDelete,
    }
}

</script>


<style scoped>

</style>
