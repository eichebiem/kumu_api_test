<template>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Login</div>

                <div class="card-body">
                    <form @submit.prevent="login">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" v-model="form_data.email">
                            <div class="form-text text-danger" v-text="errors.email"></div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" v-model="form_data.password">
                            <div class="form-text text-danger" v-text="errors.password"></div>
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>
                        <router-link class="btn btn-success float-right" to="/register">Register</router-link>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                form_data: {
                    email: '',
                    password: '',
                    device_name: 'browser'
                },
                errors: {}
            }
        },
        methods: {
            login() {
                axios.post('api/login', this.form_data).then((response) => {
                    this.errors = {}
                    localStorage.setItem('token', response.data)
                    this.$router.push('/')
                    this.$toaster.success("Successfully logged in.")
                }).catch((errors) => {
                    this.errors = errors.response.data.errors
                    console.log(errors.response.data.errors)
                })
            }
        },
        mounted() {
            console.log('Login Component mounted.')
        }
    }
</script>
