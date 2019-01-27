<template>
  <div class="container">
    <h1>Detalhes do usuário {{ usuarios.name }}</h1>
    <!-- informações gerais -->
    <div class="form-group row">
      <div class="col-sm-12">
            <ul style="width: 858px; height: 150px; overflow: auto">
                <li>
                    <strong>ID:</strong> {{ usuarios.id }},
                    <strong>Nome:</strong> {{ usuarios.name }} <br>
                    <strong>CPF:</strong> {{usuarios.cpf}},
                    <strong>Data Nascimento:</strong> {{ usuarios.data_nascimento }} <br>
                    <strong>Celular:</strong> {{ usuarios.celular }},
                    <strong>Celular para recados:</strong> {{ usuarios.celular_recado }} <br>
                    <strong>E-Mail:</strong> {{ usuarios.email }},
                    <strong>Endereço:</strong> {{ usuarios.endereco }} <br>
                    <strong>Setor:</strong> {{ usuarios.setor.setor }},
                    <strong>Filial:</strong> {{ usuarios.filial.razao_social }} <br>
                    <strong>Permissão de acesso:</strong> {{ usuarios.permissao }},
                    <strong>Status:</strong> {{ usuarios.status }} <br>

                </li>
            </ul>

            <ul style="width: 858px; height: 300px; overflow: auto">
                <h4>Ultimas Vendas</h4>
                <li v-for="venda in usuarios.vendas" :key="venda.id">
                    <strong>ID:</strong> {{ venda.id }},
                    <strong>Valor total:</strong> {{venda.valor_total}},
                    <strong>Data da compra:</strong> {{ $moment(venda.created_at).format('DD/MM/YYYY HH:mm', 'L') }} <br>
                </li>
            </ul>
      </div>
    </div>
  </div>

</template>

<script>
export default {
  props: {
    filho_usuario: {
      require: false,
      type: Object
    }
  },

  data() {
    return {
      usuarios: {
        id: "",
        name: "",
        data_nascimento: "",
        email: "",
        cpf: "",
        celular: "",
        celular_recado: "",
        endereco: "",
        status: "",
        permissao: "",
        vendas: Object,
        filial: Object,
        setor: Object
      }
    };
  },

  watch: {
    filho_usuario() {
      this.usuarios = this.filho_usuario;
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
