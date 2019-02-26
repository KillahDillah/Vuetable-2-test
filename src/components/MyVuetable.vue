// MyVuetable.vue

<template>
    <div>
        <filter-bar></filter-bar>
        <vuetable ref="vuetable"
            :api-url="tableUrl"
            :fields="fields"
            pagination-path=""
            data-path=""
            :per-page="10"
            :multi-sort="true"
            :sort-order="sortOrder"
            :appendParams="moreParams"
            @vuetable:pagination-data="onPaginationData"
            @vuetable:cell-clicked="onCellClicked"
        >
            <!-- <template slot="actions" slot-scope="props"> 
                <div class="custom-actions">
                    <button class="ui basic button"
                    @click="onAction('view-item', props.rowData, props.rowIndex)">
                    <i class="zoom icon"></i>
                    </button>
                    <button class="ui basic button"
                    @click="onAction('edit-item', props.rowData, props.rowIndex)">
                    <i class="edit icon"></i>
                    </button>
                    <button class="ui basic button"
                    @click="onAction('delete-item', props.rowData, props.rowIndex)">
                    <i class="delete icon"></i>
                    </button>
                </div>
            </template> -->
        </vuetable>
        <div class="vutable-pagination ui basic segment grid">
            <vuetable-pagination-info ref="paginationInfo"
            ></vuetable-pagination-info>

            <vuetable-pagination ref="pagination"
            @vuetable-pagination:change-page="onChangePage"
            ></vuetable-pagination>
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
import FieldDefs from './FieldDefs.js'

Vue.use(VueEvents)
Vue.component('filter-bar', FilterBar)
Vue.component('my-detail-row', DetailRow)

export default {
    props: ['tableUrl'],
  components: {
    Vuetable,
    VuetablePagination,
    VuetablePaginationInfo
  },
  data () {
    return {
      fields: FieldDefs,
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
  },
  methods: {
    allcap (value) {
        return value.toUpperCase()
    },
    // formatDate(value, fmt = 'M D YYYY') {
    //     return (value == null)
    //     ? ''
    //     : moment(value, 'YYYY-MM-DD').format(fmt)
    // },
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