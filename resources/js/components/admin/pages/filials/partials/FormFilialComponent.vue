<template>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="form_main">
                    <h4 class="heading"><strong>Preencha</strong> as informações <span></span></h4>
                    <form class="form" @submit.prevent="onSubmit">
                        <div class="form-row align-items-center">
                            <div :class="['col-auto', {'has-error': errors.razao_social}]">
                                <div v-if="errors.razao_social">{{ errors.razao_social[0] }}</div>
                                <input type="text" v-model="filial.razao_social" class="form-control" placeholder="Nome da Filial">
                            </div>
                            <div :class="['col-auto', {'has-error': errors.cnpj}]">
                                <div v-if="errors.cnpj">{{ errors.cnpj[0] }}</div>
                                <input type="text" v-model="filial.cnpj" class="form-control" placeholder="CNPJ da Filial">
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary">Confirmar</button>
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
        filial: {
            require: false,
            type: Object|Array,
            default: () => {
                return {
                    id: '',
                    razao_social: '',
                    cnpj: '',
                }
            }
        },
        updating: {
            require: false,
            type: Boolean,
            default: false,
        }
    },

    // propriedade do formFilialComponent
    data () {
        return {
            errors: {}
        }
    },

    methods: {
        onSubmit () {
            // verificar se updating é true ou false
            const action = this.updating ? 'updateFilial' : 'storeFilial'

            this.$store.dispatch(action, this.filial)
                    .then(() => {
                        // notificação para usuario.
                        this.$snotify.success('Cadastro realizado com sucesso!', 'Parabéns...')

                        //redirecionar para lista
                        this.$router.push({name: 'admin.filials'})
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
