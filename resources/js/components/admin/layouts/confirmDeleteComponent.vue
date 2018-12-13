<template>
    <a href="#" class="btn btn-danger btn-sm" @click.prevent="confirmDestroy(resgistro)">Excluir</a>
</template>

<script>
export default {
    props: {
        resgistro: {
            require: true,
            type: Object|Array
        }
    },

    methods: {

        //method que pergunta ao usuario se ele quer mesmo deletar o registro
        confirmDestroy(id){
            this.$snotify.error('Deseja realmente deletar este registro?', 'Deletar', {
                timout: 10000,
                showProgressBar: true,
                closeOnClick: true,
                buttons: [
                    {text: 'Não', closeOnClick: true},
                    {text: 'Sim', action: () => this.$emit('destroy', id)}
                ]
            })
        },
    }
}
</script>
