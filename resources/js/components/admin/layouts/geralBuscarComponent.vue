<template>
    <div>
        <form class="form form-inline" @submit.prevent="layoutBuscar">
            <input type="text" v-model="inputBuscar" placeholder="Buscar" class="form-control mr-sm-2">
            <button type="submit" class="btn btn-outline-success">Buscar</button>
        </form>
    </div>
</template>

<script>
export default {
    data () {
        return {
            // o inputBuscar é a var que guarda o input do campo buscar!
            inputBuscar: ''
        }
    },

    methods: {
        // nome desta var representa o path do component! ex layout.buscarComponent
        layoutBuscar () {
            this.$emit('layoutBuscar', this.inputBuscar)
        }
    }
}
</script>