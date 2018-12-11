<template>
    <div>
        <h1>Lista Tipo de Materiais</h1>
        <div class="row">
            <div class="col">
                <button type="submit" class="btn btn-success" @click.prevent="showVodal = true">Novo</button>
                <vodal :show="showVodal" animation="zoon" @hide="hideVodal" :width="620" :height="500">
                    <formTipo
                    :tipo_material="propriedadeTipoMaterial"
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
                            <a href="#" class="btn btn-info btn-sm">Editar</a>
                            <a href="#" class="btn btn-danger btn-sm">Excluir</a>
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

        // pegar um registro e preencher o formulario!
        // carregarMaterial(sku){
        //     this.$store.dispatch('actionLoadMaterial', sku)
        //             .then(response => {
        //                 this.propriedadeMaterial = response
        //                 this.showVodal = true
        //                 this.propriedadeupdate = true
        //             })
        //             .catch((errors) => {
        //                 this.$snotify.errors('Registro não pode ser carregado!', 'Informativo')
        //             })
        // },

        // // nome desta var representa o path do component! ex page.materialsComponent
        // pageMaterialsBuscar (inputBuscar) {
        //     this.input = inputBuscar,
        //     this.loadMaterials(1)
        // },

        hideVodal () {
            this.showVodal = false
        },

        cadastroRealizado () {
            this.hideVodal(),
            this.loadTipoMaterials()
        },

        // //method que pergunta ao usuario se ele quer mesmo deletar o registro
        // confirmDestroy(sku){
        //     this.$snotify.error('Deseja realmente deletar este registro?', 'Deletar', {
        //         timout: 10000,
        //         showProgressBar: true,
        //         buttons: [
        //             {text: 'Não', closeOnClick: true},
        //             {text: 'Sim', clickToHide: true, action: () => this.destroy(sku)}
        //         ]
        //     })
        // },

        // //method que aciona uma action de filials.js
        // destroy (sku) {
        //     this.$store.dispatch('destroyMaterial', sku)
        //         .then(() => {
        //             this.$snotify.success('Registro Deletado!', 'Sucesso')
        //             this.loadMaterials()
        //         })
        //         .catch(errors => {
        //             this.$snotify.errors('Registro não pode ser Deletado!', 'Fracasso')
        //         })
        // },


    },

    components: {
        vodal: Vodal,
        formTipo: FormTipoMaterialComponent,
    },

}
</script>

<style scoped>

</style>
