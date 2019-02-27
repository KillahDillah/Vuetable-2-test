<template>
  <div id="app">
    <img src="./assets/logo.png">
    <div class="m-5 pr-5 pl-5 pb-5">
      <vuetable-one :test-fun='testFun' :css='css'></vuetable-one>
      <!-- <vuetable-one :table-url="tableUrl"></vuetable-one>  example : set API call with props--> 
      <vuetable-two :css='css'></vuetable-two>
    </div>
  </div>
</template>

<script>
import VuetableOne from './components/VuetableOne'
import VuetableTwo from './components/VuetableTwo'

export default {
  name: 'app',  //name of app
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
      css: {
        table: {
          tableClass: 'table table-striped table-bordered table-hovered',
          loadingClass: 'loading',
          ascendingIcon: 'glyphicon glyphicon-chevron-up',
          descendingIcon: 'glyphicon glyphicon-chevron-down',
          handleIcon: 'glyphicon glyphicon-menu-hamburger',
        },
        pagination: {
          infoClass: 'pull-left',
          // wrapperClass: 'vuetable-pagination pull-right',
          activeClass: 'btn-primary',
          disabledClass: 'disabled',
          pageClass: 'btn btn-border',
          linkClass: 'btn btn-border',
          icons: {
            first: '',
            prev: '',
            next: '',
            last: '',
          },
        }
      }
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