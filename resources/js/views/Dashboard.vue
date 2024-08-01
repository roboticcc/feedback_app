<template>
    <div class="container mt-4">
        <h1 class="display-4 mb-4">Dashboard</h1>
        <div v-if="isClient" class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Feedback Form</h5>
                        <router-link to="/feedback" class="btn btn-primary">Submit Feedback</router-link>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="isManager" class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Feedback List</h5>
                        <router-link to="/feedback/list" class="btn btn-success">View Feedbacks</router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters } from 'vuex';

export default {
    computed: {
        ...mapGetters(['isClient', 'isManager']),
    },
};
</script>

<style scoped>
/* Можно добавить кастомные стили здесь, если нужно */
</style>
