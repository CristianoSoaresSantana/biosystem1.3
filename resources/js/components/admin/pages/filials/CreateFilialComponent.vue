<template>
    <div>
        <h1>Adicionar filial</h1>

        <form class="form" @submit.prevent="submitForm">
            <div class="form-row align-items-center">
                <div class="col-auto">
                    <input type="text" v-model="formData.razao_social" class="form-control" placeholder="Nome da Filial">
                </div>
                <div class="col-auto">
                    <input type="text" v-model="formData.cnpj" class="form-control" placeholder="CNPJ da Filial">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </div>
            </div>
        </form>
    </div>    
</template>

<script>
import axios from 'axios'

export default {
    data () {
        return {
            formData: {
                razao_social: '',
                cnpj: ''
            }
        }
    },

    methods: {
        submitForm () {
            this.$store.dispatch('storeFilial', this.formData)
                    .then(() => this.$router.push({name: 'admin.filials'}))
                    .catch()
        }
    }
}
</script>

<style scoped>

</style>
