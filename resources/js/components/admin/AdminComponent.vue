<template>
    <div>
        <ul class="nav bg-dark">
            <li class="nav-item">
                <router-link :to="{name: 'admin.dashboard'}" class="nav-link">Dashboard</router-link> 
            </li>
            <li>
                <router-link :to="{name: 'admin.filials'}"  class="nav-link">Filiais</router-link>
            </li>
        </ul>
        <div class="container"> <router-view></router-view> </div>
    </div>
</template>


<script>
export default {

}
</script>

<style>

</style>

