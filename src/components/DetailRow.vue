// DetailRow.vue
  <template>
    <div @click="onClick">
      <div class="inline field">
        <label>Name: </label>
        <span>{{rowData.name}}</span>
      </div>
      <div class="inline field">
        <label>Email: </label>
        <span>{{rowData.email}}</span>
      </div>
      <div class="inline field">
        <label>Body: </label>
        <span>{{rowData.body}}</span>
      </div>
    </div>
  </template>

  <script>
  export default {
    props: {
      rowData: {
        type: Object,
        required: true
      },
      rowIndex: {
        type: Number
      }
    },
    methods: {
      onClick (event) {
        console.log('my-detail-row: on-click', event.target)
      }
    },
  }
  </script>