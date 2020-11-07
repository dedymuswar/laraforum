<template>
    
</template>
<script>
export default {
    created(){
        console.log('logout');
        EventBus.$emit('logout')
    }
}
</script>

<style>

</style>