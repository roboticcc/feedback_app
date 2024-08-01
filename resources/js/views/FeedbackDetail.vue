<template>
    <div>
        <h1>Feedback Detail</h1>
        <p>Subject: {{ feedback.subject }}</p>
        <p>Message: {{ feedback.message }}</p>
        <p>Name: {{ feedback.name }}</p>
        <p>Email: {{ feedback.email }}</p>
    </div>
</template>

<script>
export default {
    data() {
        return {
            feedback: {}
        }
    },
    created() {
        const id = this.$route.params.id;
        this.$store.dispatch('fetchFeedback', id);
    }
}
</script>
