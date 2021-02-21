<template>
  <div class="storage-data">
    <div v-for="file in files" :key="file.index">
      <span class="file">{{ file }}</span>
      <button v-on:click="download(file)">Download</button>
    </div>
  </div>
</template>

<script>
// const route = this.$route.params.user_id + this.$route.params.storage_name;
export default {
  data(){
    return {
      files: [],
    }
  },
  methods: {
    download(file) {
      axios.get('/api/download', {
        params: {
          user_id: this.$route.params.user_id,
          storage_name: this.$route.params.storage_name,
          file
        },
        responseType: 'blob',
        },
      ).then(response => {
        console.log(response)
        const blob = new Blob([response.data]);
        const link = document.createElement('a');
        link.href = window.URL.createObjectURL(blob);
        link.setAttribute('download', file);
        document.body.appendChild(link);
        link.click();
    });
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

<style scoped>
.storage-data {
  margin-top: 100px;
}
.file {
  display: inline-block;
  margin: 15px;
  min-width: 350px;
  font-size: 30px;
}
</style>