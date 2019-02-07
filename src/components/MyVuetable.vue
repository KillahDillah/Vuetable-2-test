// MyVuetable.vue

<template>
    <div>
        <div class="vutable-pagination ui basic segment grid">
            <vuetable-pagination-info ref="paginationInfoTop"
            ></vuetable-pagination-info>

            <vuetable-pagination ref="paginationTop"
            @vuetable-pagination:change-page="onChangePage"
            ></vuetable-pagination>
        </div>
        <filter-bar></filter-bar>
        <vuetable ref="vuetable"
            api-url="https://vuetable.ratiw.net/api/users"
            :fields="fields"
            pagination-path=""
            :per-page="30"
            :multi-sort="true"
            :sort-order="sortOrder"
            detail-row-component="my-detail-row"
            :appendParams="moreParams"
            @vuetable:pagination-data="onPaginationData"
            @vuetable:cell-clicked="onCellClicked"
        >
            <template slot="actions" scope="props"> 
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
            </template>
        </vuetable>

    </div>
</template>

// fields must match json data

<script>
import Vuetable from 'vuetable-2/src/components/Vuetable'
import accounting from 'accounting'
import moment from 'moment'
import VuetablePagination from 'vuetable-2/src/components/VuetablePagination'
import VuetablePaginationInfo from 'vuetable-2/src/components/VuetablePaginationInfo'
import CustomActions from './CustomActions'
import Vue from 'vue'
import DetailRow from './DetailRow'
import FilterBar from './FilterBar'

Vue.component('filter-bar', FilterBar)
Vue.component('my-detail-row', DetailRow)
Vue.component('custom-actions', CustomActions) //registers component to be used in vuetable

export default {
  components: {
    Vuetable,
    VuetablePagination,
    VuetablePaginationInfo
  },
  data () {
    return {
        // css: {
        //   ascendingIcon: 'fas fa-arrow-alt-circle-up',
        //   descendingIcon: 'glyphicon glyphicon-chevron-down'
        // },
      fields: [
        {
          name: '__sequence',  
          title: '#',
          titleClass: 'center aligned',
          dataClass: 'right aligned'
        },
        // {
        //   name: '__handle', 
        //   dataClass: 'center aligned'
        // },
        // {
        //   name: '__checkbox', 
        //   titleClass: 'center aligned',
        //   dataClass: 'center aligned'
        // },
        {
            name: 'name',
            sortField: 'name'
        },
        {
            name: 'email',
            sortField: 'email'
        },   
        {
            name: 'age',
            sortField: 'birthdate',
            dataClass: 'center aligned'
        },  
        {
            name: 'birthdate',
            sortField: 'birthdate',
            titleClass: 'center aligned',
            dataClass: 'center aligned',
            callback: 'formatDate|MM-DD-YYYY'
        },
        {
            name: 'nickname',
            sortField: 'nickname',
            callback: 'allcap'
        },
        {
            name: 'gender',
            sortField: 'gender',
            titleClass: 'center aligned',
            dataClass: 'center aligned',
            callback: 'genderLabel'
        },
        {
            name: 'salary',
            sortField: 'salary',
            titleClass: 'center aligned',
            dataClass: 'center aligned',
            callback: 'formatNumber',
            visible: false
        },
        {
            name: 'address.line1',
            sortField: 'address.line1',
            title: 'Address'
        },
        // {
        //   name: '__component:custom-actions',   // append the name of the component you registered with Vue
        //   title: 'Actions',
        //   titleClass: 'center aligned',
        //   dataClass: 'center aligned'
        // },
        {
          name: '__slot:actions',  
          title: 'Actions',
          titleClass: 'center aligned',
          dataClass: 'center aligned'
        }
      ],
      sortOrder: [
          {
              field: 'email',
              sortField: 'email',
              direction: 'asc'
          }
      ]
    }
  },
  methods: {
    allcap (value) {
        return value.toUpperCase()
    },
    formatNumber(value) {
        return accounting.formatNumber(value, 2)
    },
    genderLabel(value) {
        return value == 'M'
        ? '<span class="ui teal label"><i class="large man icon"></i>Male</span>'
        : '<span class="ui pink label"><i class="large woman icon"></i>Female</span>'
    },
    formatDate(value, fmt = 'M D YYYY') {
        return (value == null)
        ? ''
        : moment(value, 'YYYY-MM-DD').format(fmt)
    },
    onPaginationData (paginationData) {
        this.$refs.paginationTop.setPaginationData(paginationData)
        this.$refs.paginationInfoTop.setPaginationData(paginationData)

    //   this.$refs.pagination.setPaginationData(paginationData)
    //   this.$refs.paginationInfo.setPaginationData(paginationData)
    },
    onChangePage (page) {
      this.$refs.vuetable.changePage(page)
    },
    onAction (action, data, index) {
      console.log('slot) action: ' + action, data.name, index)
    },
    onCellClicked (data, field, event) {
        console.log('cellClicked: ', field.name)
        this.$refs.vuetable.toggleDetailRow(data.id)
      }
  }
}
</script>

<style>
td {
    white-space: nowrap;
}
</style>