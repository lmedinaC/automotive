import Vue from "vue";
import Vuex from "vuex";
const axios = require("axios");

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        adminComponent: "HomeAdminComponent",
        customersList: null,
        apartmentList: [{
            id: "0",
            name: "Apartment",
            provincies: [{
                id: "0",
                name: "Provincy",
                districts: [{
                    id: "0",
                    name: "District",
                    concessionaires: []
                }]
            }]
        }],

        concessionairesList: [{}],

        dataRequest: {
            message: "Default message",
            type: "success"
        }
    },

    /*
     * Returns the var states
     */
    getters: {
        /*
         *Get the component in home index
         */
        getAdminComponent(state) {
            return state.adminComponent;
        },

        /*
         *Getter a list of Customers
         */
        getCustomersList(state) {
            return state.customersList;
        },

        /*
         *Getter a list of Apartments
         */
        getApartmentsList(state) {
            return state.apartmentList;
        },

        /*
         *Getter a list of Apartments
         */
        getConcessionairesList(state) {
            return state.concessionairesList;
        },

        /*
         *Getter the message to back-end
         */
        getDataRequest(state) {
            return state.dataRequest;
        }
    },

    mutations: {
        /*
         *Set the component in home index
         */
        setAdminComponent(state, payload) {
            state.adminComponent = payload;
        },

        /*
         *setter a list of Customers
         */
        setCustomersList(state, payload) {
            state.customersList = payload;
        },

        /*
         *setter a list of Apartments
         */
        setApartmentsList(state, payload) {
            state.apartmentList = payload;
        },

        /*
         *setter a list of Apartments
         */
        setConcessionairesList(state, payload) {
            state.concessionairesList = payload;
        },

        /*
         *setter the message to back-end
         */
        setDataRequest(state, payload) {
            state.dataRequest = payload;
        }
    },

    actions: {
        /*
         *Change the component in home index
         */
        changeAdminComponent({ commit }, payload) {
            commit("setAdminComponent", payload);
        },

        /*
         *  Request to Create a customer in DB
         */
        createCustomer({ commit, dispatch }, data) {
            return axios
                .post("/customer/create", {...data })
                .then(response => {
                    console.log(response);
                    commit("setDataRequest", response.data);
                    return Promise.resolve(true);
                })
                .catch(function(error) {
                    console.log(error);
                    return Promise.resolve(false);
                });
        },

        /*
         *  Request to get all customers in DB
         */
        getCustomers({ commit }) {
            return axios
                .get("/customer/store")
                .then(response => {
                    //console.log(response.data.data);
                    commit("setCustomersList", null);
                    commit("setCustomersList", response.data.data);
                    return Promise.resolve(true);
                })
                .catch(function(error) {
                    console.log(error);
                    return Promise.resolve(false);
                });
        },

        /*
         *  Request to get all customers in DB by attributes determinates
         *  attributes => ('name','last_name','phone_number','state','concessionaire_id')
         */
        getCustomersByAttributeDeterminate({ commit, dispatch }, data) {
            return axios
                .post("/customer/atstore", {...data })
                .then(response => {
                    //console.log(response.data.data);
                    commit("setCustomersList", null);
                    commit("setCustomersList", response.data.data);

                    return Promise.resolve(true);
                })
                .catch(function(error) {
                    console.log(error);
                    return Promise.resolve(false);
                });
        },

        /*
         *  Request to update a customers in DB
         */
        updateCustomer({ commit, dispatch }, data) {
            return axios
                .post("/customer/update", {...data })
                .then(response => {
                    //console.log(response);
                    commit("setDataRequest", response.data);
                    return Promise.resolve(true);
                })
                .catch(function(error) {
                    console.log(error);
                    return Promise.resolve(false);
                });
        },

        /*
         *  Request to delete a customers in DB
         */
        deleteCustomer({ commit }, data) {
            return axios
                .post("/customer/delete", {...data })
                .then(response => {
                    //console.log(response);
                    commit("setDataRequest", response.data);
                    return Promise.resolve(true);
                })
                .catch(function(error) {
                    console.log(error);
                    return Promise.resolve(false);
                });
        },

        /*
         *  Request to restore a customers in DB
         */
        restoreCustomer({ commit, dispatch }, data) {
            return axios
                .post("/customer/delete", {...data })
                .then(response => {
                    console.log(response);
                    return Promise.resolve(true);
                })
                .catch(function(error) {
                    console.log(error);
                    return Promise.resolve(false);
                });
        },

        /*
         *  Request to get all Apartments in DB
         */
        getConcessionaires({ commit }) {
            return axios
                .get("/concessionaire/store")
                .then(response => {
                    console.log(response.data.data);
                    //commit("setConcessionairesList", null);
                    commit("setConcessionairesList", response.data.data);
                    return Promise.resolve(true);
                })
                .catch(function(error) {
                    console.log(error);
                    return Promise.resolve(false);
                });
        },

        /*
         *  Request to get all Apartments in DB
         */
        getApartments({ commit }) {
            return axios
                .get("/apartment/store")
                .then(response => {
                    console.log(response.data.data);
                    //commit("setApartmentsList", null);
                    commit("setApartmentsList", response.data.data);
                    return Promise.resolve(true);
                })
                .catch(function(error) {
                    console.log(error);
                    return Promise.resolve(false);
                });
        }
    }
});