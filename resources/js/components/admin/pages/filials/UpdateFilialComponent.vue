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
        this.loadFilial()
    },

    data () {
        return {
            filial: {}
        }
    },

    methods: {
        // este metodo vai no modulo filials.js e executar o action loadFilial!
        loadFilial () {
            this.$store.dispatch('loadFilial', this.id)
                .then(response => this.filial = response)
                .catch(errors => {
                    // Exibindo o error
                    this.$snotify.error('Filial não encontrada', '404')
                    
                    // redirecionando
                    this.$router.push({name: 'admin.filials'})
                })
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
 