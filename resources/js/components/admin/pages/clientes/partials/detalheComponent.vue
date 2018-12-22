<template>
  <div class="container">
    <h1>Detalhes do {{ cliente.nome }}</h1>
    <!-- informações gerais -->
    <div class="form-group row">
      <div class="col-sm-12">
            <ul style="width: 858px; height: 150px; overflow: auto">
                <li v-modal="cliente in cliente" :key="cliente.id">
                    <strong>Nome:</strong> {{ cliente.nome }} <br>
                    <strong>Celular:</strong> {{ cliente.celular }} <br>
                    <strong>Celular para recados:</strong> {{ cliente.celular_recado }} <br>
                    <strong>E-Mail:</strong> {{ cliente.email }} <br>
                    <strong>Endereço:</strong> {{ cliente.endereco }}
                </li>
            </ul>

            <ul style="width: 858px; height: 300px; overflow: auto">
                <h4>Ultimas Compras</h4>
                <li v-for="venda in cliente.vendas" :key="venda.id">
                    <strong>ID:</strong> {{ venda.id }} <br>
                    <strong>Valor total:</strong> {{venda.valor_total}} <br>
                    <strong>Data da compra:</strong> {{ $moment(venda.created_at).format('DD/MM/YYYY HH:mm', 'L') }} <br>
                    <strong>Data de Alteração:</strong> {{ $moment(venda.updated_at).format('DD/MM/YYYY HH:mm', 'L') }} <br>
                </li>
            </ul>
      </div>
    </div>
  </div>

</template>

<script>
export default {
  props: {
    filho_cliente: {
      require: false,
      type: Object
    }
  },

  data() {
    return {
      cliente: {
        id: "",
        nome: "",
        cpf: "",
        celular: "",
        celular_recado: "",
        email: "",
        endereco: "",
        vendas: Object
      }
    };
  },

  watch: {
    filho_cliente() {
      this.cliente = this.filho_cliente;
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
