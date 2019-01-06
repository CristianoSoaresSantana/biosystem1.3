<template>
    <div>
    <h4 class="heading"><strong>{{ title }}</strong></h4>
    <form class="form" @submit.prevent="onSubmit">
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="Sku">Sku</label>
                <span class="has-error" v-if="errors['material_sku']">{{ errors['material_sku'] }}</span>
                <input class="form-control" id="Sku" type="text" v-model="estoque.material_sku" placeholder="material_sku" size="10" disabled="disabled">
            </div>
            <div class="form-group col-md-4">
                <label for="">CurvaABC</label>
                <span class="has-error" v-if="errors['curvaABC']">{{ errors['curvaABC'] }}</span>
                <input class="form-control" id="" type="text" v-model="estoque.curvaABC" placeholder="curvaABC" size="10">
            </div>
            <div class="form-group col-md-4">
                <label for="">Comissão</label>
                <span class="has-error" v-if="errors['comissao']">{{ errors['comissao'] }}</span>
                <input class="form-control" id="" type="text" v-model="estoque.comissao" placeholder="comissao" size="10">
            </div>
            <div class="form-group col-md-4">
                <label for="">Valor Venda</label>
                <span class="has-error" v-if="errors['valor_venda']">{{ errors['valor_venda'] }}</span>
                <input class="form-control" id="" type="text" v-model="estoque.valor_venda" placeholder="valor_venda" size="10">
            </div>
            <div class="form-group col-md-4">
                <label for="">Quant Max</label>
                <span class="has-error" v-if="errors['max']">{{ errors['max'] }}</span>
                <input class="form-control" id="" type="text" v-model="estoque.max" placeholder="Quant Maxima" size="10">
            </div>
            <div class="form-group col-md-4">
                <label for="">Quant Min</label>
                <span class="has-error" v-if="errors['min']">{{ errors['min'] }}</span>
                <input class="form-control" id="" type="text" v-model="estoque.min" placeholder="Quant Minima" size="10">
            </div>
                <div class="form-group col-md-4">
                <label for="">Status</label>
                <span class="has-error" v-if="errors['status']">{{ errors['status'] }}</span>
                <input class="form-control" id="" type="text" v-model="estoque.status" placeholder="status" size="10">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Confirmar</button>
    </form>
    </div>
</template>

<script>
export default {
    props: {
        title: {
            require: true,
            type: String
        },

        filho_estoque: {
            require: true,
            type: Object
        },

        filho_errors: {}
    },

    created() {

    },

    data() {
        return {
            estoque: {},
            errors: {}
        }
    },

    computed: {
    },

    watch: {
        filho_errors() {
            this.errors = this.filho_errors;
        },

        filho_estoque() {
            this.estoque = this.filho_estoque
        }
    },

    methods: {
    onSubmit() {
        this.$store.dispatch('updateBrancheMaterial', this.estoque)
        .then(() => {
            // notificação para usuario.
            this.$snotify.success("Ação realizada com sucesso!", "Parabéns...");
            this.$emit("success");
            this.inputs = [];
        })
        .catch(errors => {
            // notificação para usuario.
            this.$snotify.error("Você Errou!", "Atenção");
            this.errors = errors.response.data.errors;
        });
    },
}
}
</script>

<style scoped>
.has-error {
  color: red;
}
</style>

