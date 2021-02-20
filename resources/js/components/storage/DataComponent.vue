<template>
  <div>
    <h1>testcomponentdata</h1>
    <p v-for="file in files" :key="file">{{ file }}</p>
  </div>
</template>

<script>
export default {
  data(){
    return {
      files: [],
    }
  },
  mounted() {
    axios.get('/api/storage/getfile', {
      params: {
        user_id: this.$route.params.user_id,
        storage_name: this.$route.params.storage_name,
      }
    }).then(response => {
      this.files = response.data;
      // console.log(response);
    });
  }
}
</script>