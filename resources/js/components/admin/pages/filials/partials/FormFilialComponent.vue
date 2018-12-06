<template>
    <div>
        <form class="form" @submit.prevent="onSubmit">
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
    props: {
        filial: {
            require: false,
            type: Object|Array,
            default: () => {
                return {
                    razao_social: '',
                    cnpj: ''
                }
            }
        },
        updating: {
            require: false,
            type: Boolean,
            default: false,
        }
    },

    methods: {
        onSubmit () {
            // verificar se updating é true ou false
            const action = this.updating ? 'updateFilial' : 'storeFilial'

            this.$store.dispatch(action, this.filial)
                    .then(() => this.$router.push({name: 'admin.filials'}))
                    .catch()
        }
    },
}
</script>

<style scoped>

</style>
