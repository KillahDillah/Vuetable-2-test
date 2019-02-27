<template>
  <div id="app">
    <img src="./assets/logo.png">
    <div class="m-5 pr-5 pl-5 pb-5">
      <vuetable-one :test-fun='testFun'></vuetable-one>
      <!-- <vuetable-one :table-url="tableUrl"></vuetable-one>  example : set API call with props--> 
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
  methods: {
    testFun(){
      console.log ("I'm a function from APP")
    }
  },
  data() {
    return {
    // tableUrl : "https://jsonplaceholder.typicode.com/comments", // API call set globally for all tables to have same API
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