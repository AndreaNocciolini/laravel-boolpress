<template>
    <div class="row row-cols-4 g-3 p-3">
        <div class="col" v-for="(post, index) in posts" :key="index">
                <div class="card h-100">
                <img v-if="post.image" :src="'/storage/' + post.image" class="card-img-top" :alt="post.title">
                <div class="card-body">
                    <h3 class="card-title">{{ post.title }}</h3>
                    <p class="card-text">{{ post.content }}</p>
                </div>
            </div>
        </div>
        <div class="row w-100 justify-content-around mt-3 mb-1">
            <div class="col-2 d-flex justify-content-around">
                <button v-if="prev_page" class="btn btn-success" @click="changePage('prev_page')">Prev</button>
                <button v-if="next_page" class="btn btn-success" @click="changePage('next_page')">Next</button>
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
            prev_page: null,
            next_page: null,

        }
    },
    created() {
        
        Axios.get('http://127.0.0.1:8000/api/posts')
             .then((result) => {
                    this.posts = result.data.result.data;
                    this.prev_page = result.data.result.prev_page_url;
                    this.next_page = result.data.result.next_page_url;
                }
             )
             .catch()

    },
    methods: {
        changePage(pageUrl) {
            let url = this[pageUrl];

            if (url) {
                Axios.get(url)
                .then((result) => {
                    this.posts = result.data.result.data;
                    this.prev_page = result.data.result.prev_page_url;
                    this.next_page = result.data.result.next_page_url;
                    }
                )
                .catch()
            }
        }
    }
}
</script>

<style>

</style>