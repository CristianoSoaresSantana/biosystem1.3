<template>
    <div>
        <h1>Lista de Materiais</h1>

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
                            <a href="#" class="btn btn-info btn-sm" >Editar</a>
                            <a href="#" class="btn btn-danger btn-sm" >Excluir</a>
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
import PaginationComponent from '../../../layouts/PaginationComponent.vue'

export default {
    
    created () {
        this.loadMaterials(1)
    },

    computed: {
        materials () {
            return this.$store.state.materials.itens
        },

        params () {
            return {
                page: this.materials.current_page
            }
        }
    },

    methods: {
        loadMaterials (page) {
            this.$store.dispatch('actionLoadMaterials', {...this.params, page})
        }
    },

    components: {
        pagination: PaginationComponent
    }
}

</script>


<style scoped>
    
</style>