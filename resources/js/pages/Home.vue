<template>
  <div>
      <div class="container-fluid">
          <div class="container">
              <div class="row">
              <div class="col">
                  <h1>Home</h1>
              </div>
          </div>
          <Main :cards='cards' @changePage="changePage($event)"></Main>
      </div>
          </div>
  </div>
</template>

<script>
import Axios from 'axios';
import Main from '../components/Main';

export default {
    name: 'Home',
    components: {
        Main,
    },
    
    data(){
        return {
            cards: {    
                posts: [],
                prev_page: null,
                next_page: null,
            },
        }
    },
    created() {
        
        Axios.get('http://127.0.0.1:8000/api/posts')
             .then((result) => {
                    this.cards.posts = result.data.result.data;
                    this.cards.prev_page = result.data.result.prev_page_url;
                    this.cards.next_page = result.data.result.next_page_url;
                }
             )
             .catch()

    },
    methods: {
        changePage(pageUrl) {
            let url = this.cards[pageUrl];
            
            if (url) {
                Axios.get(url)
                .then((result) => {
                    this.cards.posts = result.data.result.data;
                    this.cards.prev_page = result.data.result.prev_page_url;
                    this.cards.next_page = result.data.result.next_page_url;
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