<template>
    <form :action="url" :method="getMethod" :id="id" :token="token" enctype="">
        <input type="hidden" name="_method" :value="getMethod">
        <input v-if="token" type="hidden" name="_token" :value="token">
        <slot></slot>
    </form>
</template>

<script>
export default {
    props:['id', 'url', 'token', 'method'],
    computed: {
        getMethod: function() {
            return this.method || "post";
        }
    }
}
</script>