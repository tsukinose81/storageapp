<template>
  <div>
    <h1>{{ $route.params.user_id + '/' + $route.params.storage_name }}</h1>
    <p><input type="file" v-on:change="fileUpload">file</p>
    <!-- <p><input type="file" name="upfile[]" webkitdirectory v-on:change="folderUpload">folders</p> -->
  </div>
</template>

<script>
export default {
  data: function(){
      return {
        fileInfo: '',
        folderInfo: ''
      }
    },
  methods:{
    fileUpload(event) {
      const bearerToken = localStorage.getItem("api-token");
      const file = event.target.files[0];
      const formData = new FormData();
      formData.append('file', file);
      formData.append('user_id', this.$route.params.user_id);
      formData.append('storage_name', this.$route.params.storage_name);

      axios.post('/api/upload/file', formData, {
        headers: {
          Authorization: `Bearer ${bearerToken}`,
          'content-type': 'multipart/form-data',
        }}).then(response => {
        // console.log(response);
      });
    },
    // folderUpload(event) {
    //   const files = event.target.files;
    //   const formData = new FormData();
    //   for (let i = 0; i < files.length; i++) {
    //     formData.append(`files${i}`, files[i]);
    //   }
    //   axios.post('/api/upload/folder', formData).then(response => {
    //     console.log(response);
    //   });
    // },
  }
}
</script>