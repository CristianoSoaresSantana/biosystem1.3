<template>
    <div>
    <h2>Informe os produtos da nota {{ this.num_documento }}</h2>
    <button @click="addRow"><span>Adicionar Linhas</span></button>
    <form class="form" @submit.prevent="onSubmit">
      <p>Adicione linhas a medida que você precisar! Não deixe linhas em branco.</p>
      <ul>
        <li v-for="(input, index) in inputs" :key="input.push">
          <input type="text" v-model="input.material_sku" placeholder="sku" size="8">
          <input type="text" v-model="input.quantidade" placeholder="quantidade" size="8">
          <input type="text" v-model="input.valor_unitario" placeholder="valor" size="8">
          <input type="text" v-model="input.lote" placeholder="lote" size="8">
          <input type="text" v-model="input.data_fabricacao" placeholder="data_fabricacao" size="12">
          <input type="text" v-model="input.data_vencimento" placeholder="data_vencimento" size="12">
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
        num_docUltimoCreate: {}
    },

    created() {
        this.loadCompraMaterialIndex();
    },

    data() {
        return {
            num_documento: "",
            inputs: []
        }
    },

    computed: {
        compraMaterialIndex() {
            return this.$store.state.compra_itens.itens.data;
        }
    },

    watch: {
        num_docUltimoCreate () {
            this.num_documento = this.num_docUltimoCreate;
            this.inputs = [];
        }
    },

    methods: {
        loadCompraMaterialIndex() {
            this.$store.dispatch("compraMaterialIndex");
        },

        onSubmit() {
            this.$store
            .dispatch('compraMaterialStore', this.inputs)
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
                compra_num_doc: this.num_documento,
                material_sku: '',
                quantidade: '',
                valor_unitario: '',
                lote: '',
                data_fabricacao: '',
                data_vencimento: ''
            })
        },

        deleteRow(index) {
            this.inputs.splice(index,1)
        }
}
}
</script>

