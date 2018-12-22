<template>
  <div class="container">
    <h1>Detalhes do fornecedor {{fornecedors.razao_social}}</h1>
    <!-- informações gerais -->
    <div class="form-group row">
      <div class="col-sm-12">
            <ul style="width: 858px; height: 40px; overflow: auto">
                <li>
                    <strong>ID:</strong> {{ fornecedors.id }}, <strong>Razão Social:</strong> {{ fornecedors.razao_social }},
                     <strong>CNPJ:</strong> {{ fornecedors.cnpj }}
                </li>
            </ul>
            <ul style="width: 858px; height: 250px; overflow: auto">
                <li><h4>Materiais fornecidos por {{fornecedors.razao_social}}</h4>
                    <ul v-for="materials in fornecedors.materials" :key="materials.sku">
                        <strong>SKU</strong> {{materials.sku}}, <strong>Codigo de barras</strong> {{materials.cod_barra}}
                        <strong>Descrição</strong> {{materials.descricao}}, <strong>Status</strong> {{materials.status}}
                    </ul>
                </li>
            </ul>
      </div>
    </div>
  </div>

</template>

<script>
export default {
  props: {
    filho_fornecedor: {
      require: false,
      type: Object
    }
  },

  data() {
    return {
      fornecedors: {
        id: "",
        razao_social: "",
        cnpj: "",
        materials: Object
      }
    };
  },

  watch: {
    filho_fornecedor() {
      this.fornecedors = this.filho_fornecedor;
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
