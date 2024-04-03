<template>
  <div>
    <table class="table table-bordered table-hover border-collapse mt-3">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="user in filteredUsers" :key="user.id">
          <td>{{ user.id }}</td>
          <td>{{ user.name }}</td>
          <td>{{ user.email }}</td>
          <td>
            <button class="btn btn-primary" @click="startChat(user.email)">
              Start Chat
            </button>
          </td>
        </tr>
      </tbody>
      <tfoot>
        <tr>
          <td colspan="3">Total Users: {{ filteredUsers.length }}</td>
        </tr>
      </tfoot>
    </table>
  </div>
</template>

<script>
import { getUserInfo } from "@/services/authService";

export default {
  data() {
    return {
      users: [],
    };
  },
  methods: {
    async fetchUsers() {
      try {
        const response = await this.$axios.$get("/user");
        this.users = response; // Atur data pengguna setelah berhasil diambil dari backend
      } catch (error) {
        console.error("Error fetching users:", error);
      }
    },
    async startChat(user) {
      // Fungsi ini akan dipanggil saat tombol "Start Chat" di klik
      // Anda dapat menambahkan logika untuk memulai chat dengan pengguna yang dipilih di sini
      const userInfo = getUserInfo();
      const recipient = await this.$axios.$post("/get-user-data", {
        email: user,
      });
      const sender = await this.$axios.$post("/get-user-data", {
        email: userInfo.email,
      });

      this.$router.push({
        path: "/chat",
        query: {
          sender: sender.id,
          recipient: recipient.id,
        },
      });
    },
  },
  computed: {
    // Filter pengguna yang sedang login agar tidak ditampilkan di tabel
    filteredUsers() {
      const userInfo = getUserInfo();
      return this.users.filter((user) => user.email !== userInfo.email);
    },
  },
  mounted() {
    this.fetchUsers();
  },
};
</script>
