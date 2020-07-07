<template>
    <button type="button" class="btn btn-primary" data-toggle="modal" :data-target="'#' + target">{{name}}</button>
</template>

<script>
export default {
    props:['target', 'name']
}
</script>