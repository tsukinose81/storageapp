<template>
    <div>
        <form class="form" @submit.prevent="register">
            <div>
                <input type="text" placeholder="Storage name" v-model="storage_name" />
            </div>
            <div>
                <input type="radio" name="public" value="1" id="public" v-model="pub">
                <label for="public" class="public">Pubulic</label>
                <input type="radio" name="public" value="1" id="private" v-model="pub">
                <label for="private" class="public">Pubulic</label>
                <p>Note: Public only</p>
            </div>
            <button>Create storage</button>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            user_id: "",
            storage_name: "",
            pub: "",
        };
    },
    methods: {
        register() {
            const bearerToken = localStorage.getItem("api-token");
            axios.get("/api/user_id", {
                headers: {
                    Authorization: `Bearer ${bearerToken}`,
                },
            }).then(response => {
                this.user_id = response.data;

                axios.post("/api/storage/create", {
                user_id: this.user_id,
                storage_name: this.storage_name,
                public: this.pub
                }).then(response => {
                    // console.log(response);
                    this.$router.push(`/${this.user_id}/${this.storage_name}`);
                })
                .catch(error => {
                    console.log(error);
                });
            }).catch(error => {
                console.log(error);
            });
            
        }
    }
}
</script>

<style>
input[type=radio] {
    display: none;
}
.public {
    display: inline-block;
    font-size: 1.4rem;
    margin: 10px;
    width: 100px;
    height: auto;
    padding: 5px;
    text-align: center;
    cursor: pointer;
    border: 0;
    border-radius: 10px;
    background: #e8eced;
    box-shadow:  5px 5px 10px #999c9c,
                -5px -5px 10px #ffffff;
}
input[type=radio]:checked + label {
    border-radius: 10px;
    background: #e8eced;
    box-shadow: inset 5px 5px 10px #999c9c,
                inset -5px -5px 10px #ffffff;
}
</style>