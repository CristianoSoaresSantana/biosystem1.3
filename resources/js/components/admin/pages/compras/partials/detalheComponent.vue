<template>
  <div class="container">
    <h1>Detalhes do registro de compras numero {{ compra.num_doc }}</h1>
    <!-- informações gerais -->
    <div class="form-group row">
      <div class="col-sm-12">
            <ul style="width: 1150px; height: 70px; overflow: auto">
                <li>
                    <strong>Filial:</strong> {{ compra.filial.razao_social }},
                    <strong>Fornecedor:</strong> {{ compra.fornecedor.razao_social }},
                    <strong>Tipo de Movimento:</strong> {{ compra.tipo_movimento.tipo_movimentacao }},
                    <strong>Valor do doc:</strong> {{ compra.valor_nota }},
                    <strong>Data da compra:</strong> {{ $moment(compra.created_at).format('DD/MM/YYYY HH:mm', 'L') }},
                    <strong>Data de Alteração:</strong> {{ $moment(compra.updated_at).format('DD/MM/YYYY HH:mm', 'L') }}
                </li>
            </ul>
            <ul style="width: 1150px; height: 550px; overflow: auto">
                <h4>Itens do Registro {{ compra.num_doc }}</h4>
                <p>
                    Você pode excluir todos os itens desse registro! Essa ação vai dá baixa no estoque! Pois vc estará cançelando essa transação!<br>
                    <confirmDelete :resgistro="compra.num_doc" @destroy="destroy"/>
                </p>
                <li v-for="(itens, index) in compra.materials" :key="index">
                    <strong>Sku:</strong> {{itens.pivot["material_sku"]}},
                    <strong>Quantidade:</strong> {{itens.pivot["quantidade"]}},
                    <strong>Quantidade anterior:</strong> {{itens.pivot["quantidade_anterior"]}},
                    <strong>Lote:</strong> {{itens.pivot["lote"]}},
                    <strong>Valor unitario:</strong> {{itens.pivot["valor_unitario"]}},
                    <strong>Data Fabricacao:</strong> {{ $moment(itens.pivot["data_fabricacao"]).format('DD/MM/YYYY', 'L') }},
                    <strong>Data Vencimento:</strong> {{ $moment(itens.pivot["data_vencimento"]).format('DD/MM/YYYY', 'L') }}
                </li>
            </ul>
      </div>
    </div>
  </div>

</template>

<script>
import confirmDelete from "../../../layouts/confirmDeleteComponent";

export default {
  props: {
    filho_compra: {
      require: false,
      type: Object
    }
  },

  data() {
    return {
      compra: {
        num_doc: "",
        filial_id: "",
        fornecedor_id: "",
        tipo_mov_id: "",
        valor_nota: "",
        created_at: "",
        updated_at: "",
        filial: Object,
        fornecedor: Object,
        tipo_movimento: Object,
        materials: Array
      }
    };
  },

  watch: {
    filho_compra() {
      this.compra = this.filho_compra;
    }
  },

  methods: {
       destroy(num_doc) {
      this.$store
        .dispatch("compraMaterialDestroy", num_doc)
        .then(() => {
          this.$snotify.success("Registro Deletado!", "Sucesso");
        })
        .catch(errors => {
          this.$snotify.errors("Registro não pode ser Deletado!", "Fracasso");
        });
    }
  },

  components: {
    confirmDelete
  }
};
</script>

<style scoped>
* {font-family: "Times New Roman", Times, serif;}

h1 {
    text-align: center;
}

h4 {
    margin-top: 6px;
}

ul {
    background-color: rgb(177, 235, 152);
    margin-bottom: 2px;
    border-radius: 5px;
}

li {
    font-size: 15px;
}
</style>
