<template>
  <div class="login-page">
    <b-container>
      <b-row class="justify-content-center">
        <b-col md="6">
          <b-card title="Login" class="mt-5">
            <b-form @submit.prevent="loginUser">
              <b-form-group label="Email" label-for="email">
                <b-form-input
                  id="email"
                  v-model="userData.email"
                  type="email"
                  required
                  placeholder="Enter your email"
                ></b-form-input>
              </b-form-group>

              <b-form-group label="Password" label-for="password">
                <b-form-input
                  id="password"
                  v-model="userData.password"
                  type="password"
                  required
                  placeholder="Enter your password"
                ></b-form-input>
              </b-form-group>

              <b-button type="submit" variant="primary">Login</b-button>
            </b-form>
            <b-alert v-if="errorMessage" variant="danger" class="mt-3">{{
              errorMessage
            }}</b-alert>
            <b-alert show variant="info" class="mt-3">
              Belum memiliki akun?
              <b-link to="/register">Daftar sekarang</b-link>
            </b-alert>
          </b-card>
        </b-col>
      </b-row>
    </b-container>
  </div>
</template>

<script>
import { saveToken, saveUser, isLoggedIn } from "@/services/authService";

export default {
  data() {
    return {
      userData: {
        email: "herdian@gmail.com",
        password: "12345678",
      },
      errorMessage: "",
    };
  },
  methods: {
    async loginUser() {
      try {
        const response = await this.$axios.$post("/login", {
          email: this.userData.email,
          password: this.userData.password,
        });

        if (response.token) {
          const userData = await this.$axios.$post("/get-user-data", {
            email: this.userData.email,
          });

          saveToken(response.token);
          saveUser(userData);
          this.$router.push("/");
        }
      } catch (error) {
        this.errorMessage =
          "Login failed. Please check your email and password.";
        console.error("Login error:", error);
      }
    },
  },
  mounted() {
    // Jika pengguna sudah login, redirect langsung ke halaman utama
    if (isLoggedIn()) {
      this.$router.push("/");
    }
  },
};
</script>

<style scoped>
.login-page {
  background-color: #f8f9fa;
}
</style>
