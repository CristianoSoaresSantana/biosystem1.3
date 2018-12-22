<template>
  <div class="container">
    <h1>Detalhes do registro de compras</h1>
    <!-- informações gerais -->
    <div class="form-group row">
      <div class="col-sm-12">
            <ul style="width: 858px; height: 200px; overflow: auto">
                <li>
                    <strong>Num doc:</strong> {{ compra.num_doc }} <br>
                    <strong>Filial:</strong> {{ compra.filial.razao_social }} <br>
                    <strong>Fornecedor:</strong> {{ compra.fornecedor.razao_social }} <br>
                    <strong>Tipo de Movimento:</strong> {{ compra.tipo_movimento.tipo_movimentacao }} <br>
                    <strong>Valor do doc:</strong> {{ compra.valor_nota }} <br>
                    <strong>Data da compra:</strong> {{ $moment(compra.created_at).format('DD/MM/YYYY HH:mm', 'L') }} <br>
                    <strong>Data de Alteração:</strong> {{ $moment(compra.updated_at).format('DD/MM/YYYY HH:mm', 'L') }} <br>
                </li>
            </ul>
      </div>
    </div>
  </div>

</template>

<script>
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
        id: "",
        nome: "",
        cpf: "",
        celular: "",
        celular_recado: "",
        email: "",
        endereco: "",
        filial: Object,
        fornecedor: Object,
        tipo_movimento: Object
      }
    };
  },

  watch: {
    filho_compra() {
      this.compra = this.filho_compra;
    }
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
