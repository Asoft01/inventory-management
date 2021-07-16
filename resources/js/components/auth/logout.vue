<template>
    
</template>

<script>
export default {
    created(){
        localStorage.removeItem('token');
        localStorage.removeItem('user');
        Toast.fire({
            icon:'success',
            title: 'Logout Successfully'
        })

        this.$router.push({name: '/'});
    }    
}
</script>

<style type="text/css">
    
</style>