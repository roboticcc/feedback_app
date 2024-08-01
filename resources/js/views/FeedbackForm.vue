<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="mb-4">Submit Feedback</h2>
                <form @submit.prevent="submitFeedback">
                    <div class="mb-3">
                        <label for="subject" class="form-label">Subject</label>
                        <input type="text" class="form-control" id="subject" v-model="subject" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" v-model="message" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="file" class="form-label">Attach File</label>
                        <input type="file" class="form-control" id="attachment" @change="handleFileUpload">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            subject: '',
            message: '',
            file: null,
        };
    },
    methods: {
        handleFileUpload(event) {
            this.file = event.target.files[0];
        },
        submitFeedback() {
            const formData = new FormData();
            formData.append('subject', this.subject);
            formData.append('message', this.message);
            if (this.file) {
                formData.append('attachment', this.file);
            }
            this.$store.dispatch('submitFeedback', formData)
                .then(() => {
                    this.$router.push('/dashboard');
                })
                .catch(error => {
                    console.error('Feedback submission failed:', error);
                });
        },
    },
};
</script>

<style scoped>
/* Можно добавить кастомные стили здесь, если нужно */
</style>
