<template>
    <div>
        <div class="menu">
            <div class="logo">
                <img src="./images/farmaforma.jpeg" alt="Biosystem" class="logo-painel">
            </div>
            <div class="list-menu">
                <ul class="ul-menu">
                    <li>
                        <router-link :to="{name: 'admin.dashboard'}" class="nav-link">Dashboard</router-link>
                    </li>

                    <li>
                        <router-link :to="{name: 'admin.branches'}"  class="nav-link">Filiais</router-link>
                    </li>

                    <li>
                        <router-link :to="{name: 'admin.fornecedors'}"  class="nav-link">Fornecedores</router-link>
                    </li>

                    <li>
                        <router-link :to="{name: 'admin.materials'}"  class="nav-link">Materiais</router-link>
                    </li>

                    <li>
                        <router-link :to="{name: 'admin.tipo_materials'}"  class="nav-link">Tipo de Materiais</router-link>
                    </li>

                    <li>
                        <router-link :to="{name: 'admin.forma_farmaceuticas'}"  class="nav-link">Forma Farmaceutica</router-link>
                    </li>
                </ul>
                </div>
        </div>
        <div class="container">
            <div class="top-dasboard">
                <div class="dropdown">
                    <div class="dropdown-toggle" type="div" id="dropdownMenudiv" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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

}
</script>

<style scoped>

*{margin: 0px; padding: 0px; font-family: "Open Sans";}
.menu{
    background: #2e9133;
    float: left;
    padding: 0px;
    width: 180px;;
    text-align: center;
    min-height: 100vh;
}
.logo{
    float: center;
}
img.logo-painel{
    max-width: 179px;
    max-height: 179px;
    margin-top: 39px;
}
.list-menu{
    float: left;
    width: 100%;
    margin-top: 10px;
}
ul.ul-menu{
    list-style: none;
}
ul.ul-menu li{
    float: left;
}
ul.ul-menu li a {
    font-size: 1.4em;
    margin: 3px 7px;
    float: left;
    width: 167px;
    color: #ffffff;
}
.container {
    float: left;
    background: #ffffff;
    min-height: 100vh;
    width: calc(100% - 90px);
}
.top-dasboard{
    width: 100%;
    float: left;
    background: #2e9133;
    padding: 8px;
}
.dropdown {
    float: right;
}
</style>

