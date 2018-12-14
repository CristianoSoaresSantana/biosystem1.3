<template>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="form_main">
                    <h4 class="heading"><strong>Cadastro de Materiais</strong> <span></span></h4>
                    <form class="form" @submit.prevent="onSubmit">
                        <div class="form-group col-md-12">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <div :class="['col-auto', {'has-error': errors.sku}]">
                                        <div v-if="errors.sku">{{ errors.sku[0] }}</div>
                                        <input type="text" v-model="material.sku" class="form-control mb-2 mr-sm-2" placeholder="SKU">
                                    </div>
                                </div>

                                <div class="form-group col-md-8">
                                    <div :class="['col-auto', {'has-error': errors.cod_barra}]">
                                        <div v-if="errors.cod_barra">{{ errors.cod_barra[0] }}</div>
                                        <input type="text" v-model="material.cod_barra" class="form-control mb-2 mr-sm-2" placeholder="Cod Barra">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <div :class="['col-auto', {'has-error': errors.descricao}]">
                                        <div v-if="errors.descricao">{{ errors.descricao[0] }}</div>
                                        <input type="text" v-model="material.descricao" class="form-control mb-2 mr-sm-2" placeholder="Descrição">
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <div :class="['col-auto', {'has-error': errors.forma_farmaceutica_id}]">
                                        <div v-if="errors.forma_farmaceutica_id">{{ errors.forma_farmaceutica_id[0] }}</div>
                                        <input type="text" v-model="material.forma_farmaceutica_id" class="form-control mb-2 mr-sm-2" placeholder="Forma">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div :class="['col-auto', {'has-error': errors.tipo_material_id}]">
                                        <div v-if="errors.tipo_material_id">{{ errors.tipo_material_id[0] }}</div>
                                        <input type="text" v-model="material.tipo_material_id" class="form-control mb-2 mr-sm-2" placeholder="Tipo">
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <div :class="['col-auto', {'has-error': errors.status}]">
                                        <div v-if="errors.status">{{ errors.status[0] }}</div>
                                        <input type="text" v-model="material.status" class="form-control mb-2 mr-sm-2" placeholder="Status">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <div :class="['col-auto', {'has-error': errors.valor_compra}]">
                                        <div v-if="errors.valor_compra">{{ errors.valor_compra[0] }}</div>
                                        <input type="text" v-model="material.valor_compra" class="form-control mb-2 mr-sm-2" placeholder="Valor compra">
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <div :class="['col-auto', {'has-error': errors.valor_revenda}]">
                                        <div v-if="errors.valor_revenda">{{ errors.valor_revenda[0] }}</div>
                                        <input type="text" v-model="material.valor_revenda" class="form-control mb-2 mr-sm-2" placeholder="Valor revenda">
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

        material: {
            require: false,
            type: Object,
            default: () => {
                return {
                    sku: '',
                    cod_barra: '',
                    descricao: '',
                    forma_farmaceutica_id: '',
                    tipo_material_id: '',
                    status: '',
                    valor_compra: '',
                    valor_revenda: '',
                    // image: '',
                }
            },
        }
    },

    computed: {
        filials () {
            return this.$store.state.filials.itens.data
        }
    },

    methods: {
        onSubmit () {

            this.$store.dispatch('storeMaterial', this.material)
                .then(() => {
                    // notificação para usuario.
                    this.$snotify.success('Cadastro realizado com sucesso!', 'Parabéns...')
                    this.resetForm()
                    this.$emit('success')
                })
                .catch(errors => {
                    // notificação para usuario.
                    this.$snotify.error('Você Errou!', 'Atenção')

                    console.log(errors.response.data.errors)
                    this.errors = errors.response.data.errors
                })
        },

        resetForm () {
            this.errors = {},
            this.material.sku = '',
            this.material.cod_barra = '',
            this.material.descricao = '',
            this.material.forma_farmaceutica_id = '',
            this.material.tipo_material_id = '',
            this.material.status = '',
            this.material.valor_compra = '',
            this.material.valor_revenda = ''
        }
    },
}
</script>

<style scoped>
    .has-error{ color: red }
    .has-error input{ border: 1px solid red }
</style>
