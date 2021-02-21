<template>
    <div class="form">
        <p>User ID: {{ user.user_id }}</p>
        <p>Email: {{ user.email }}</p>
        <router-link v-bind:to="{name: 'user', params: { user_id: user.user_id }}">MyStorages</router-link><br>
        <button type="button" @click="logout">Logout</button>

    </div>
</template>
 
<script>
export default {
    data() {
        return {
            user: ""
        };
    },
    mounted() {
        const bearerToken = localStorage.getItem("api-token");
        // console.log(bearerToken);
        axios.get("/api/user", {
            headers: {
                Authorization: `Bearer ${bearerToken}`,
            },
        }).then(response => {
            // console.log(response.data);
            this.user = response.data;
        });
    },
    methods: {
        logout() {
            axios
                .post("api/logout")
                .then(response => {
                    console.log(response);
                    localStorage.removeItem("auth");
                    localStorage.removeItem("api-token");
                    this.$router.push("/login");
                })
                .catch(error => {
                    console.log(error);
                });
        }
    }
};
</script>

<style scoped>
a {
  font-size: 20px;
}
</style>