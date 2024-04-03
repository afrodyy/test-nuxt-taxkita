<template>
  <div>
    <div class="container">
      <div class="row">
        <div class="col-12 col-md-6 offset-md-3">
          <b-card title="Register Form ChatApp" class="mt-5">
            <b-form @submit.prevent="registerUser">
              <b-form-group id="name-group" label="Name:" label-for="name">
                <b-form-input
                  id="name"
                  v-model="userData.name"
                  required
                  placeholder="Enter your name"
                ></b-form-input>
              </b-form-group>

              <b-form-group id="email-group" label="Email:" label-for="email">
                <b-form-input
                  type="email"
                  id="email"
                  v-model="userData.email"
                  required
                  placeholder="Enter your email"
                ></b-form-input>
              </b-form-group>

              <b-form-group
                id="password-group"
                label="Password:"
                label-for="password"
              >
                <b-form-input
                  type="password"
                  id="password"
                  v-model="userData.password"
                  required
                  placeholder="Enter your password"
                ></b-form-input>
              </b-form-group>

              <b-button type="submit" variant="primary">Register</b-button>
            </b-form>
            <b-alert show variant="info" class="mt-3">
              Atau anda sudah memiliki akun?
              <b-link to="/login">Silahkan login</b-link>
            </b-alert>
          </b-card>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      userData: {
        name: "",
        email: "",
        password: "",
      },
    };
  },
  methods: {
    async registerUser() {
      try {
        // Kirim permintaan API untuk mendaftarkan pengguna
        const response = await this.$axios.$post("/register", this.userData);
        console.log("User registered:", response.data);
        // Reset data pengguna setelah pendaftaran berhasil
        this.userData = { name: "", email: "", password: "" };
        // Redirect pengguna ke halaman lain setelah pendaftaran berhasil
        this.$router.push("/login"); // Misalnya, halaman login
      } catch (error) {
        console.error("Error registering user:", error);
        // Handle error pendaftaran pengguna di sini
      }
    },
  },
};
</script>
