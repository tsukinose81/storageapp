<template>
  <div class="form upload">
    <h1>{{ $route.params.user_id + '/' + $route.params.storage_name }}</h1>
    <input type="file" id="fileup" v-if="show" v-on:change="fileUpload"><label for=fileup v-if="show">Upload the file</label>
    <!-- <p><input type="file" name="upfile[]" webkitdirectory v-on:change="folderUpload">folders</p> -->
    <storagedata-component :key="resetKey"></storagedata-component>
  </div>
</template>

<script>
const bearerToken = localStorage.getItem("api-token");
export default {
  data: function(){
    return {
      fileInfo: '',
      folderInfo: '',
      show: false,
      resetKey: 0,
    }
  },
  mounted() {
    axios.get('/api/user_id', {
      headers: {
        Authorization: `Bearer ${bearerToken}`,
      }}).then(response => {
        if (response.data == this.$route.params.user_id) {
          console.log(response)
          this.show = true;
        }
      });
  },
  methods:{
    fileUpload(event) {
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
          this.resetKey++;
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

<style scoped>
.upload input {
  display: none;
}
.upload label {
  height: 50px;
  padding: 8px;
  border: 0;
  margin: 12px;
  font-size: 1.4rem;
  border-radius: 10px;
  background: #f2f3f7;
  box-shadow:  7px 7px 7px #c6cbcf,
              -7px -7px 7px #ffffff;
}
.upload label:active {
  background: #f2f3f7;
  box-shadow: inset  7px 7px 7px #c6cbcf,
              inset -7px -7px 7px #ffffff;
}
</style>