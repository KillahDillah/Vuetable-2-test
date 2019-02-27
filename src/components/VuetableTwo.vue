// VuetableTwo.vue

<template>
    <div>
        <filter-bar></filter-bar>
        <vuetable ref="vuetable"
            api-url= "https://vuetable.ratiw.net/api/users"
            :fields="fields"
            :css="css.table"
            pagination-path=""
            data-path="data"
            :per-page="10"
            :multi-sort="true"
            :sort-order="sortOrder"
            :appendParams="moreParams"
            @vuetable:pagination-data="onPaginationData"
            @vuetable:cell-clicked="onCellClicked"
        >
        </vuetable>
        <div class="vutable-pagination ui basic segment grid">
          <vuetable-pagination-info ref="paginationInfo"></vuetable-pagination-info>
          <vuetable-pagination :css="css.pagination" ref="pagination" @vuetable-pagination:change-page="onChangePage"></vuetable-pagination>
        </div>
    </div>
</template>

// fields must match json data

<script>
import Vuetable from 'vuetable-2/src/components/Vuetable'
import moment from 'moment'
import VuetablePagination from 'vuetable-2/src/components/VuetablePagination'
import VuetablePaginationInfo from 'vuetable-2/src/components/VuetablePaginationInfo'
import Vue from 'vue'
import DetailRow from './DetailRow'
import FilterBar from './FilterBar'
import VueEvents from 'vue-events'

Vue.use(VueEvents)
Vue.component('filter-bar', FilterBar)
Vue.component('my-detail-row', DetailRow)

export default {
  props: ['css'],
  components: {
    Vuetable,
    VuetablePagination,
    VuetablePaginationInfo
  },
  data () {
    return {
      fields: [ //demonstrate the different ways to define fields
        { name:'id', title:'ID', titleClass: 'center aligned', dataClass: 'center aligned', sortField: 'id'}, 
        { name:'name', title: '<i class="fas fa-user"></i> Full Name', sortField: 'name'}, 
        { name: 'email', sortField: 'email'},     
        { name: 'birthdate', sortField: 'birthdate', titleClass: 'center aligned', dataClass: 'center aligned', callback: 'formatDate|MM-DD-YYYY' },  
        'nickname'
      ],
      sortOrder: [  
          {
              field: 'id',  // set how the table sorts initially
              sortField: 'id',
              direction: 'asc'
          }
      ],
      moreParams: {

      }
    }
  },
  mounted() {
    this.$events.$on('filter-set', eventData => this.onFilterSet(eventData))
    this.$events.$on('filter-reset', e => this.onFilterReset())
  },
  methods: {
    allcap (value) {
        return value.toUpperCase()
    },
    formatDate(value, fmt = 'M D YYYY') {
        return (value == null)
        ? ''
        : moment(value, 'YYYY-MM-DD').format(fmt)
    },
    onPaginationData (paginationData) {
      this.$refs.pagination.setPaginationData(paginationData)
      this.$refs.paginationInfo.setPaginationData(paginationData)
    },
    onChangePage (page) {
      this.$refs.vuetable.changePage(page)
    },
    // onAction (action, data, index) {
    //     console.log('slot) action: ' + action, data.name, index)
    // },
    onCellClicked (data, field, event) {
        console.log('cellClicked: ', field.name)
        this.$refs.vuetable.toggleDetailRow(data.id)
    },
    onFilterSet (filterText) {
        this.moreParams = {
            'filter': filterText
        }
        Vue.nextTick( () => this.$refs.vuetable.refresh())
    },
    onFilterReset () {
        this.moreParams = {}
        Vue.nextTick( () => this.$refs.vuetable.refresh())
    }
  }
}
</script>

<style>
td {
    white-space: nowrap;
}
.fa-user {
  color: orange;
}
</style>