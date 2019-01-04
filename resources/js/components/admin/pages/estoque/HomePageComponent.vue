<template>
    <div>
        <h1>Vitrine</h1>

        <div class="input-group col-md-3" >
            <label class="input-group-text" for="inputGroupSelect01"><b>Selecione a filial</b></label>
            <select class="custom-select" v-model="filial_id" >
                <option v-for="branche in branches" :key="branche.id" :value="branche.id" >{{branche.razao_social}}</option>
            </select>
        </div>

        <h3>Pesquise um produto por Sku ou Código de Barra ou Descrição</h3>
        <form class="form-inline"  @submit.prevent="onSubmit">
            <div class="form-group mx-sm-3 mb-2">
                <input type="text" v-model="input.sku" class="form-control" id="inputPassword2" placeholder="SKU">
            </div>
            <div class="form-group mx-sm-3 mb-2">
                <input type="text" v-model="input.cod_barra" class="form-control" id="inputPassword2" placeholder="Codigo Barras">
            </div>
            <div class="form-group mx-sm-3 mb-2">
                <input type="text" v-model="input.descricao" class="form-control" id="inputPassword2" placeholder="Descrição">
            </div>
            <button type="submit" class="btn btn-primary mb-2">Buscar</button>
        </form>
        <div>
        <table class="table table-dark">
            <thead>
            <tr>
                <th>SKU</th>
                <th>Cod. Barra</th>
                <th>Descrição</th>
                <th>Quantidade</th>
                <th>Preço</th>
                <th width="400px">Adicionar ou Remover item do carrinho</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(material, index) in estoque.data" :key="index">
                <td v-text="material.sku"></td>
                <td v-text="material.cod_barra"></td>
                <td v-text="material.descricao"></td>
                <td v-text="material.pivot.quantidade"></td>
                <td v-text="material.pivot.valor_venda"></td>
                <td>
                    <button class="btn btn-primary btn-sm">Adicionar</button>
                    <button class="btn btn-danger btn-sm">Remover</button>
                </td>
            </tr>
            </tbody>
        </table>
            <!-- paginação -->
            <pagination :pagination="estoque" :offset="6" @paginate="loadEstoque"></pagination>
        </div>
    </div>
</template>

<script>
import PaginationComponent from "../../../layouts/PaginationComponent";

export default {
    created() {
        this.loadEstoque();
    },

    data() {
        return {
            filial_id: '1',
            input: {
                sku: '',
                cod_barra: '',
                descricao: ''
            }
        }
    },

    watch: {
        filial_id() {
            this.loadEstoque();
        }
    },

    computed: {
        // Esse metodo popular o select.
        branches() {
            return this.$store.state.branches.itens;
        },

        // Esse metodo popula a table.
        estoque() {
            return this.$store.state.estoque.itens.materials;
        },

        // paramentros para o loadEstoque
        params() {
            return {
                page: this.estoque.current_page,
                filial_id: this.filial_id,
                material_sku: this.input.sku,
                cod_barra: this.input.cod_barra,
                descricao: this.input.descricao
            }
        }
    },

    methods: {
        loadEstoque (page) {
            this.$store.dispatch("actionLoadBrancheMaterials", { ...this.params, page });
        },

        onSubmit() {
            this.loadEstoque();
        },

    },

    components: {
        pagination: PaginationComponent,
    }

}
</script>

<style scoped>

</style>

