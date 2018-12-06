<template>
    <div>
        <h1>Lista das Filiais <h3>Total de filiais {{totalFilials}}</h3></h1>

        <router-link :to="{name: 'admin.filials.create'}" class="btn btn-success">Cadastrar</router-link>

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

export default {
    created () {
        this.listarFiliais()
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
        //method que aciona uma action de filials.
        listarFiliais () {
            this.$store.dispatch('loadFilials')
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
        }
    }
}
</script>

<style scoped>

</style>

