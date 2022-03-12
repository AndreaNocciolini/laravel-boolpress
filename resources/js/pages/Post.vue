<template>
  <div class="container">
    <div class="row">
      <div class="col">
            <div class="card">
              <img v-if="post.image" :src="'/storage/' + post.image" class="card-img-top" :alt="post.title">
            <div class="card-body">
                <h3 class="card-title">{{ post.title }}</h3>
                <p class="card-text">{{ post.content }}</p>
            </div>
          </div>
      </div>
    </div>
  </div>
</template>

<script>
import Axios from 'axios';

export default {
    name: 'Post',
    props: ['id'],
    data(){
      return {
        post: [],
      }
    },
    created() {
        
        Axios.get('http://127.0.0.1:8000/api/post/' + this.id, {headers: {'Authorization': 'Bearer S3m0l4es7k416gghi37pO0i7'}})
             .then((result) => {
                    this.post = result.data.result.data;
                }
             )
             .catch()

    },
}
</script>

<style>

</style>