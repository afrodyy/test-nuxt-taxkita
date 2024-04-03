<template>
  <div>
    <Navbar />
    <Chat :sender="sender" :recipient="recipient" />
  </div>
</template>

<script>
import Chat from "@/components/Chat.vue";

export default {
  components: {
    Chat,
  },
  data() {
    return {
      sender: this.$route.query.sender,
      recipient: this.$route.query.recipient,
    };
  },
};
</script>
