<template>

<div>

  <span class="like-btn" @click="likeReceta"></span>

</div>

</template>

<script>
export default {
  props: ['recetaId'],
  methods: {
    likeReceta(){
      axios.post('/public/recetas/' + this.recetaId)
      .then(respuesta => {
        console.log(respuesta)
      })
      .catch(error =>{
        console.log(error)
      });
    }
  },
}
</script>