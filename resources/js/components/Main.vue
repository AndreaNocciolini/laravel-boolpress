<template>
    <div class="row row-cols-4 g-3 p-3">
        <div class="col" v-for="(post, index) in posts" :key="index">
                <div class="card h-100">
                <img v-if="post.image" :src="post.image" class="card-img-top" :alt="post.title">
                <div class="card-body">
                    <h3 class="card-title">{{ post.title }}</h3>
                    <p class="card-text">{{ post.content }}</p>
                </div>
                <!-- <ul class="list-group list-group-flush">
                    <li class="list-group-item">An item</li>
                    <li class="list-group-item">A second item</li>
                    <li class="list-group-item">A third item</li>
                </ul>
                <div class="card-body">
                    <a href="#" class="card-link">Card link</a>
                    <a href="#" class="card-link">Another link</a>
                </div> -->
            </div>
        </div>
    </div>
</template>

<script>
import Axios from 'axios';

export default {
    name:"Main",
    data(){
        return {
            posts: [],
        }
    },
    created() {
        Axios.get('http://127.0.0.1:8000/api/posts')
             .then((result) =>
                this.posts = result.data.result.posts
             )
             .catch()

    }
}
</script>

<style>

</style>