<template>
    <div class="container">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col" v-for="col in cols" :key="col">{{col}}</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in items" :key="item.ID">
                    <th scope="row" v-for="i in item" :key="i">{{i}}</th>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        props: ['cols', 'items'],
    }

</script>
