<template>
    <div>
        <h1>Lista das Filiais <h3>Total de filiais {{totalFilials}}</h3></h1>
        <div>
        <table class="table table-dark">
            <thead>
                <tr>
                <th>ID</th>
                <th>Razão Social</th>
                <th>CNPJ</th>
                <th width="100">Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(filial, index) in filials.data" :key="index">
                <th v-text="filial.id"></th>
                <td v-text="filial.razao_social"></td>
                <td v-text="filial.cnpj"></td>
                <td></td>
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
        this.$store.dispatch('loadFilials')
    },
    computed: {
        filials () {
            return this.$store.state.filials.itens
        },
        totalFilials () {
            return this.$store.state.filials.itens.data.length
        }
    }
}
</script>

<style scoped>

</style>

