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
        <vuetable ref="vuetable"
            api-url="https://vuetable.ratiw.net/api/users"
            :fields="fields"
            pagination-path=""
            :per-page="30"
            :multi-sort="true"
            :sort-order="sortOrder"
            @vuetable:pagination-data="onPaginationData"
        ></vuetable>

    </div>
</template>

// fields must match json data

<script>
import Vuetable from 'vuetable-2/src/components/Vuetable'
import accounting from 'accounting'
import moment from 'moment'
import VuetablePagination from 'vuetable-2/src/components/VuetablePagination'
import VuetablePaginationInfo from 'vuetable-2/src/components/VuetablePaginationInfo'

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
    }
  }
}
</script>

<style>
td {
    white-space: nowrap;
}
</style>