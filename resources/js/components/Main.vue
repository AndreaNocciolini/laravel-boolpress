<template>
    <div class="row row-cols-4 g-3 p-3">
        <div class="col" v-for="(post, index) in cards.posts" :key="index">
                <div class="card h-100">
                <img v-if="post.image" :src="'/storage/' + post.image" class="card-img-top" :alt="post.title">
                <div class="card-body">
                    <h3 class="card-title">{{ post.title }}</h3>
                    <p class="card-text">{{ post.content }}</p>
                    <router-link class="nav-link" :to="{ name: 'post', params: { id: post.id } }">Details</router-link>
                </div>
            </div>
        </div>
        <div v-if="cards.prev_page || cards.next_page" class="row w-100 justify-content-around mt-3 mb-1">
            <div class="col-2 d-flex justify-content-around">
                <button v-if="cards.prev_page" class="btn btn-success" @click="changePage('prev_page')">Prev</button>
                <button v-if="cards.next_page" class="btn btn-success" @click="changePage('next_page')">Next</button>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    name:"Main",
    props: ['cards'],
    methods: {
        changePage(pageUrl){
            this.$emit('changePage', pageUrl)
        }
    }
}
</script>

<style>

</style>