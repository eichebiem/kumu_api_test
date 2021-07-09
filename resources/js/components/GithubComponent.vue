<template>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Github Search User
                        <button type="button" class="btn btn-danger btn-sm float-right" @click="logout">Logout</button>
                    </div>

                    <div class="card-body">
                        <form @submit.prevent="search_github_user">
                            <div class="mb-3" v-for="(username, index) in form_data.usernames" :key="index">
                                <label for="username" class="form-label">Enter github username {{ index + 1}}</label>
                                <input type="text" class="form-control" id="username" autocomplete="false" v-model="form_data.usernames[index]">
                                <!-- <div class="form-text text-danger" v-text="errors.username"></div> -->
                            </div>
                            <button type="submit" class="btn btn-primary">Search</button>
                        </form>

                        <hr>

                        <p v-if="results.length == 0">No users found.</p>

                        <div v-else v-for="(result, index) in results" :key="index">
                            <ul>
                                <li>Name: {{ result.name }}</li>
                                <li>Login: {{ result.login }}</li>
                                <li>Company: {{ result.company }}</li>
                                <li>Number of followers: {{ result.followers }}</li>
                                <li>Number of public repositories: {{ result.public_repos }}</li>
                                <li>Average number of followers per public repository: {{ parseInt(result.followers/result.public_repos) }}</li>
                            </ul>

                            <hr>
                        </div>

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
                    usernames: [
                        '',
                        '',
                        '',
                        '',
                        '',
                        '',
                        '',
                        '',
                        '',
                        '',
                    ]
                },
                errors: {},
                results: {},
                display_result: false,
                token: localStorage.getItem('token')
            }
        },
        methods: {
            search_github_user() {
                axios.post('api/search_github', this.form_data).then((response) => {
                    this.results = response.data;
                    this.display_result = true
                    this.errors = {}
                }).catch((errors) => {
                    this.errors = errors.response.data.errors
                })
            },
            logout() {
                axios.post('api/logout').then((response) => {
                    localStorage.removeItem('token')
                    this.$router.push('/login')
                    this.$toaster.success(response.data['message'])
                }).catch((errors) => {
                    console.log(errors.response.data.errors)
                })
            }
        },
        mounted() {
            window.axios.defaults.headers.common['Authorization'] = 'Bearer ' + this.token
            console.log('Github Component mounted.')
        }
    }
</script>
