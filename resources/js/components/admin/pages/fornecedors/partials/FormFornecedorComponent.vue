<template>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="form_main">
                    <h4 class="heading"><strong>{{ title }}</strong> <span></span></h4>
                    <form class="form" @submit.prevent="onSubmit">
                        <div class="form-group col-md-12">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <div :class="['col-auto', {'has-error': errors.razao_social}]">
                                        <div v-if="errors.razao_social">{{ errors.razao_social[0] }}</div>
                                        <input type="text" v-model="fornecedor.razao_social" class="form-control mb-2 mr-sm-2" placeholder="Razão Social">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div :class="['col-auto', {'has-error': errors.cnpj}]">
                                        <div v-if="errors.cnpj">{{ errors.cnpj[0] }}</div>
                                        <input type="text" v-model="fornecedor.cnpj" class="form-control mb-2 mr-sm-2" placeholder="CNPJ">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-primary">Confirmar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        update: {
            require: false,
            type: Boolean,
            default: false,
        },

        fornecedor: {
            require: false,
            type: Object
        },

        title: {
            require: true,
            type: String,
        },

        errors: {},
    },


    methods: {
        onSubmit () {

            let createOrUpdate = this.update ? 'fornecedorUpdate' : 'fornecedorStore'

            this.$store.dispatch(createOrUpdate, this.fornecedor)
                .then(() => {
                    // notificação para usuario.
                    this.$snotify.success('Ação realizada com sucesso!', 'Parabéns...')
                    this.$emit('success')
                })
                .catch(errors => {
                    // notificação para usuario.
                    this.$snotify.error('Você Errou!', 'Atenção')
                    this.errors = errors.response.data.errors
                })
        },
    },
}
</script>

<style scoped>
    .has-error{ color: red }
    .has-error input{ border: 1px solid red }
</style>
