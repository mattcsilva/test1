<template>
    <div class="container pb-3">
        <button type="button" class="btn btn-primary" data-toggle="modal" :data-target="'#' + target">{{name}}</button>
    </div>
</template>

<script>
export default {
    props:['target', 'name']
}
</script>