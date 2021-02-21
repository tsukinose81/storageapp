<template>
    <div>
        <form class="form" @submit.prevent="login">
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
 
            <button>Login</button><br>
            <p>Register for an account: <router-link v-bind:to="{name: 'register'}">Register</router-link></p>
        </form>
    </div>
</template>
 
<script>
export default {
    data() {
        return {
            email: "",
            password: "",
            errors: []
        };
    },
    methods: {
        login() {
            axios.get("/sanctum/csrf-cookie").then(response => {
                axios
                    .post("/api/login", {
                        email: this.email,
                        password: this.password
                    })
                    .then(response => {
                        // console.log(response.data);
                        localStorage.setItem("auth", "ture");
                        localStorage.setItem("api-token", response.data);
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

<style>
body, button {
    background: #f2f3f7;
    color: #5d6268;
}
.form {
    text-align: center;
}
.form label {
    min-width: 100px;
}
.form input {
    height: 40px;
    padding: 8px;
    border: 0;
    margin: 12px;
    font-size: 1.4rem;
    border-radius: 10px;
    background: #f2f3f7;
    box-shadow:  5px 5px 10px #babdbe,
                -5px -5px 10px #ffffff;
}
.form button {
    min-width: 100px;
    padding: 5px;
    border: 0;
    margin: 10px;
    font-size: 1.4rem;
    border-radius: 10px;
    background: #f2f3f7;
    box-shadow:  5px 5px 10px #999c9c,
                -5px -5px 10px #ffffff;
}
.form button:active {
    background: #f2f3f7;
    box-shadow: inset 5px 5px 10px #999c9c,
                inset -5px -5px 10px #ffffff;
}
</style>

<style scoped>
p {
    font-size: 18px;
    margin-top: 20px;
}
</style>