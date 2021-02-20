<template>
  <div>
    <h1>testcomponentdata</h1>
    <div v-for="file in files" :key="file.index">
      <span>{{ file }}</span>
      <button v-on:click="download(file)">Downloads</button>
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