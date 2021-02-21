<template>
  <div class="form">
    <h1>Welcome</h1>
    <h2>Recent Storage</h2>
    <div v-for="storage in storages" :key="storage.id">
      <router-link v-bind:to="{name: 'storage', params: { user_id: storage.user_id, storage_name: storage.storage_name }}">
        <span>{{ storage.user_id }}/{{ storage.storage_name }}</span>
      </router-link>
    </div>
  </div>
</template>

<script>
export default {
  data() {
      return {
        storages: [],
      };
    },
  mounted() {
    axios.get('/api/storage_recent').then(response => {
      this.storages = response.data;
      console.log(response)
    })
  }
}
</script>

<style scoped>
h1 {
  margin: 50px;
}
</style>