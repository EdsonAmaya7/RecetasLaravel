<template>
 <span v-text="formatearFecha" >Esto es visibre</span>
</template>

<script>
    export default{
        props: ['fecha'],
        // mounted() {
        //     console.log('componente listo', this.fecha);
        // },
        computed: {
            formatearFecha(){

                return moment(this.fecha).locale('es').format('DD [de] MMMM [del] YYYY');

            }
        }
    }
</script>