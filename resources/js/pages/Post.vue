<template>
  <div class="row">
    <div class="col">
          <div class="card h-100">
            <img v-if="post.image" :src="'/storage/' + post.image" class="card-img-top" :alt="post.title">
          <div class="card-body">
              <h3 class="card-title">{{ post.title }}</h3>
              <p class="card-text">{{ post.content }}</p>
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
        post: null,
      }
    },
    created() {
        
        Axios.get('http://127.0.0.1:8000/api/post/' + this.id)
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