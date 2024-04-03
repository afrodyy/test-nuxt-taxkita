<template>
  <div>
    <b-navbar toggleable="md" type="dark" variant="dark">
      <b-navbar-brand href="#">Admin Panel</b-navbar-brand>
      <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

      <b-collapse id="nav-collapse" is-nav>
        <b-navbar-nav>
          <!-- Navbar Links -->
        </b-navbar-nav>
      </b-collapse>
    </b-navbar>

    <b-row>
      <b-col md="3">
        <!-- Sidebar -->
        <b-sidebar id="sidebar" title="Menu" shadow>
          <!-- Sidebar Content -->
          <b-list-group>
            <b-list-group-item>
              <b-link to="/">Home</b-link>
            </b-list-group-item>
            <b-list-group-item>
              <b-link to="/dashboard">Dashboard</b-link>
            </b-list-group-item>
            <b-list-group-item>
              <b-link to="/users">Users</b-link>
            </b-list-group-item>
            <b-list-group-item>
              <b-link to="/products">Products</b-link>
            </b-list-group-item>
            <b-list-group-item>
              <b-link to="/categories">Categories</b-link>
            </b-list-group-item>
          </b-list-group>
        </b-sidebar>
      </b-col>

      <b-col md="9">
        <!-- Dashboard Content -->
        <slot></slot>
      </b-col>
    </b-row>
  </div>
</template>

<script>
export default {
  name: "AdminLayout",
};
</script>

<style scoped>
/* Styles for the layout */
</style>
