/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import App from './views/App';

import VueRouter from 'vue-router';
Vue.use(VueRouter);

import Home from './pages/Home';
import Posts from './pages/Posts';
import Post from './pages/Post';
import Contacts from './pages/Contacts';
import About from './pages/About';



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const router = new VueRouter({
    routes: [
        {
          path: '/',
          name: 'home',
          component: Home
        },
        {
          path: '/posts',
          name: 'posts',
          component: Posts
        },
        {
          path: '/post/:id',
          name: 'post',
          props: true,
          component: Post
        },
        {
          path: '/contacts',
          name: 'contacts',
          component: Contacts
        },
        {
          path: '/about',
          name: 'about',
          component: About
        },
      ]
})

const app = new Vue({
    el: '#app',
    render: h => h(App),
    router
});
