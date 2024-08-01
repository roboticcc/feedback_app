<template>
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-6">Feedback List</h1>
        <div v-if="feedbacks.length === 0" class="text-gray-500">No feedbacks available.</div>
        <div v-else class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div
                v-for="feedback in feedbacks"
                :key="feedback.id"
                class="bg-white p-6 rounded shadow-md"
            >
                <h2 class="text-xl font-semibold mb-4">{{ feedback.subject }}</h2>
                <p class="text-gray-700 mb-4">{{ feedback.message }}</p>
                <p class="text-gray-500">
                    By: {{ feedback.client_name }} | {{ feedback.client_email }}
                </p>
                <router-link
                    :to="`/feedback/${feedback.id}`"
                    class="text-blue-500 hover:underline"
                >View Details</router-link
                >
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters } from "vuex";

export default {
    computed: {
        ...mapGetters(["isManager", "feedbacks"]),
    },
    created() {
        if (this.isManager) {
            this.fetchFeedbacks();
        }
    },
    methods: {
        fetchFeedbacks() {
            this.$store
                .dispatch("fetchFeedbacks")
                .then((feedbacks) => {
                    this.feedbacks = feedbacks;
                })
                .catch((error) => {
                    console.error("Error when loading:", error);
                    this.feedbacks = [];
                });
        },
    },
};
</script>

<style scoped>
</style>
