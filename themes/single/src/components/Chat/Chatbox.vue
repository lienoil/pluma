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
import Echo from 'laravel-echo'
// import io from 'socket.io-client'

window.io = require('socket.io-client')
window.Echo = new Echo({
  broadcaster: 'socket.io',
  host: 'http://localhost:3000'
  // host: window.location.hostname + ':3000'
})

export default {
  name: 'Chatbox',
  data () {
    return {
      messages: [],
      chat: {
        displayname: '',
        message: ''
      },
      socket: null
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

      // Persist
      this.$http.get('/admin/testsx/broadcast', {params: JSON.parse(JSON.stringify(this.chat))})

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
    window.Echo.join('message')
      .listen('.Test.Events.MessagePosted', (e) => {
        console.log(e)
      })

    console.log('mounted')
  },
  mountedXX () {
    // let self = this

    // Socket.IO
    // this.socket = io.connect('http://localhost:3000')
    // this.socket.on('presence-message', function (data) {
    //   data = JSON.parse(data)
    //   console.log(data)
    //   // append to DOM
    //   self.$root.alert({color: 'secondary', type: 'info', text: `New comment from ${data.data.message.displayname}`})
    //   self.messages.push(JSON.parse(JSON.stringify(data.data.message)))
    // })
    // Socket.IO

    // this.$echo.join('message')
    //   // .here(data => {
    //   //   console.log('here-now', data)
    //   // })
    //   // .joining()
    //   // .leaving()
    //   .listen('Test.Events.MessagePosted', (data) => {
    //     console.log('listen-data', data)
    //   })
  }
}
</script>
