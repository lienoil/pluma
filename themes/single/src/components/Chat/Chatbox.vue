<template>
  <div class="chatbox">
    <v-card>
      <v-card-text>
        <div v-for="(m, i) in messages" :key="i" :class="{'grey--text caption': m.type === 'info'}">
          <div v-if="m.type === 'info'" class="my-3">
            <small class="grey--text caption" v-html="m.message"></small>
          </div>
          <div v-else>
            <strong>{{ m.displayname }}:</strong> {{ m.message }}
          </div>
        </div>
      </v-card-text>
      <v-divider></v-divider>
      <v-text-field
        :append-icon-cb="send"
        @keyup.enter="send"
        append-icon="send"
        full-width
        label="Send a message"
        prepend-icon="camera"
        single-line
        :hint="typing.model ? `${typing.name} is typing` : ``"
        persistent-hint
        v-model="chat.message"
        @input="isTyping"
      ></v-text-field>
    </v-card>

    <!-- ChatComposer Component -->
    <!-- ChatComposer Component -->
  </div>
</template>

<script>
import Echo from 'laravel-echo'

window.Echo = new Echo({
  broadcaster: 'socket.io',
  host: window.location.hostname + ':3000'
})

export default {
  name: 'Chatbox',
  data () {
    return {
      channel: null,
      messages: [],
      user: null,
      chat: {
        displayname: '',
        message: ''
      },
      typing: {
        model: false,
        name: ''
      },
      socket: null
    }
  },
  methods: {
    get () {
      // this.$http.get('')
    },
    send () {
      if (this.chat.message.length === 0) {
        return
      }

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
    },
    isTyping () {
      let user = document.querySelector('.user--displayname').innerHTML

      if (!this.typing.model) {
        setTimeout(() => {
          this.channel.whisper('typing', {
            typing: {
              model: true,
              name: user
            }
          })
        }, 900)
      }
    }
  },
  mounted () {
    this.channel = window.Echo.join('chatbox')
      .here((users) => {
        for (var i = 0; i < users.length; i++) {
          let user = users[i]
          this.messages.push({type: 'info', message: `${user.displayname} joined the chat`})
        }
        console.log('here', users)
      })
      .joining((user) => {
        this.$root.alert({type: 'info', text: `${user.displayname} is active now`})
        this.messages.push({type: 'info', message: `${user.displayname} is active`})
        console.log('joining', user)
      })
      .leaving((user) => {
        // this.$root.alert({type: 'info', text: `${user.displayname} left`})
        this.messages.push({type: 'info', message: `${user.displayname} left`})
        console.log('leaving', user)
      })
      .listenForWhisper('typing', (e) => {
        this.typing = e.typing

        setTimeout(() => {
          this.typing.model = false
        }, 900)
      })
      .listen('.chatbox', (e) => {
        this.messages.push(e.message)
      })
  }
}
</script>
