<template>
    <div>
        <h1>Editar filial</h1>

        <form class="form" @submit.prevent="submitForm">
            <div class="form-row align-items-center">
                <div class="col-auto">
                    <input type="text" v-model="filial.razao_social" class="form-control" placeholder="Nome da Filial">
                </div>
                <div class="col-auto">
                    <input type="text" v-model="filial.cnpj" class="form-control" placeholder="CNPJ da Filial">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </div>
            </div>
        </form>
    </div>    
</template>

<script>
export default {
    // declaro que o id é obrigatório!
    props: {
        id: {
            require: true
        }
    },

    // Chamo a actions loadFilial para vai fazer o update!
    created () {
        this.$store.dispatch('loadFilial', this.id)
                .then(response => this.filial = response)
                .catch(errors => {
                    console.log(errors)
                })
    },
    
    data () {
        return {
            filial: {
                razao_social: '',
                cnpj: ''
            }
        }
    }
}
</script>

 <style scoped>
 
 </style>
 