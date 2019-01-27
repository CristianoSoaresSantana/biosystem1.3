<template>
  <div class="container">
    <h1>Detalhes da Filial {{ branche.razao_social }}</h1>
    <!-- informações gerais -->
    <div class="form-group row">
      <div class="col-sm-12">
            <ul style="width: 858px; height: 100px; overflow: auto">
                <h4>Funcionários desta Filial</h4>
                <li v-for="user in branche.users" :key="user.id"><strong>Nome:</strong> {{ user.name }}</li>
            </ul>
            <ul style="width: 858px; height: 290px; overflow: auto">
                <h4>Ultimas Entradas</h4>
                <li v-for="compra in branche.compras" :key="compra.num_doc">
                    <strong>Num_doc:</strong> {{compra.num_doc}},
                    <strong>Valor da Nota:</strong> {{compra.valor_nota}},
                    <strong>Data de Entrada:</strong> {{ $moment(compra.created_at).format('DD/MM/YYYY HH:mm', 'L') }},
                    <strong>Data de Alteração:</strong> {{ $moment(compra.updated_at).format('DD/MM/YYYY HH:mm', 'L') }}
                </li>
            </ul>
            <ul style="width: 858px; height: 290px; overflow: auto">
                <h4>Ultimas Saidas</h4>
                <li v-for="venda in branche.vendas" :key="venda.num_doc">
                    <strong>ID:</strong> {{venda.id}},
                    <strong>Status:</strong> {{venda.status}},
                    <strong>Valor Total:</strong> {{venda.valor_total}},
                    <strong>Data da Venda:</strong> {{ $moment(venda.created_at).format('DD/MM/YYYY HH:mm', 'L') }},
                    <strong>Data de Alteração:</strong> {{ $moment(venda.updated_at).format('DD/MM/YYYY HH:mm', 'L') }}
                </li>
            </ul>
      </div>
    </div>
  </div>

</template>

<script>
export default {
  props: {
    filho_branche: {
      require: false,
      type: Object
    }
  },

  data() {
    return {
      branche: {
        id: "",
        razao_social: "",
        cnpj: "",
        users: Object,
        vendas: Object,
        compras: Object
      }
    };
  },

  watch: {
    filho_branche() {
      this.branche = this.filho_branche;
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
