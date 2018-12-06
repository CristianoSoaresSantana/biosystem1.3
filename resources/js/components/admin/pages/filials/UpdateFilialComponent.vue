<template>
    <div>
        <h1>Editar filial</h1>
        <!--primeiro param filial é o props de FormFilialComponent e o segundo é do data de UpdateFilialComponent  -->
        <form-cat :filial="filial" :updating="true"> </form-cat>
    </div>    
</template>

<script>
// importa o componente
import FormFilialComponent from './partials/FormFilialComponent'

export default {
    // declaro que o id é obrigatório!
    props: {
        id: {
            require: true
        }
    },

    // Chamo a actions loadFilial para fazer o update e retorno os dados para p param filial
    created () {
        this.$store.dispatch('loadFilial', this.id)
                .then(response => this.filial = response)
                .catch(errors => {
                    console.log(errors)
                })
    },

    data () {
        return {
            filial: {}
        }
    },

// registrar o component
    components: { 
        formCat: FormFilialComponent
    }
}
</script>

 <style scoped>
 
 </style>
 