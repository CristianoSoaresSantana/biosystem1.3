<template>
    <div>
        <div class="container">
            <h1>Detalhes do Registro</h1>
            <div class="form-group row">
                <div class="col-sm-12">
                    <ul style="width: 530px; height: 200; overflow: auto">
                        <li>
                            <strong>sku: </strong>{{estoque.material_sku}}<br>
                            <strong>Curva abc: </strong>{{estoque.curvaABC}}<br>
                            <strong>Comissão: </strong>{{estoque.comissao}}<br>
                            <strong>Valor de venda: </strong>{{estoque.valor_venda}}<br>
                            <strong>Quant. Máxima: </strong>{{estoque.max}}<br>
                            <strong>Quant. Minima: </strong>{{estoque.min}}<br>
                            <strong>Status: </strong>{{estoque.status}}<br>
                            <strong>Data da Inclusão:</strong> {{ $moment(estoque.created_at).format('DD/MM/YYYY HH:mm', 'L') }} <br>
                            <strong>Data da ultima Alteração:</strong> {{ $moment(estoque.updated_at).format('DD/MM/YYYY HH:mm', 'L') }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        filho_estoque: {
            require: true,
            type: Object
        }
    },

    data() {
        return {
            estoque: {},
        }
    },

    watch: {
        // este metodo escuta a props. filho.estoque e atribui a data.estoque!
        filho_estoque () {
            this.estoque = this.filho_estoque;
        }
    }
}
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
