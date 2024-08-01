<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="mb-4">Register</h2>
                <form @submit.prevent="register">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" v-model="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" v-model="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" v-model="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password Confirmation</label>
                        <input type="password" class="form-control" id="password_confirmation" v-model="password_confirmation" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Register</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            name: '',
            email: '',
            password: '',
            password_confirmation: ''
        };
    },
    methods: {
        register() {
            this.$store.dispatch('register', {name: this.name, email: this.email, password: this.password, password_confirmation: this.password_confirmation})
                .then(() => {
                    this.$router.push('/dashboard');
                })
                .catch(error => {
                    console.error('Registration failed:', error);
                });
        },
    },
};
</script>

<style scoped>
/* Можно добавить кастомные стили здесь, если нужно */
</style>
Я
