<template>
    <div>
        <form class="form" @submit.prevent="register">
            <div>
                <input type="text" placeholder="Email" v-model="email" />
                <span v-if="errors.email">
                    {{ errors.email[0] }}
                </span>
            </div>
 
            <div>
                <input type="text" placeholder="UserID" v-model="user_id" />
                <span v-if="errors.user_id">
                    {{ errors.user_id[0] }}
                </span>
            </div>

            <div>
                <input type="password" placeholder="Password" v-model="password" />
                <span v-if="errors.password">
                    {{ errors.password[0] }}
                </span>
            </div>
 
            <button>Register</button>
        </form>
    </div>
</template>
 
<script>
export default {
    data() {
        return {
            user_id: "",
            email: "",
            password: "",
            errors: []
        };
    },
    methods: {
        register() {
            axios.get("/sanctum/csrf-cookie").then(response => {
                axios
                    .post("/api/register", {
                        user_id: this.user_id,
                        email: this.email,
                        password: this.password
                    })
                    .then(response => {
                        // console.log(response);
                        localStorage.setItem("auth", "ture");
                        localStorage.setItem("api-token", response.data);
                        this.$router.push("/account");
                    })
                    .catch(error => {
                        this.errors = error.response.data.errors;
                    });
            });
        }
    }
};
</script>

