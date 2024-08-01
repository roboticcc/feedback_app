<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="mb-4">Forgot Password</h2>
                <form @submit.prevent="forgotPassword">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" v-model="email" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Send Password Reset Link</button>
                </form>
                <div v-if="message" class="mt-3 alert alert-success">{{ message }}</div>
                <div v-if="error" class="mt-3 alert alert-danger">{{ error }}</div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            email: '',
            message: '',
            error: '',
        };
    },
    methods: {
        forgotPassword() {
            this.$store.dispatch('forgotPassword', { email: this.email })
                .then(() => {
                    this.message = 'Password reset link sent. Please check your email.';
                    this.error = '';
                })
                .catch(error => {
                    this.message = '';
                    this.error = error.response.data.message || 'Failed to send password reset link.';
                });
        },
    },
};
</script>

<style scoped>
/* Можно добавить кастомные стили здесь, если нужно */
</style>
