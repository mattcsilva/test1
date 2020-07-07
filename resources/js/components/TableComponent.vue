<template>
    <div class="container">
        <div class="row" :style="habilitaSearch">
            <div class="col-3">
                <button-open-modal-component target="adicionar" name="Adicionar"></button-open-modal-component>
            </div>
            <div class="col">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="search_vendedor_id" name="vendedor_id" placeholder="Insira a ID de um vendedor..." style="width: auto; display: inline;" v-model="vendedor_id">
                    <div class="input-group-append">
                      <button type="button" class="btn btn-primary input-group-text" @click="carregaItems()">Buscar</button>
                    </div>
                </div>
            </div>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col" v-for="col in cols" :key="col">{{col}}</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in itemsTable" :key="item.ID">
                    <th scope="row" v-for="i in item" :key="i">{{i}}</th>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        props: ['cols', 'items', 'search'],
        data: function() {
            return {
                itemsTable: this.items || [],
                vendedor_id: ""
            }
        },
        methods: {
            carregaItems:function() {
                axios.get(`/admin/vendas/vendedors/${this.vendedor_id}`).then(res => {
                    if(res.status == 200)
                        this.itemsTable = res.data;
                    else
                        this.itemsTable = [];
                }).catch(function(e){
                    alert(e);
                });
            }
        },
        computed: {
            habilitaSearch: function() {
                if(this.search)
                    return "display: flex";

                return "display: none";
            }
        }
    }

</script>
