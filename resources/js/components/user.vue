<template>
  <div class="form">
    <h1>{{ $route.params.user_id }}'s Storage List</h1>
    <div v-for="storage in storages" :key="storage.id">
      <router-link v-bind:to="{name: 'storage', params: { user_id: $route.params.user_id, storage_name: storage.storage_name }}">
        <span>{{ storage.storage_name }}</span>
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
    axios.get('/api/storage_list', {
      params: {
        user_id: this.$route.params.user_id,
      }
    }).then(response => {
      this.storages = response.data;
    })
  }
}
</script>

<style scoped>
h1 {
  margin: 50px;
}
a {
  color: #5d6268;
  font-size: 25px;
}
div {
  padding: 3px;
}
</style>