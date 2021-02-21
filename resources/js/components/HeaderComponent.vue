<template>
  <div class="form">
      <router-link v-bind:to="{name: 'login'}">Login/Account</router-link> | 
      <router-link v-bind:to="{name: 'create'}">CreateStorage</router-link>
  </div>
</template>

<style scoped>
a {
  font-size: 20px;
}
</style>