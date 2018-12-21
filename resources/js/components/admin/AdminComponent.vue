<template>
  <div class="container">
    <div class="menu">
      <div class="logo">
        <img src="./images/farmaforma.jpeg" alt="Biosystem" class="logo-painel">
      </div>
      <div class="list-menu">
        <ul class="ul-menu">
          <li v-for="link in links" :key="link.name">
            <router-link :to="{name: link.name}" class="nav-link">{{link.title}}</router-link>
          </li>
        </ul>
      </div>
    </div>
    <div class="conteudo">
      <div class="top-dasboard">
        <div class="dropdown">
          <div
            class="dropdown-toggle"
            type="div"
            id="dropdownMenudiv"
            data-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false"
          >
            <strong>Usuário</strong>
          </div>
          <div class="dropdown-menu" aria-labelledby="dropdownMenudiv">
            <a class="dropdown-item" href="#">Perfil</a>
            <a class="dropdown-item" href="#">Sair</a>
          </div>
        </div>
      </div>
      <router-view></router-view>
    </div>
  </div>
</template>


<script>
export default {
  data() {
    return {
      links: [
        { name: "admin.dashboard", title: "Dashboard" },
        { name: "admin.entrada_nfe", title: "Entrada de Nfe" },
        { name: "admin.vendas", title: "Vendas"},

        { name: "admin.usuarios", title: "Usuários" },
        { name: "admin.clientes", title: "Clientes" },
        { name: "admin.branches", title: "Filiais" },
        { name: "admin.fornecedors", title: "Fornecedores" },

        { name: "admin.materials", title: "Materiais" },

        { name: "admin.setors", title: "Setores" },
        { name: "admin.tipo_movimentos", title: "Tipos Movimentos" },
        { name: "admin.forma_pagtos", title: "Formas Pagamentos" },
        { name: "admin.tipo_materials", title: "Tipos de Material" },
        { name: "admin.forma_farmaceuticas", title: "Formas Farmacêuticas" }
      ]
    };
  }
};
</script>

<style scoped>
* {
  margin: 0px;
  padding: 0px;
  font-family: "Open Sans";
}
.container {
  max-width: 1680px;
  max-height: 1050px;
}
.menu {
  background: #2e9133;
  float: left;
  padding: 0px;
  width: 199px;
  text-align: center;
  min-height: 100vh;
}
.logo {
  float: center;
}
img.logo-painel {
  max-width: 198px;
  max-height: 198px;
  margin-top: 39px;
}
.list-menu {
  float: left;
  width: 100%;
  margin-top: 10px;
}
ul.ul-menu {
  list-style: none;
}
ul.ul-menu li {
  float: left;
}
ul.ul-menu li a {
  font-size: 1.4em;
  margin: 3px 7px;
  float: left;
  width: 186px;
  color: #ffffff;
  border-bottom: 1px solid #365070;
  border-left: 1px solid #365070;
}
.conteudo {
  float: left;
  background: #e3ebe4;
  min-height: 100vh;
  width: calc(100% - 199px);
}
.top-dasboard {
  width: 100%;
  float: left;
  background: #2e9133;
  padding: 8px;
}
.dropdown {
  float: right;
}
</style>

