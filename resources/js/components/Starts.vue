<template>
    <div class="text-xs-center" >
        <v-rating v-if="(ratingable === 'true' || ratingable === true)" hover size="17px" color="orange" background-color="orange lighten-3" v-model="rating"></v-rating>
        <v-rating v-else readonly hover size="17px" color="orange" background-color="orange lighten-3" v-model="rating"></v-rating>
        <span v-if="Number(rating) >= 5" class="text-success">Recomendado</span>
    </div>
</template>

<script>
    export default {
        props: ['doctor', 'rating', 'ratingable'],
        data: ()=> ({

        }),
        methods: {

        },
        watch: {
            rating: async function (val){
                let response = await window.axios.post('/doctors/setRating',{
                    rating: val,
                    doctor: this.doctor

                });
                console.log(response.data);
            }
        },
        mounted() {

        }
    }
</script>

<style scoped>

</style>
