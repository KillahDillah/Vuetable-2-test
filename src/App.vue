<template>
  <div id="app">
    <img src="./assets/logo.png">
    <div class="m-5 pr-5 pl-5 pb-5">
      <my-vuetable :table-url="tableUrl"></my-vuetable>
    </div>
  </div>
</template>

<script>
import MyVuetable from './components/MyVuetable'

export default {
  name: 'app',  //renders on index page inside id tag
  components: {
    MyVuetable  //include MyVuetable 
  },
  data() {
    return {
    tableUrl : "https://jsonplaceholder.typicode.com/comments",
    }
  }
}
</script>

<style>
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>