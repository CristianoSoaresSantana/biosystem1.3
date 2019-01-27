<template>
    <div>
    <h4 class="heading"><strong>{{ title }}</strong></h4>
        <div class="col-md-6">
            <select class="custom-select" v-model="filial_id" >
                <option value>Selecione uma Filial</option>
                <option v-for="branche in branches" :key="branche.id" :value="branche.id" >{{branche.razao_social}}</option>
            </select>
            <button @click="addRow" :disabled="ativarBottun"><span>Adicionar Linhas</span></button>
        </div>
    <form class="form" @submit.prevent="onSubmit">
      <p>Adicione linhas a medida que você precisar! Não deixe linhas em branco.</p>
        <ul>
            <li v-for="(input, index) in inputs" :key="input.push">
                <span class="has-error" v-if="errors[index +'.material_sku']">{{ errors[index +'.material_sku'] }}</span>
                <input type="text" v-model="input.material_sku" placeholder="material_sku" size="10">

                <span class="has-error" v-if="errors[index +'.curvaABC']">{{ errors[index +'.curvaABC'] }}</span>
                <input type="text" v-model="input.curvaABC" placeholder="curvaABC" size="10">

                <span class="has-error" v-if="errors[index +'.comissao']">{{ errors[index +'.comissao'] }}</span>
                <input type="text" v-model="input.comissao" placeholder="comissao" size="10">

                <span class="has-error" v-if="errors[index +'.valor_venda']">{{ errors[index +'.valor_venda'] }}</span>
                <input type="text" v-model="input.valor_venda" placeholder="valor_venda" size="10">

                <span class="has-error" v-if="errors[index +'.min']">{{ errors[index +'.min'] }}</span>
                <input type="text" v-model="input.min" placeholder="Quant Minima" size="10">

                <span class="has-error" v-if="errors[index +'.max']">{{ errors[index +'.max'] }}</span>
                <input type="text" v-model="input.max" placeholder="Quant Maxima" size="10">

                <span class="has-error" v-if="errors[index +'.status']">{{ errors[index +'.status'] }}</span>
                <input type="text" v-model="input.status" placeholder="status" size="10">
                <button type="button" @click="deleteRow(index)"><span>Remover Linha</span></button>
            </li>
        </ul>
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

        estoque: {
            require: true,
            type: Object
        },

        filho_errors: {}
    },

    created() {

    },

    data() {
        return {
            ativarBottun: true,
            filial_id: '',
            inputs: [],
            errors: {}
        }
    },

    computed: {
        // Esse metodo popular o select.
        branches() {
            return this.$store.state.branches.itens;
        },
    },

    watch: {
        filial_id() {
            this.ativarBottun = false
        },

        filho_errors() {
            this.errors = this.filho_errors;
        },
    },

    methods: {
        onSubmit() {
            this.$store.dispatch('storeBrancheMaterial', this.inputs)
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

        addRow() {
            this.inputs.push({
                filial_id: this.filial_id,
                material_sku:'',
                curvaABC:'',
                comissao:'',
                valor_venda:'',
                max:'',
                min:'',
                status:''
            })
        },
        deleteRow(index) {
            this.inputs.splice(index,1)
        }
}
}
</script>

<style scoped>
.has-error {
  color: red;
}
</style>
