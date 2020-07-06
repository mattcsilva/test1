<template>
    <form :action="url" method="post" :id="id" :token="token">
        <input type="hidden" name="_method" value="post">
        <input v-if="token" type="hidden" name="_token" :value="token">
        <slot></slot>
    </form>
</template>

<script>
export default {
    props:['id', 'url', 'token']
}
</script>