<template>
    <div>
        <span
            class="like-btn"
            @click="likeReceta"
            :class="{ 'like-active': isActive }"
        ></span>

        <p>{{ cantidadLikes }} Les gustó esta receta</p>
    </div>
</template>

<script>
export default {
    props: ["recetaId", "like", "likes"],
    data: function () {
        return {
            isActive: this.like,
            totalLikes: this.likes,
        };
    },
    methods: {
        likeReceta() {
            axios.post(this.recetaId)
                .then((respuesta) => {
                    if (respuesta.data.attached.length > 0) {
                        this.$data.totalLikes++;
                    } else {
                        this.$data.totalLikes--;
                    }

                    this.isActive = !this.isActive;
                })
                .catch((error) => {
                    if (error.response.status === 401) {
                        window.location.href = "/recetaslaravel/public/login";
                    }
                });
        },
    },
    computed: {
        cantidadLikes: function () {
            return this.totalLikes;
        },
    },
};
</script>
