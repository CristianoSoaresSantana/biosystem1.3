<template>
    <div>
        <form class="form form-inline" @submit.prevent="buscar">
            <input type="text" v-model="filter" placeholder="Buscar" class="form-control mr-sm-2">
            <button type="submit" class="btn btn-outline-success">Buscar</button>
        </form>
    </div>
</template>

<script>
export default {
    data () {
        return {
            filter: ''
        }
    },

    methods: {
        buscar () {
            this.$emit('buscarFilial', this.filter)
        }
    }
}
</script>