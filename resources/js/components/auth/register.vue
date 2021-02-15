<template>
    <div>
        <form class="login-form" @submit.prevent="register">
            <div>
                <input type="text" placeholder="Name" v-model="name" />
                <span v-if="errors.name">
                    {{ errors.name[0] }}
                </span>
            </div>

            <div>
                <input type="text" placeholder="Email" v-model="email" />
                <span v-if="errors.email">
                    {{ errors.email[0] }}
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
            name: "",
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
                        name: this.name,
                        email: this.email,
                        password: this.password
                    })
                    .then(response => {
                        console.log(response);
                        localStorage.setItem("auth", "ture");
                        this.$router.push("/about");
                    })
                    .catch(error => {
                        this.errors = error.response.data.errors;
                    });
            });
        }
    }
};
</script>

