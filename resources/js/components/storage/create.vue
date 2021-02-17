<template>
    <div>
        <form class="form" @submit.prevent="user">
            <div>
                <input type="text" placeholder="Storage name" v-model="storage_name" />
            </div>
            <div>
                <input type="radio" name="public" value="1" id="public">
                <label for="public" class="public">Pubulic</label>
                <input type="radio" name="public" value="0" id="private">
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
            public: "",
        };
    },
    methods: {
        user() {
            const bearerToken = localStorage.getItem("api-token");
            axios.get("/api/user", {
                headers: {
                    Authorization: `Bearer ${bearerToken}`,
                },
            }).then(response => {
                    // console.log(response);
            }).catch(error => {
                // console.log('error!!!!!');
                console.log(error);
            });
        },
        register() {
            axios.post("/api/storage/create", {
                user_id: this.user_id,
                storage_name: this.storage_name,
                public: this.public
            }).then(response => {
                console.log(response);
                this.$router.push("/:user_id/:storage_name");
            })
            .catch(error => {
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