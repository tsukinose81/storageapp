<template>
    <div>
        <p>{{ user.name }}</p>
        <p>{{ user.email }}</p>
        <button type="button" @click="logout">ログアウト</button>
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
            // console.log(response);
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
                    this.$router.push("/login");
                })
                .catch(error => {
                    console.log(error);
                });
        }
    }
};
</script>
