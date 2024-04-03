<template>
  <div>
    <b-navbar toggleable="lg" type="dark" variant="info">
      <div class="container">
        <b-navbar-brand href="#">Simple ChatApp</b-navbar-brand>

        <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

        <b-collapse id="nav-collapse" is-nav>
          <b-navbar-nav>
            <b-nav-item href="/">Home</b-nav-item>
          </b-navbar-nav>

          <!-- Right aligned nav items -->
          <b-navbar-nav class="ml-auto">
            <b-nav-item-dropdown right>
              <!-- Using 'button-content' slot -->
              <template #button-content>
                <em>{{ userName }}</em>
              </template>
              <b-dropdown-item href="#">Profile</b-dropdown-item>
              <b-dropdown-item @click="handleLogout" href="#"
                >Sign Out</b-dropdown-item
              >
            </b-nav-item-dropdown>
          </b-navbar-nav>
        </b-collapse>
      </div>
    </b-navbar>
  </div>
</template>

<script>
import { getUserInfo, logout } from "@/services/authService";

export default {
  data() {
    return {
      userName: "",
    };
  },
  methods: {
    async fetchUsername() {
      const userInfo = await getUserInfo();
      this.userName = userInfo.name;
    },
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
    this.fetchUsername();
  },
};
</script>
