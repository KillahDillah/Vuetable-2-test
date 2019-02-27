<template>
  <div id="app">
    <img src="./assets/logo.png">
    <div class="m-5 pr-5 pl-5 pb-5">
      <vuetable-one></vuetable-one>
      <!-- <comments :table-url="tableUrl"></comments> -->
      <vuetable-two></vuetable-two>
    </div>
  </div>
</template>

<script>
import VuetableOne from './components/VuetableOne'
import VuetableTwo from './components/VuetableTwo'

export default {
  name: 'app',  //renders on index page inside id tag
  components: {
    VuetableOne,  //include VuetableOne 
    VuetableTwo  //include VuetableTwo 
  },
  data() {
    return {
    // tableUrl : "https://jsonplaceholder.typicode.com/comments",
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