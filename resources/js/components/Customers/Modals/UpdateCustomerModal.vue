<template>
    <v-dialog :value="edit" persistent max-width="850px">
        <v-card>
            <!-- Loader Component -->
            <loader :dialog="showLoader" />
            <!-- End -->

            <!-- Alert Component  -->
            <alert
                :dialog="showAlert"
                @close="showAlert = false"
                :message="getDataRequest.message"
                :type="getDataRequest.type"
            />
            <!-- End -->

            <!-- Questioner Component --->
            <questioner
                :dialog="showQuestioner"
                @close="showQuestioner = false"
                @accept="updateItemConfirm()"
                :title="questionerData.title"
                :message="questionerData.message"
            />
            <!-- End -->
            <v-toolbar color="light-blue darken-4" dark class="pa-0">
                <v-toolbar-title v-html="'Update Customer'"></v-toolbar-title>
                <v-spacer></v-spacer>
                <v-btn icon @click="close">
                    <v-icon>mdi-close</v-icon>
                </v-btn>
            </v-toolbar>
            <v-card-text class="mt-10 letra-modal-actualizar">
                <v-form ref="form" lazy-validation @submit.prevent="update">
                    <v-row>
                        <v-col sm="6" md="6" lg="6">
                            <v-text-field
                                v-model="customerEdit.name"
                                label="Customer Name"
                                required
                            ></v-text-field>
                        </v-col>
                        <v-col sm="6" md="6" lg="6">
                            <v-text-field
                                v-model="customerEdit.last_name"
                                label="Customer Last Name"
                                required
                            ></v-text-field>
                        </v-col>

                        <v-col sm="6" md="6" lg="6">
                            <v-menu
                                v-model="menu"
                                :close-on-content-click="false"
                                :nudge-right="40"
                                transition="scale-transition"
                                offset-y
                                min-width="auto"
                            >
                                <template v-slot:activator="{ on, attrs }">
                                    <v-text-field
                                        v-model="customerEdit.birth_date"
                                        required
                                        label="Picker without buttons"
                                        prepend-icon="mdi-calendar"
                                        readonly
                                        v-bind="attrs"
                                        v-on="on"
                                    ></v-text-field>
                                </template>
                                <v-date-picker
                                    v-model="customerEdit.birth_date"
                                    @input="menu = false"
                                ></v-date-picker>
                            </v-menu>
                        </v-col>

                        <v-col sm="6" md="6" lg="6">
                            <v-text-field
                                v-model="customerEdit.phone_number"
                                label="Phone Number"
                                required
                            ></v-text-field>
                        </v-col>
                        <v-col sm="3" md="3" lg="3">
                            <v-text-field
                                disabled
                                v-model="customerEdit.address.nameApartment"
                                label="Select Apartment"
                                required
                            ></v-text-field>
                        </v-col>
                        <v-col sm="3" md="3" lg="3">
                            <v-text-field
                                disabled
                                v-model="customerEdit.address.nameProvincy"
                                label="Select Provincy"
                                required
                            ></v-text-field>
                        </v-col>
                        <v-col sm="3" md="3" lg="3">
                            <v-text-field
                                disabled
                                v-model="customerEdit.address.nameDistrict"
                                label="Select District"
                                required
                            ></v-text-field>
                        </v-col>
                        <v-col sm="3" md="3" lg="3">
                            <v-text-field
                                v-model="customerEdit.address.address"
                                label="Address"
                                required
                            ></v-text-field>
                        </v-col>
                        <v-col sm="12" md="12" lg="12">
                            <v-select
                                v-model="customerEdit.concessionaire.id"
                                :items="getConcessionairesList"
                                :rules="[v => !!v || 'Item is required']"
                                :item-text="item => item.name"
                                :item-value="item => item.id"
                                label="Select Concessionaire"
                                required
                            ></v-select>
                        </v-col>
                    </v-row>
                    <div class="text-center">
                        <v-btn
                            color="green"
                            elevation="8"
                            large
                            type="submit"
                            dark
                        >
                            Update
                            <v-icon class="ml-1">
                                mdi-account-edit
                            </v-icon>
                        </v-btn>
                    </div>
                </v-form>
            </v-card-text>
        </v-card>
    </v-dialog>
</template>

<script>
import { mapActions, mapGetters } from "vuex";

import Loader from "../../Helpers/Loader.vue";
import Alert from "../../Helpers/Alert.vue";
import Questioner from "../../Helpers/Questioner.vue";
export default {
    name: "UpdateCustomerModal",
    data: () => ({
        date: new Date().toISOString().substr(0, 10),
        menu: false,
        showLoader: false,
        showAlert: false,
        showQuestioner: false,
        questionerData: {
            title: "UPDATE CUSTOMER",
            message: "¿Are you sure to want update this customer?"
        },
        provincyId: "",
        apartmentId: "",
        apartment: {},
        provincy: {}
    }),
    components: {
        Loader,
        Alert,
        Questioner
    },

    props: {
        dialog: {
            type: Boolean,
            default: false
        },
        customerEdit: {
            type: Object,
            default: function() {
                return {
                    id: "0",
                    name: "TEST",
                    last_name: "TEST",
                    phone_number: 999999999,
                    address: {
                        nameApartment: 0,
                        nameProvincy: 0,
                        nameDistrict: 0,
                        address: "TEST"
                    },
                    concessionaire: {
                        id: "0",
                        name: "ASD"
                    },
                    birth_date: "1998/10/10",
                    state: 1
                };
            }
        }
    },
    computed: {
        ...mapGetters([
            "getDataRequest",
            "getApartmentsList",
            "getConcessionairesList"
        ]),
        edit() {
            return this.dialog;
        },

        provinciesList() {
            return this.apartment.provincies;
        },

        districtsList() {
            return this.provincy.districts;
        }
    },
    methods: {
        ...mapActions([
            "updateCustomer",
            "getCustomersByAttributeDeterminate",
            "getApartments",
            "getConcessionaires"
        ]),

        close() {
            this.$emit("close");
        },

        listApartments() {
            this.getApartments();
        },

        listConcessionaires() {
            this.getConcessionaires();
        },

        update() {
            console.log("CONFIRM UPDATE");
            console.log(this.customerEdit);
            this.showQuestioner = true;
        },

        updateItemConfirm() {
            console.log("CONFIRM UPDATE");
            this.showQuestioner = false;
            this.showLoader = true;
            const data = {
                id: this.customerEdit.id,
                name: this.customerEdit.name,
                last_name: this.customerEdit.last_name,
                phone_number: this.customerEdit.phone_number,
                birth_date: this.customerEdit.birth_date,
                address: this.customerEdit.address.address,
                concessionaire_id: this.customerEdit.concessionaire.id,
                district_id: this.customerEdit.address.districtId
            };
            this.updateCustomer(data).then(result => {
                this.showLoader = false;
                this.showAlert = true;
                this.getCustomersByAttributeDeterminate({
                    attribute: "state",
                    value: 1
                }).then(result => {
                    console.log("La lista es");
                    console.log(this.getCustomersList);
                });
            });
        },

        formatDate(date) {
            if (!date) return null;

            const [year, month, day] = date.split("-");
            return `${year}/${month}/${day}`;
        }
    },

    beforeMount() {
        this.listApartments();
        this.listConcessionaires();
    }
};
</script>
