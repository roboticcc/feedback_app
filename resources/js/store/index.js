import {createStore} from 'vuex';
import axios from 'axios';
import {jwtDecode} from 'jwt-decode';

export default createStore({
    state: {
        user: null,
        token: localStorage.getItem('token') || null,
        role: localStorage.getItem('role') || null,
        feedbacks: [],
        feedback: {},
    },
    mutations: {
        SET_USER(state, user) {
            state.user = user;
        },
        SET_TOKEN(state, token) {
            state.token = token;
            localStorage.setItem('token', token);
        },
        SET_ROLE(state, role) {
            state.role = role;
            localStorage.setItem('role', role);
        },
        SET_FEEDBACKS(state, feedbacks) {
            state.feedbacks = feedbacks;
        },
        SET_FEEDBACK(state, feedback) {
            state.feedback = feedback;
        },
    },
    actions: {
        login({commit}, credentials) {
            return axios.post('/api/auth/login', credentials)
                .then(({data}) => {
                    const {token} = data;
                    const decodedToken = jwtDecode(token);
                    const role = decodedToken.role;

                    commit('SET_USER', decodedToken.user);
                    commit('SET_TOKEN', token);
                    commit('SET_ROLE', role);
                });
        },
        register({commit}, credentials) {
            return axios.post('/api/auth/register', credentials)
                .then(({data}) => {
                    const {token} = data;
                    const decodedToken = jwtDecode(token);
                    const role = decodedToken.role;

                    commit('SET_USER', decodedToken.user);
                    commit('SET_TOKEN', token);
                    commit('SET_ROLE', role);
                });
        },
        forgotPassword({ commit }, { email }) {
            return axios.post('/api/auth/forgot-password', { email });
        },
        resetPassword({ commit }, payload) {
            return axios.post('/api/auth/reset-password', payload);
        },
        logout({commit}) {
            commit('SET_USER', null);
            commit('SET_TOKEN', null);
            commit('SET_ROLE', null);
            localStorage.removeItem('token');
            localStorage.removeItem('role');
        },
        fetchFeedbacks({commit, state}) {
            return axios.get('/api/feedbacks', {
                headers: {
                    Authorization: `Bearer ${state.token}`,
                },
            }).then(({data}) => {
                commit('SET_FEEDBACKS', data);
            });
        },
        fetchFeedback({commit, state}, id) {
            return axios.get(`/api/feedbacks/${id}`, {
                headers: {
                    Authorization: `Bearer ${state.token}`,
                },
            }).then(({data}) => {
                commit('SET_FEEDBACK', data);
            });
        },
        submitFeedback({state}, formData) {
            return axios.post('/api/feedbacks', formData, {
                headers: {
                    Authorization: `Bearer ${state.token}`,
                    'Content-Type': 'multipart/form-data',
                },
            });
        },
    },
    getters: {
        isAuthenticated(state) {
            return !!state.token;
        },
        feedbacks: (state) => state.feedbacks,
        feedback: (state) => state.feedback,
        isManager(state) {
            return state.role === 'manager';
        },
        isClient(state) {
            return state.role === 'client';
        },
    },
});
