<template>
  <div>
    <Navbar />
    <div class="container">
      <h1 class="mt-3">Welcome to Simple ChatApp</h1>
      <UserTable />
    </div>
  </div>
</template>

<script>
import Chat from "@/components/Chat.vue";
import Navbar from "@/components/Navbar.vue";
import UserTable from "@/components/UserTable.vue";

export default {
  components: {
    Chat,
    Navbar,
    UserTable,
  },
};
</script>

<style>
/* Styling for the index page */
</style>
