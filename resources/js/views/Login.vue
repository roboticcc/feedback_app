<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="mb-4">Login</h2>
                <form @submit.prevent="login">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" v-model="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" v-model="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            email: '',
            password: '',
        };
    },
    methods: {
        login() {
            this.$store.dispatch('login', {email: this.email, password: this.password})
                .then(() => {
                    this.$router.push('/dashboard');
                })
                .catch(error => {
                    console.error('Login failed:', error);
                });
        },
    },
};
</script>

<style scoped>
/* Можно добавить кастомные стили здесь, если нужно */
</style>
