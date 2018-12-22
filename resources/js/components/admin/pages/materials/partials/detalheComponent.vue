<template>
    <div>
        <div class="container">
            <h1>Detalhes do material {{materials.descricao}}</h1>
            <div class="form-group row">
                <div class="col-sm-12">
                    <ul style="width: 530px; height: 200; overflow: auto">
                        <li>
                            <strong>sku: </strong>{{materials.sku}}<br>
                            <strong>Codigo de Barra: </strong>{{materials.cod_barra}}<br>
                            <strong>Descrição: </strong>{{materials.descricao}}<br>
                            <strong>Tipo: </strong>{{materials.tipo_material.tipo_material}}<br>
                            <strong>Forma: </strong>{{materials.forma_farmaceutica.forma_farmaceutica}}<br>
                            <strong>Status: </strong>{{materials.status}}<br>
                            <strong>Valor Compra: </strong>{{materials.valor_compra}}<br>
                            <strong>Valor Revenda: </strong>{{materials.valor_revenda}}
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
        filho_materials: {
            require: true,
            type: Object
        }
    },

    data() {
        return {
            materials: {
                sku: "",
                cod_barra: "",
                descricao: "",
                forma_farmaceutica_id: "",
                tipo_material_id: "",
                status: "ativo",
                valor_compra: "",
                valor_revenda: "",
                tipo_material: Object,
                forma_farmaceutica: Object
                // image: '',
            }
        }
    },

    watch: {
        // este metodo escuta a props. filho.materials e atribui a data.materials!
        filho_materials () {
            this.materials = this.filho_materials;
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
