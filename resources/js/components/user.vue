<template>
  <div class="form">
    <p>{{ $route.params.user_id }}</p>
    <div v-for="storage in storages" :key="storage.id">
      <router-link v-bind:to="{name: 'storage', params: { user_id: 2, storage_name: storage.storage_name }}">
      <span>{{ storage.storage_name }}</span>
        
      </router-link>
      <!-- <span>{{ storage.id }}</span> -->
      <!-- <p>{{ storage.storage_name }}</p> -->
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