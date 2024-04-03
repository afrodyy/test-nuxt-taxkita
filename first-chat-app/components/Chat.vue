<template>
  <div>
    <div class="message-container">
      <div v-for="(message, index) in messages" :key="index" class="message">
        <div
          :class="{
            'my-message': message.sender_id === sender,
            'other-message': message.sender_id !== sender,
          }"
        >
          {{ getMessageText(message) }}
        </div>
      </div>
    </div>
    <div class="input-container">
      <b-form-textarea
        v-model="newMessage"
        id="textarea-default"
        placeholder="Type messages here..."
        rows="2"
        @keydown.enter.prevent="sendMessageOnEnter"
      ></b-form-textarea>
      <b-button @click="sendMessage" variant="primary">Send</b-button>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      messages: [],
      newMessage: "",
      senderName: "",
      recipientName: "",
      isLoading: true,
    };
  },
  props: {
    sender: {
      type: String,
      required: true,
    },
    recipient: {
      type: String,
      required: true,
    },
  },
  methods: {
    async sendMessage() {
      if (this.newMessage.trim() !== "") {
        try {
          const response = await this.$axios.$post("/send-message", {
            sender_id: this.sender,
            recipient_id: this.recipient,
            text: this.newMessage,
          });
          this.messages.push(response.data);
          this.newMessage = "";
          this.fetchMessages();
        } catch (error) {
          console.error("Error sending message:", error);
        }
      }
    },
    async fetchMessages() {
      try {
        const response = await this.$axios.$get(
          `/get-message/${this.sender}/${this.recipient}`
        );

        this.messages = response.data;
      } catch (error) {
        console.error("Error fetching messages:", error);
      }
    },
    sendMessageOnEnter(event) {
      if (!event.shiftKey) {
        event.preventDefault();
        this.sendMessage();
      }
    },
    async getUsersData() {
      try {
        const [recipientData, senderData] = await Promise.all([
          this.$axios.$post("/get-user-data-by-id", { id: this.recipient }),
          this.$axios.$post("/get-user-data-by-id", { id: this.sender }),
        ]);
        this.recipientName = recipientData.name; // Initialize recipientName and senderName
        this.senderName = senderData.name;
        this.isLoading = false; // Set isLoading to false after fetching data
      } catch (error) {
        console.error("Error fetching user data:", error);
      }
    },
    getMessageText(message) {
      // Periksa apakah data pengguna sudah ada
      if (this.isLoading) {
        return "Loading..."; // Tampilkan pesan "Loading..." selama data sedang diambil
      }

      // Jika data pengguna sudah ada, lanjutkan dengan menampilkan pesan
      // Jika pesan berasal dari pengirim, tambahkan nama pengirim di depan pesan
      if (message.sender_id === this.sender) {
        return `${this.senderName}: ${message.text}`;
      } else {
        // Jika pesan berasal dari penerima, biarkan hanya teks pesan yang ditampilkan
        return message.text;
      }
    },
  },
  async mounted() {
    try {
      await this.getUsersData(); // Wait until fetching user data is done
      await this.fetchMessages(); // Wait until fetching messages is done
    } catch (error) {
      console.error("Error fetching data:", error);
    }
  },
};
</script>

<style>
.message-container {
  margin-bottom: 20px;
}
.message {
  margin-bottom: 10px;
  padding: 8px;
  border-radius: 8px;
  display: inline-block;
  max-width: 70%;
}
.my-message {
  background-color: #dcf8c6; /* or any color you prefer */
  float: right; /* Float right for sender messages */
}

.other-message {
  background-color: #e8e8e8; /* or any color you prefer */
  float: left; /* Float left for recipient messages */
}

.input-container {
  display: flex;
  align-items: center;
}
</style>
