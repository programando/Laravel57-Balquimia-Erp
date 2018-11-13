<template>
</template>

<script >
    export default {
        created(){
            this.CerrarSistema();
        },
        methods:{
              CerrarSistema(){
                axios.get('/logout')
                .then( response =>{
                    window.location.href = '/';
                  })
              }
        }
    };
</script>
