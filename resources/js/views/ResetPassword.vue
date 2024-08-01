<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="mb-4">Reset Password</h2>
                <form @submit.prevent="resetPassword">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" v-model="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="token" class="form-label">Reset Token</label>
                        <input type="text" class="form-control" id="token" v-model="token" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="password" v-model="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm New Password</label>
                        <input type="password" class="form-control" id="password_confirmation" v-model="password_confirmation" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Reset Password</button>
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
            token: '',
            password: '',
            password_confirmation: '',
            message: '',
            error: '',
        };
    },
    methods: {
        resetPassword() {
            this.$store.dispatch('resetPassword', {
                email: this.email,
                token: this.token,
                password: this.password,
                password_confirmation: this.password_confirmation,
            })
                .then(() => {
                    this.message = 'Password has been reset successfully.';
                    this.error = '';
                })
                .catch(error => {
                    this.message = '';
                    this.error = error.response.data.message || 'Failed to reset password.';
                });
        },
    },
};
</script>

<style scoped>
/* Можно добавить кастомные стили здесь, если нужно */
</style>
