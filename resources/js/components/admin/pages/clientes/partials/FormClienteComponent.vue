<template>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="form_main">
                    <h4 class="heading"><strong>{{title}}</strong> <span></span></h4>
                    <form class="form" @submit.prevent="onSubmit">
                        <div class="form-group col-md-12">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <div :class="['col-auto', {'has-error': errors.nome}]">
                                        <div v-if="errors.nome">{{ errors.nome[0] }}</div>
                                        <input type="text" v-model="cliente.nome" class="form-control mb-2 mr-sm-2" placeholder="nome">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <div :class="['col-auto', {'has-error': errors.cpf}]">
                                        <div v-if="errors.cpf">{{ errors.cpf[0] }}</div>
                                        <input type="text" v-model="cliente.cpf" class="form-control mb-2 mr-sm-2" placeholder="CPF">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div :class="['col-auto', {'has-error': errors.email}]">
                                        <div v-if="errors.email">{{ errors.email[0] }}</div>
                                        <input type="text" v-model="cliente.email" class="form-control mb-2 mr-sm-2" placeholder="E-mail">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <div :class="['col-auto', {'has-error': errors.celular}]">
                                        <div v-if="errors.celular">{{ errors.celular[0] }}</div>
                                        <input type="text" v-model="cliente.celular" class="form-control mb-2 mr-sm-2" placeholder="Celular">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div :class="['col-auto', {'has-error': errors.celular_recado}]">
                                        <div v-if="errors.celular_recado">{{ errors.celular_recado[0] }}</div>
                                        <input type="text" v-model="cliente.celular_recado" class="form-control mb-2 mr-sm-2" placeholder="Celular Recado">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <div :class="['col-auto', {'has-error': errors.endereco}]">
                                        <div v-if="errors.endereco">{{ errors.endereco[0] }}</div>
                                        <textarea v-model="cliente.endereco" class="form-control" placeholder="Endereço"></textarea>
                                    </div>
                                </div>
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

        errors: {},

        cliente: {
            require: false,
            type: Object|Array
        },

        title: {
            require: true,
            type: String,
        }
    },

    methods: {
        onSubmit () {

            let createOrUpdate = this.update ? 'clienteUpdate' : 'clienteStore'

            this.$store.dispatch(createOrUpdate, this.cliente)
                .then(() => {
                    // notificação para usuario.
                    this.$snotify.success('Cadastro realizado com sucesso!', 'Parabéns...')
                    this.$emit('success')
                })
                .catch(errors => {
                    // notificação para usuario.
                    this.$snotify.error('Você Errou!', 'Atenção')
                    this.errors = errors.response.data.errors
                })
        }
    },
}
</script>

<style scoped>
    .has-error{ color: red }
    .has-error input{ border: 1px solid red }
</style>
