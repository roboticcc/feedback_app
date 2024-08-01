<template>
    <div>
        <h1>Feedback Detail</h1>
        <div v-if="feedback.subject">
            <p>Subject: {{ feedback.subject }}</p>
            <p>Message: {{ feedback.message }}</p>
            <p>Name: {{ feedback.client_name }}</p>
            <p>Email: {{ feedback.client_email }}</p>
        </div>
    </div>
</template>

<script>
import { mapGetters } from "vuex";

export default {
    computed: {
        ...mapGetters(["isManager", "feedback"]),
    },
    created() {
        if (this.isManager) {
            this.fetchFeedback();
        }
    },
    methods: {
        fetchFeedback() {
            this.$store
                .dispatch("fetchFeedback", this.$route.params.id)
                .then((feedback) => {
                    console.log(feedback)
                    this.feedback = feedback;
                })
                .catch((error) => {
                    console.error("Error when loading:", error);
                    this.feedback = [];
                });
        },
    },
}
</script>
