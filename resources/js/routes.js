import Login from './components/auth/LoginComponent.vue'
import Register from './components/auth/RegisterComponent.vue'

import Github from './components/GithubComponent.vue'

export default {
    mode: 'history',
    base: '/',
    fallback: true,
    routes: [
        {
            path: '/login',
            component: Login,
            name: Login,
            meta: { guess: true }

        },
        {
            path: '/register',
            component: Register,
            name: Register,
            meta: { guess: true }

        },
        {
            path: '/',
            component: Github,
            name: Github,
            meta: { requiresAuth: true }

        }
    ]
}