<template>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Register</div>

                <div class="card-body">
                    <form @submit.prevent="register">
                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="name" v-model="form_data.name">
                            <div class="form-text text-danger" v-text="errors.name"></div>
                        </div>
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
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Password Confirmation</label>
                            <input type="password" class="form-control" id="password_confirmation" v-model="form_data.password_confirmation">
                        </div>
                        <button type="submit" class="btn btn-primary">Register</button>
                        <router-link class="btn btn-success float-right" to="/login">Login</router-link>
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
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: ''
                },
                errors: {}
            }
        },
        methods: {
            register() {
                axios.post('api/register', this.form_data).then((response) => {
                    this.errors = {}
                    this.$router.push('/login')
                    this.$toaster.success(response.data['message'])
                }).catch((errors) => {
                    this.errors = errors.response.data.errors
                })
            }
        },
        mounted() {
            console.log('Register Component mounted.')
        }
    }
</script>
