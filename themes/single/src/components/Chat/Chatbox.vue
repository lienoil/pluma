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
        :hint="typing.model ? `${typing.name} is typing` : ``"
        @input="isTyping"
        @keyup="isNotTyping"
        @keyup.enter="send"
        append-icon="send"
        full-width
        label="Send a message"
        persistent-hint
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
    mountEcho () {
      // window.Echo = new Echo({
      //   broadcaster: 'socket.io',
      //   host: window.location.hostname + ':3000'
      // })

      // this.channel = window.Echo.join('chatbox')
      //   .here((users) => {
      //     for (var i = 0; i < users.length; i++) {
      //       let user = users[i]
      //       this.messages.push({type: 'info', message: `${user.displayname} joined the chat`})
      //     }
      //   })
      //   .joining((user) => {
      //     this.$root.alert({type: 'info', text: `${user.displayname} is active now`})
      //     this.messages.push({type: 'info', message: `${user.displayname} is active`})
      //   })
      //   .leaving((user) => {
      //     // this.$root.alert({type: 'info', text: `${user.displayname} left`})
      //     this.messages.push({type: 'info', message: `${user.displayname} left`})
      //   })
      //   .listenForWhisper('typing', (e) => {
      //     this.typing = e.typing

      //     // setTimeout(() => {
      //     //   this.typing.model = false
      //     // }, 3000)
      //   })
      //   .listen('.chatbox', (e) => {
      //     this.messages.push(e.message)
      //   })
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

      setTimeout(() => {
        this.channel.whisper('typing', {
          typing: {
            model: true,
            name: user
          }
        })
      }, 1000)
    },
    isNotTyping () {
      let user = document.querySelector('.user--displayname').innerHTML

      setTimeout(() => {
        this.channel.whisper('typing', {
          typing: {
            model: false,
            name: user
          }
        })
      }, 5000)
    }
  },
  mounted () {
    // this.mountEcho()
  }
}
</script>
