<template>
  <div class="container">
    <h1>Detalhes do registro de vendas</h1>
    <!-- informações gerais -->
    <div class="form-group row">
      <div class="col-sm-12">
            <ul style="width: 858px; height: 400px; overflow: auto">
                <li>
                    <strong>ID:</strong> {{ venda.id }} <br>
                    <strong>Filial:</strong> {{ venda.filial.razao_social }} <br>
                    <strong>Usuario:</strong> {{ venda.user.name }} <br>
                    <strong>Cliente:</strong> {{ venda.cliente.nome }} <br>
                    <strong>Tipo de Movimento:</strong> {{ venda.tipo_movimento.tipo_movimentacao }} <br>
                    <strong>Valor Total:</strong> {{ venda.valor_total }} <br>
                    <strong>Data da venda:</strong> {{ $moment(venda.created_at).format('DD/MM/YYYY HH:mm', 'L') }} <br>
                    <strong>Data de Alteração:</strong> {{ $moment(venda.updated_at).format('DD/MM/YYYY HH:mm', 'L') }} <br>
                </li>

                <h4>Itens do Registro</h4>
                <li v-for="(itens, index) in venda.materials" :key="index">
                    <strong>Sku:</strong> {{itens.pivot["material_sku"]}},
                    <strong>Quantidade:</strong> {{itens.pivot["quantidade"]}},
                    <strong>Valor unitario:</strong> {{itens.pivot["valor_unitario"]}},
                </li>
            </ul>
      </div>
    </div>
  </div>

</template>

<script>
export default {
  props: {
    filho_venda: {
      require: false,
      type: Object
    }
  },

  data() {
    return {
      venda: {
        id: "",
        filial_id: "",
        cliente_id: "",
        user_id: "",
        tipo_mov_id: "",
        status: "",
        user: Object,
        filial: Object,
        cliente: Object,
        tipo_movimento: Object,
        materials: Object
      }
    };
  },

  watch: {
    filho_venda() {
      this.venda = this.filho_venda;
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
