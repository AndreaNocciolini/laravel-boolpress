<template>
  <div>
    <Header></Header>
    <router-view></router-view>
  </div>
</template>

<script>
import Header from '../components/Header.vue';
import Main from '../components/Main.vue';

export default {
    name:"App",
    components: {
      Header,
      Main,
    }
}
</script>

<style>

</style>