<template>
    <form method="POST" :action="action">
        <input type="hidden" name="_token" :value="csrf">
        <input type="hidden" name="_method" value="DELETE">
        <button type="submit" class="btn btn-danger btn-sm">
            <slot><span data-feather="x"></span></slot>
        </button>
    </form>
</template>

<script>
export default {
    mounted() {
        window.feather.replace();
        //console.log('Vue: DeleteButton Component mounted.');
    },
    data: function() {
        return {

        }
    },
    props: ['csrf', 'action']
}
</script>