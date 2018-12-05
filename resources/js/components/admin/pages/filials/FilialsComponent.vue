<template>
    <div>
        <h1>lista de filials - Template</h1>
        <div>
        <table>
            <thead>
                <tr>
                <th>ID</th>
                <th>Razão Social</th>
                <th>CNPJ</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(filial, index) in filials.data" :key="index">
                <th v-text="filial.id"></th>
                <td v-text="filial.razao_social"></td>
                <td v-text="filial.cnpj"></td>
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
        }
    }
}
</script>

<style scoped>

</style>

