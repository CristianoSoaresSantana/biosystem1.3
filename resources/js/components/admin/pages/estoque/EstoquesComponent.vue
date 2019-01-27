<template>
    <div>
        <h1>Gestão do Estoque</h1>
        <div class="input-group col-md-3">
            <button type="button" class="btn btn-success" @click.prevent="criar()">Incluir</button>
        </div>
        <div class="input-group col-md-3" >
            <label class="input-group-text" for="inputGroupSelect01"><b>Selecione a filial</b></label>
            <select class="custom-select" v-model="filial_id" >
                <option value>Selecione a filial</option>
                <option v-for="branche in branches" :key="branche.id" :value="branche.id" >{{ branche.razao_social }}</option>
            </select>
        </div>
        <h3 class="input-group col-md-12">Pesquise um produto por Sku ou Código de Barra ou Descrição</h3>
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
                <th>Comissão</th>
                <th>Status</th>
                <th>Quantidade</th>
                <th>Preço</th>
                <th width="250px">Ações</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(material, index) in estoque.data" :key="index">
                <td v-text="material.sku"></td>
                <td v-text="material.cod_barra"></td>
                <td v-text="material.descricao"></td>
                <td v-text="material.pivot.comissao"></td>
                <td v-text="material.pivot.status"></td>
                <td v-text="material.pivot.quantidade"></td>
                <td v-text="material.pivot.valor_venda"></td>
                <td>
                    <a href="#" class="btn btn-primary btn-sm" @click.prevent="detalhes(material.pivot.filial_id, material.sku)">Detalhes</a>
                    <a href="#" class="btn btn-info btn-sm" @click.prevent="editar(material.pivot.filial_id, material.sku)">Alterar</a>
                    <a href="#" class="btn btn-danger btn-sm" @click.prevent="confirmDestroy(material.pivot.filial_id, material.sku)">Excluir</a>
                </td>
            </tr>
            </tbody>
        </table>
            <!-- paginação -->
            <pagination :pagination="estoque" :offset="6" @paginate="loadEstoque"></pagination>
        </div>
        <vodal :show="showVodal" animation="zoon" @hide="hideVodal" :width="1024" :height="500">
          <formEstoque
            :title="titulo"
            :estoque="propriedadeEstoque"
            :filho_errors="propriedade_errors"
            :update="propriedadeupdate"
            @success="cadastroRealizado"
          ></formEstoque>
        </vodal>

        <vodal :show="showEditVodal" animation="zoon" @hide="hideVodal" :width="520" :height="350">
          <formEditEstoque
            :title="titulo"
            :filho_estoque="propriedadeEstoque"
            :filho_errors="propriedade_errors"
            :update="propriedadeupdate"
            @success="cadastroRealizado"
          ></formEditEstoque>
        </vodal>

        <vodal :show="detalhesVodal" animation="zoon" @hide="hideVodal" :width="600" :height="350">
          <detalhe :filho_estoque="propriedadeEstoque"></detalhe>
      </vodal>
    </div>
</template>

<script>
import Vodal from "vodal";
import PaginationComponent from "../../../layouts/PaginationComponent";
import FormEstoqueComponent from "./partials/FormEstoqueComponent";
import FormEditEstoqueComponent from "./partials/FormEditEstoqueComponent";
import detalheComponent from './partials/detalheComponent';

export default {
    created() {
        this.loadEstoque;
    },

    data() {
        return {
            filial_id: '',
            titulo: "",
            showVodal: false,
            showEditVodal: false,
            detalhesVodal: false,
            input: {
                sku: '',
                cod_barra: '',
                descricao: ''
            },
            propriedadeupdate: false,
            propriedade_errors: {},
            propriedadeEstoque: {
                pivot: {
                    filial_id:'',
                    material_sku:'',
                    quantidade:'',
                    curvaABC:'',
                    comissao:'',
                    valor_venda:'',
                    max:'',
                    min:'',
                    status:''
                }
            }
        }
    },

    watch: {
        // Observa quando o select filial é acionando!
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
        // Carrega a table com dados do DB!
        loadEstoque (page) {
            this.$store.dispatch("actionLoadBrancheMaterials", { ...this.params, page });
        },

        // Recarrega a table se o campo select for alterado!
        onSubmit() {
            this.loadEstoque();
        },

        // Fechar o formulario e limpar erros e os campos!
        hideVodal() {
            this.showVodal = false,
            this.showEditVodal = false,
            this.detalhesVodal = false,
            this.propriedade_errors = {},
            this.propriedadeEstoque = {
                pivot: {
                    filial_id:'',
                    material_sku:'',
                    quantidade:'',
                    curvaABC:'',
                    comissao:'',
                    valor_venda:'',
                    max:'',
                    min:'',
                    status:''
                }
            }
        },
        detalhes (filial_id, material_sku) {
            this.$store.dispatch("actionLoadBrancheMaterial", {filial_id, material_sku}).then(response => {
                this.propriedadeEstoque = response.materials[0];
                this.detalhesVodal = true;
            })
            .catch(errors => {
                this.$snotify.errors("Registro não pode ser carregado!", "Informativo" );
            });
        },

        criar() {
            this.titulo = "Incluir Produto No Estoque Desta Filial";
            this.showVodal = true;
            this.propriedadeupdate = false;
        },

        editar(filial_id, material_sku) {
            this.titulo = "Alterar Produto No Estoque Desta Filial";

            this.$store.dispatch("actionLoadBrancheMaterial", {filial_id, material_sku}).then(response => {
                this.propriedadeEstoque = response.materials[0];
                this.showEditVodal = true;
                this.propriedadeupdate = true;
            }).catch(errors => {
                this.$snotify.errors("Registro não pode ser carregado!", "Informativo");
            });
        },

        //method que pergunta ao usuario se ele quer mesmo deletar o registro
        confirmDestroy(filial_id, material_sku){

            this.$snotify.error('Deseja realmente deletar este registro?', 'Deletar', {
                timout: 5000,
                showProgressBar: true,
                closeOnClick: true,
                buttons: [
                    {text: 'Não', closeOnClick: true},
                    {text: 'Sim', action: () => this.destroy(filial_id, material_sku)}
                ]
            })
        },

        //method que aciona uma action de filials.js
        destroy(filial_id, material_sku) {

            this.$store.dispatch("destroyBrancheMaterial", {filial_id, material_sku}).then(() => {
            this.$snotify.success("Registro Deletado!", "Sucesso");
            this.loadEstoque();
            }).catch(errors => {
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
                    {timeout: 5000, showProgressBar: true, closeOnClick: true, pauseOnHover: true, position: "centerTop"});
            });
        },

        cadastroRealizado() {
            this.hideVodal(),
            this.loadEstoque()
        },

    },

    components: {
        pagination: PaginationComponent,
        formEstoque: FormEstoqueComponent,
        formEditEstoque: FormEditEstoqueComponent,
        vodal: Vodal,
        detalhe: detalheComponent
    }

}
</script>

<style scoped>

</style>

