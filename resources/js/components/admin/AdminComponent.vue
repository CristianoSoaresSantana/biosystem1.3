<template>
    <div>
        <ul>
            <li>
                <router-link :to="{name: 'admin.dashboard'}">Dashboard</router-link> 
            </li>
            <li>
                <router-link :to="{name: 'admin.filials'}">Filiais - Total de Filiais {{totalFilials}}</router-link>
            </li>
        </ul>

        <router-view></router-view>
    </div>
</template>


<script>
export default {
    computed: {
        totalFilials () {
            return this.$store.state.filials.itens.data.length
        }
    }
}
</script>

<style>

</style>

