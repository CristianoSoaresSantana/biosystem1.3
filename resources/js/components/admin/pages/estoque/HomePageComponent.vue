<template>
    <div>
        <h1>Vitrine</h1>
        <div class="input-group col-md-6" >
            <label class="input-group-text"><b>Filial</b></label>
            <select class="custom-select" v-model="filial_id">
                <option v-for="branche in branches" :key="branche.id" :value="branche.id" >{{branche.razao_social}}</option>
            </select>
            <label class="input-group-text"><b>Usuario</b></label>
            <select class="custom-select" v-model="usuario_id">
                <option v-for="user in users" :key="user.id" :value="user.id">{{ user.name }}</option>
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
        <div class="form-inline">
        <table class="table table-dark col-md-9">
            <thead>
            <tr>
                <th width="30px">SKU</th>
                <th width="70px">Cod. Barra</th>
                <th width="150px">Descrição</th>
                <th width="40px">Quantidade</th>
                <th width="50px">Preço</th>
                <th width="80px">Detalhes</th>
                <th width="150px">Adicionar / Remover</th>
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
                    <a href="#" class="btn btn-primary btn-sm" @click.prevent="detalhes(material.sku)">Detalhes</a>
                </td>
                <td>
                    <button class="btn btn-primary btn-sm" @click="selectItens(material.pivot)">Adicionar</button>
                    <button class="btn btn-danger btn-sm" @click="deselectItens(material.pivot)">Remover</button>
                </td>
            </tr>
            </tbody>
        </table>
        <ul class="col-md-3 list-group">
            <li class="list-group-item list-group-item-info" v-for="(item, index) in itens_venda" :key="index">
                sku: {{ item.material_sku }} preço: R${{ item.valor_venda }}
            </li>
            <button type="submit" class="btn btn-success" @click.prevent="adicionarItens">Resumo desta venda</button>
            <vodal :show="showVodal" animation="zoon" @hide="hideVodal" :width="1024" :height="750">
            <formVenda
                :title="titulo"
                :venda="propriedadeVenda"
                :filho_errors="propriedade_errors"
                :update="propriedadeupdate"
                @success="cadastroRealizado"
            ></formVenda>
            </vodal>
        <vodal :show="detalhesVodal" animation="zoon" @hide="hideDetalhesVodal" :width="600" :height="350">
            <detalhe :filho_materials="propriedadeMaterial"></detalhe>
        </vodal>
        </ul>
            <!-- paginação -->
            <pagination :pagination="estoque" :offset="6" @paginate="loadEstoque"></pagination>
        </div>
    </div>
</template>

<script>
import PaginationComponent from "../../../layouts/PaginationComponent";
import Vodal from "vodal";
import formVendaComponent from "../vendas/partials/FormVendaComponent";
import detalheComponent from "../materials/partials/detalheComponent";

export default {
    created() {
        this.loadEstoque;
    },

    data() {
        return {
            titulo: "",
            showVodal: false,
            detalhesVodal: false,
            propriedadeupdate: false,
            propriedade_errors: {},
            propriedadeVenda: {},
            propriedadeMaterial: {},
            busca: '',
            filial_id: '',
            usuario_id: '',
            input: {
                sku: '',
                cod_barra: '',
                descricao: ''
            },
            itens_venda: []

        }
    },

    watch: {
        filial_id() {
            this.loadEstoque();
        },

        usuario_id() {
            this.$store.commit('MUTATION_ADD_USUARIO', this.usuario_id);
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

        users() {
            return this.$store.state.usuarios.itens.data;
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

        selectItens(item) {
            this.itens_venda.push(item);
        },

        deselectItens(item) {
            this.itens_venda.splice(this.itens_venda.indexOf(item), 1);
        },

        adicionarItens() {
            this.$store.commit('MUTATION_ITENS_VENDA', this.itens_venda);

            this.titulo = "Fechamento de Venda";
            this.showVodal = true;
            this.propriedadeupdate = false;
            this.propriedadeVenda = {
                cliente_id  : this.$store.state.vendas.cliente,
                user_id     : this.$store.state.vendas.usuario,
                itens_venda : this.newArrayItens(this.$store.state.vendas.itens_venda[0])
            }
        },
        /* novo array para o form venda! */
        newArrayItens(itens){
            var newArrayItens = itens.map(function(item){
                return {
                    'sku': item.material_sku,
                    'filial_id': item.filial_id,
                    'valor_unitario': item.valor_venda,
                    'quantidade':1,
                    'lote': "",
                    'sub_total': "" }
            });
            return newArrayItens;
        },

        hideVodal() {
            this.showVodal = false,
            this.propriedade_errors = {},
            this.propriedadeVenda = {}
        },

        cadastroRealizado() {
            this.hideVodal(),
            this.loadEstoque,
            window.location.reload(true);
        },

        detalhes (sku) {
            this.$store.dispatch("actionLoadMaterial", sku).then(response => {
                this.propriedadeMaterial = response;
                this.detalhesVodal = true;
            }).catch(errors => {
                this.$snotify.errors("Registro não pode ser carregado!",  "Informativo");
            });
        },

        hideDetalhesVodal () {
            this.detalhesVodal = false,
            this.propriedadeMaterial = {
                sku: "",
                cod_barra: "",
                descricao: "",
                forma_farmaceutica_id: "",
                tipo_material_id: "",
                fornecedor_id: "",
                status: "",
                valor_compra: "",
                valor_revenda: "",
                tipo_material: Object,
                forma_farmaceutica: Object,
                fornecedor: Object
                // image: '',
            }
        }

    },

    components: {
        vodal: Vodal,
        formVenda: formVendaComponent,
        pagination: PaginationComponent,
        detalhe: detalheComponent
    }

}
</script>

<style scoped>

</style>

