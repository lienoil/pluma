<template>
  <div class="chatbox">
    <v-card>
      <v-card-text>
        <p v-for="(m, i) in messages" :key="i">
          <strong>{{ m.displayname }}:</strong> {{ m.message }}
        </p>
      </v-card-text>
      <v-divider></v-divider>
      <v-text-field
        :append-icon-cb="send"
        @keyup.enter="send"
        append-icon="send"
        full-width
        hide-details
        label="Send a message"
        prepend-icon="camera"
        single-line
        v-model="chat.message"
      ></v-text-field>
    </v-card>

    <!-- ChatComposer Component -->
    <!-- ChatComposer Component -->
  </div>
</template>

<script>
export default {
  name: 'Chatbox',
  data () {
    return {
      messages: [],
      chat: {
        displayname: '',
        message: ''
      }
    }
  },
  methods: {
    get () {
      // this.$http.get('')
    },
    send () {
      this.$emit('sent', this.chat)

      // Set
      this.chat.displayname = document.querySelector('.user--displayname').innerHTML

      // Store
      this.messages.push(JSON.parse(JSON.stringify(this.chat)))

      // Persist
      this.$http.get('/admin/testsx/broadcast', this.chat)

      // Clear
      this.clear(this.chat)
    },
    clear (clearable) {
      for (let i in clearable) {
        clearable[i] = ''
      }
    }
  },
  mounted () {
    this.$echo.join('message-posted')
      .here(data => {
        console.log('here-now', data)
      })
      // .joining()
      // .leaving()
      .listen('.Test.Events.MessagePosted', (data) => {
        console.log('listen-data', data)
      })
  }
}
</script>
