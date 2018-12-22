<template>
  <div class="container">
    <h1>Detalhes do Setor {{ setors.setor }}</h1>
    <!-- informações gerais -->
    <div class="form-group row">
      <div class="col-sm-12">
            <ul style="width: 550px; height: 400px; overflow: auto">
                <h4>Funcionários do Setor</h4>
                <li v-for="user in setors.users" :key="user.id"><strong>Nome:</strong> {{ user.name }}</li>
            </ul>
      </div>
    </div>
  </div>

</template>

<script>
export default {
  props: {
    filho_setor: {
      require: false,
      type: Object
    }
  },

  data() {
    return {
      setors: {
        id: "",
        setor: "",
        users: Object
      }
    };
  },

  watch: {
    filho_setor() {
      this.setors = this.filho_setor;
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
