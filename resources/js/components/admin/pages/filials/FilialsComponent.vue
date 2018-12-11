<template>
    <div>
        <h1>Lista das Filiais <h3>Total de filiais {{totalFilials}}</h3></h1>
        <div class="row">
            <div class="col">
                <router-link :to="{name: 'admin.filials.create'}" class="btn btn-success">Novo</router-link>
            </div>
            <div class="col">
                <buscarComponent @buscarFilial="buscarForm"></buscarComponent>
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
                    <tr v-for="(filial, index) in filials.data" :key="index">
                    <th v-text="filial.id"></th>
                    <td v-text="filial.razao_social"></td>
                    <td v-text="filial.cnpj"></td>
                    <td>
                        <router-link :to="{name: 'admin.filials.update', params: {id: filial.id}}" class="btn btn-info btn-sm">Editar</router-link>
                        <a href="#" class="btn btn-danger btn-sm" @click.prevent="confirmDestroy(filial.id)">Excluir</a>
                    </td>
                    </tr>
                </tbody>
                </table>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
import buscarComponent from '../../layouts/buscarComponent'

export default {
    created () {
        //Não preciso chamar este metodo! Pois chamei quando o app é startado em resources/js/app.js
        this.listarFiliais()
    },

    data () {
        return {
            // propriedade que recebi ou não um paramentro para pesquisa!
            razao_social: ''
        }
    },

    computed: {
        // retorna um objeto com todas as filiais
        filials () {
            return this.$store.state.filials.itens
        },
        // retorna o numero total de registros do objeto filials.
        totalFilials () {
            return this.$store.state.filials.itens.data.length
        }
    },
    methods: {
        //method que aciona a action loadFilials do modulo filials. Aqui tambem o params de pesquisa é passado!
        listarFiliais () {
            this.$store.dispatch('loadFilials', {razao_social: this.razao_social})
        },

        //method que pergunta ao usuario se ele quer mesmo deletar o registro
        confirmDestroy(id){
            this.$snotify.error('Deseja realmente deletar este registro?', 'Deletar', {
                timout: 10000,
                showProgressBar: true,

                buttons: [
                    {text: 'Não', closeOnClick: true},
                    {text: 'Sim', action: () => this.destroy(id)}
                ]
            })
        },

        //method que aciona uma action de filials.js
        destroy (id) {
            this.$store.dispatch('destroyFilial', id)
                .then(() => {
                    this.$snotify.success('Registro Deletado!', 'Sucesso')
                    this.listarFiliais()
                })
                .catch(errors => {
                    this.$snotify.errors('Registro não pode ser Deletado!', 'Fracasso')
                })
        },

        // este method pega o valor que o user informou atribui a propriedade razao_social e chama outra vez o loadFilials.
        buscarForm (filter) {
            this.razao_social = filter

            this.listarFiliais ()
        }
    },
    components: {
        buscarComponent,
    }
}
</script>

<style scoped>

</style>

