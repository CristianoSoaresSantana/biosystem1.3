<template>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="form_main">
                    <h4 class="heading"><strong>{{ title }}</strong> <span></span></h4>
                    <form class="form" @submit.prevent="onSubmit" @close="reset()">
                        <div class="form-group col-md-12">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <div :class="['col-auto', {'has-error': errors.tipo_material}]">
                                        <div v-if="errors.tipo_material">{{ errors.tipo_material[0] }}</div>
                                        <input type="text" v-model="tipo_material.tipo_material" class="form-control mb-2 mr-sm-2" placeholder="Tipo Material">
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

        tipo_material: {
            require: false,
            type: Object
        },

        title: {
            require: true,
            type: String,
        },

        errors: {}
    },

    methods: {
        onSubmit () {

            let createOrUpdate = this.update ? 'updateTipoMaterial' : 'storeTipoMaterial'

            this.$store.dispatch(createOrUpdate, this.tipo_material)
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
        }
    },
}
</script>

<style scoped>
    .has-error{ color: red }
    .has-error input{ border: 1px solid red }
</style>
