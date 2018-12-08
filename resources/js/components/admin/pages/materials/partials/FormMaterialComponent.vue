<template>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="form_main">
                    <h4 class="heading"><strong>Preencha</strong> as informações <span></span></h4>
                    <form class="form" @submit.prevent="onSubmit">
                        <div class="form-group">
                            <div :class="['col-auto', {'has-error': errors.sku}]">
                                <div v-if="errors.sku">{{ errors.sku[0] }}</div>
                                <input type="text" v-model="material.sku" class="form-control" placeholder="SKU">
                            </div>

                            <div :class="['col-auto', {'has-error': errors.cod_barra}]">
                                <div v-if="errors.cod_barra">{{ errors.cod_barra[0] }}</div>
                                <input type="text" v-model="material.cod_barra" class="form-control" placeholder="Cod Barra">
                            </div>
                        
                            <div :class="['col-auto', {'has-error': errors.descricao}]">
                                <div v-if="errors.descricao">{{ errors.descricao[0] }}</div>
                                <input type="text" v-model="material.descricao" class="form-control" placeholder="Descrição">
                            </div>

                            <div :class="['col-auto', {'has-error': errors.forma_farmaceutica_id}]">
                                <div v-if="errors.forma_farmaceutica_id">{{ errors.forma_farmaceutica_id[0] }}</div>
                                <input type="text" v-model="material.forma_farmaceutica_id" class="form-control" placeholder="Forma">
                            </div>
                        
                            <div :class="['col-auto', {'has-error': errors.tipo_material_id}]">
                                <div v-if="errors.tipo_material_id">{{ errors.tipo_material_id[0] }}</div>
                                <input type="text" v-model="material.tipo_material_id" class="form-control" placeholder="Tipo">
                            </div>

                            <div :class="['col-auto', {'has-error': errors.status}]">
                                <div v-if="errors.status">{{ errors.status[0] }}</div>
                                <input type="text" v-model="material.status" class="form-control" placeholder="Status">
                            </div>
                        
                            <div :class="['col-auto', {'has-error': errors.valor_compra}]">
                                <div v-if="errors.valor_compra">{{ errors.valor_compra[0] }}</div>
                                <input type="text" v-model="material.valor_compra" class="form-control" placeholder="Valor compra">
                            </div>

                            <div :class="['col-auto', {'has-error': errors.valor_revenda}]">
                                <div v-if="errors.valor_revenda">{{ errors.valor_revenda[0] }}</div>
                                <input type="text" v-model="material.valor_revenda" class="form-control" placeholder="Valor revenda">
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
    data () {
        return {
            material: {
                sku: '',
                cod_barra: '',
                descricao: '',
                forma_farmaceutica_id: '',
                tipo_material_id: '',
                status: '',
                valor_compra: '',
                valor_revenda: ''
            },
            
            errors: {

            }
        }
    }
}
</script>

<style scoped>

</style>
