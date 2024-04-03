<template>
  <div></div>
</template>

<script>
import { logout } from "@/services/authService";

export default {
  methods: {
    async handleLogout() {
      try {
        logout();
        await this.$axios.post("/logout");
        // Handle success logout
        this.$router.push("/login");
      } catch (error) {
        console.error("Error logging out:", error);
        // Handle error logout
      }
    },
  },
  mounted() {
    this.handleLogout();
  },
};
</script>
