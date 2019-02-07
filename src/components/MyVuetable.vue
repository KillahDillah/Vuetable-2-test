// MyVuetable.vue

<template>
  <vuetable ref="vuetable"
    api-url="https://vuetable.ratiw.net/api/users"
    :fields="fields"
  ></vuetable>
</template>

// fields must match json data

<script>
import Vuetable from 'vuetable-2/src/components/Vuetable'

export default {
  components: {
    Vuetable
  },
  data () {
    return {
      fields: [
        'name', 'email',
        {
            name: 'birthdate',
        },
        {
            name: 'nickname',
        },
        {
            name: 'gender',
        },
        {
            name: 'salary'
        },
        {
            name: 'address.line1',
            title: 'Address'
        }
      ]
    }
  }
}
</script>