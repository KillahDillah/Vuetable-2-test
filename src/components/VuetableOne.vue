// MyVuetable.vue

<template>
    <div>
      <button type="button" @click:test-fun="testFun">HEY</button>
        <filter-bar></filter-bar>
        <vuetable ref="vuetable"
            api-url= "https://vuetable.ratiw.net/api/users"
            :fields="fields" 
            pagination-path=""
            data-path="data"
            :per-page="10"
            :multi-sort="true"
            :sort-order="sortOrder"
            :appendParams="moreParams"
            @vuetable:pagination-data="onPaginationData"
            @vuetable:cell-clicked="onCellClicked"
            @vuetable:loaded="testFun"
        >
        </vuetable>
        <div class="vutable-pagination ui basic segment grid">
          <vuetable-pagination-info ref="paginationInfo"></vuetable-pagination-info>
          <vuetable-pagination ref="pagination" @vuetable-pagination:change-page="onChangePage"></vuetable-pagination>
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
import FieldDefs from './FieldDefs.js' //define fields within table

Vue.use(VueEvents)
Vue.component('filter-bar', FilterBar)
Vue.component('my-detail-row', DetailRow)

export default {
    // props: ['tableUrl'], bring in API set in APP.vue
    props: ['testFun'],
  components: {
    Vuetable,
    VuetablePagination,
    VuetablePaginationInfo
  },
  data () {
    return {
      // fields: FieldDefs, set dynamically using FieldDefs.js
      fields: ['col 1', 'col 2', 'col 3', {name: 'col 4', sortField: 'name'}],
      sortOrder: [
          {
              field: 'email',
              sortField: 'email',
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
    console.log('function', this.testFun)
  },
  methods: {
    allcap (value) {
        return value.toUpperCase()
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
</style>