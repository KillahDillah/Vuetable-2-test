// MyVuetable.vue

<template>
    <div>
        <vuetable ref="vuetable"
            api-url="https://vuetable.ratiw.net/api/users"
            :fields="fields"
            pagination-path=""
            @vuetable:pagination-data="onPaginationData"
        ></vuetable>
        <vuetable-pagination ref="pagination"></vuetable-pagination>
    </div>
</template>

// fields must match json data

<script>
import Vuetable from 'vuetable-2/src/components/Vuetable'
import accounting from 'accounting'
import moment from 'moment'
import VuetablePagination from 'vuetable-2/src/components/VuetablePagination'

export default {
  components: {
    Vuetable,
    VuetablePagination
  },
  data () {
    return {
      fields: [
        'name', 'email',
        {
            name: 'birthdate',
            titleClass: 'center aligned',
            dataClass: 'center aligned',
            callback: 'formatDate|MM-DD-YYYY'
        },
        {
            name: 'nickname',
            callback: 'allcap'
        },
        {
            name: 'gender',
            titleClass: 'center aligned',
            dataClass: 'center aligned',
            callback: 'genderLabel'
        },
        {
            name: 'salary',
            titleClass: 'center aligned',
            dataClass: 'center aligned',
            callback: 'formatNumber'
        },
        {
            name: 'address.line1',
            title: 'Address'
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
    }
  }
}
</script>

<style>
td {
    white-space: nowrap;
}
</style>