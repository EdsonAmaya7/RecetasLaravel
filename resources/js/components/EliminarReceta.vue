<template>
    <input
        type="submit"
        class="w-100 btn btn-danger mb-1 d-block"
        value="Elminar ⛌"
        @click="eliminarReceta"
    />
</template>
// v-on:click escucha por el metodo o evento eliminarReceta //v-on:click =
"eliminarReceta" o @click
<script>
export default {
    props: ["recetaId"],
    //     mounted() {
    //             console.log("receta actua", this.recetaId);
    //     },
    methods: {
        eliminarReceta() {
            this.$swal({
                title: "¿Deseas eliminar esta receta?",
                text: "una vez eliminada, no se puede recuperar",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "si!",
                cancelButtonText: "no",
            }).then((result) => {
                if (result.isConfirmed) {
                    //enviar una peticion al servidor
                    const params = {
                        id: this.recetaId,
                    };

                    axios
                        .post(`recetas/${this.recetaId}`, {
                            params,
                            _method: "delete",
                        })
                        .then((respuesta) => {
                            this.$swal({
                                title: "Receta Eliminada!",
                                text: "Se eliminó la receta.",
                                icon: "success",
                            });

                        //eliminar el elemento del DOM
                        this.$el.parentNode.parentNode.parentNode.removeChild(this.$el.parentNode.parentNode)
                        })
                        .catch((error) => {
                            console.log(error);
                        });
                }
            });
        },
    },
};
</script>
