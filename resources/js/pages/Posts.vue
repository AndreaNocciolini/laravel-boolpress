<template>
      <div class="container">
          <div class="row">
              <div class="col">
                  <h1>Try Something</h1>
              </div>
          </div>
          <Main :cards='cards' @changePage="changePage($event)"></Main>
      </div>
</template>

<script>
import Axios from 'axios';
import Main from '../components/Main';

export default {
    name: 'Posts',
    components: {
        Main,
    },
    
    data(){
        return {
            cards: {    
                posts: [],
                // prev_page: null,
                // next_page: null,
            },
        }
    },
    created() {
        
        Axios.get('http://127.0.0.1:8000/api/posts/try_it')
             .then((result) => {
                    this.cards.posts = result.data.result;
                    // this.cards.prev_page = result.data.result.prev_page_url;
                    // this.cards.next_page = result.data.result.next_page_url;
                    console.log(result)
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