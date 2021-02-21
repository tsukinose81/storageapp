<template>
  <div class="form">
      <router-link v-bind:to="{name: 'login'}">Login</router-link> |
      <router-link v-bind:to="{name: 'user', params: { user_id: 2 }}">user</router-link> |
      <router-link v-bind:to="{name: 'create'}">CreateStorage</router-link>
  </div>
</template>

<style scoped>
a {
  font-size: 20px;
}
</style>