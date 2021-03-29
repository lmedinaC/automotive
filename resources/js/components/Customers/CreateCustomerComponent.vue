<template>
    <div data-app>
        <!----LOADER---->
        <loader :dialog="showLoader" />
        <!----ALERT----->
        <alert
            :dialog="showAlert"
            @close="showAlert = false"
            :message="getDataRequest.message"
            :type="getDataRequest.type"
        />

        <v-card class="mx-auto">
            <v-card-title style="color: #01579B">CREATE CUSTOMER</v-card-title>
            <v-card-text>
                <v-form ref="form" lazy-validation>
                    <v-row>
                        <v-col sm="6" md="6" lg="6">
                            <v-text-field
                                v-model="customer.name"
                                :rules="[requiredFieldRule, maxCharacterRule]"
                                label="Customer Name"
                                required
                            ></v-text-field>
                        </v-col>
                        <v-col sm="6" md="6" lg="6">
                            <v-text-field
                                v-model="customer.last_name"
                                :rules="[requiredFieldRule, maxCharacterRule]"
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
                                        v-model="date"
                                        required
                                        label="Picker without buttons"
                                        prepend-icon="mdi-calendar"
                                        readonly
                                        v-bind="attrs"
                                        v-on="on"
                                    ></v-text-field>
                                </template>
                                <v-date-picker
                                    v-model="date"
                                    @input="menu = false"
                                ></v-date-picker>
                            </v-menu>
                        </v-col>

                        <v-col sm="6" md="6" lg="6">
                            <v-text-field
                                v-model="customer.phone_number"
                                :rules="[requiredFieldRule, maxCharacterRule]"
                                label="Phone Number"
                                required
                            ></v-text-field>
                        </v-col>
                        <v-col sm="3" md="3" lg="3">
                            <v-select
                                v-model="apartment"
                                :items="getApartmentsList"
                                :rules="[v => !!v || 'Item is required']"
                                :item-text="item => item.name"
                                :item-value="item => item.id"
                                return-object
                                label="Select Apartment"
                                required
                            ></v-select>
                        </v-col>
                        <v-col sm="3" md="3" lg="3">
                            <v-select
                                v-model="provincy"
                                :items="provinciesList"
                                :rules="[v => !!v || 'Item is required']"
                                :item-text="item => item.name"
                                :item-value="item => item.id"
                                return-object
                                label="Select Provincy"
                                required
                            ></v-select>
                        </v-col>
                        <v-col sm="3" md="3" lg="3">
                            <v-select
                                v-model="customer.district_id"
                                :items="districtsList"
                                :rules="[v => !!v || 'Item is required']"
                                :item-text="item => item.name"
                                :item-value="item => item.id"
                                label="Select District"
                                required
                            ></v-select>
                        </v-col>
                        <v-col sm="3" md="3" lg="3">
                            <v-text-field
                                v-model="customer.address"
                                :rules="[requiredFieldRule, maxCharacterRule]"
                                label="Address"
                                required
                            ></v-text-field>
                        </v-col>
                        <v-col sm="12" md="12" lg="12">
                            <v-select
                                v-model="customer.concessionaire_id"
                                :items="getConcessionairesList"
                                :rules="[v => !!v || 'Item is required']"
                                :item-text="item => item.name"
                                :item-value="item => item.id"
                                label="Select Concessionaire"
                                required
                            ></v-select>
                        </v-col>
                    </v-row>

                    <v-btn color="success" class="mt-4" @click="create" large>
                        Create <v-icon>mdi-account-plus</v-icon>
                    </v-btn>
                </v-form>
            </v-card-text>
        </v-card>
    </div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
import Alert from "../Helpers/Alert.vue";
import Loader from "../Helpers/Loader.vue";
export default {
    components: { Loader, Alert },
    name: "CreateCustomerComponent",
    data() {
        return {
            date: new Date().toISOString().substr(0, 10),
            menu: false,
            showLoader: false,
            showAlert: false,
            mensaje: "asd",
            type: "success",
            customer: {
                name: "",
                last_name: "",
                phone_number: 999999999,
                address: "",
                birth_date: "",
                state: 1,
                concessionaire_id: "",
                district_id: ""
            },
            apartment: {},
            provincy: {},
            select: null,

            maxCharacterRule: v =>
                (v && v.length <= 60) || "maximum is 60 characters",
            requiredFieldRule: v => !!v || "Required Field",

            emailRules: [v => /.+@.+\..+/.test(v) || "E-mail must be valid"],

        };
    },


    computed: {
        ...mapGetters(["getDataRequest","getApartmentsList","getConcessionairesList"]),
        
        provinciesList(){
            return this.apartment.provincies
        },

        districtsList(){
            return this.provincy.districts
        }
    },

    methods: {
        ...mapActions(["createCustomer","getApartments","getConcessionaires"]),

        listApartments(){
            this.getApartments()
        },

        listConcessionaires(){
            this.getConcessionaires()
        },

        create() {
            const url = "/customer/create";
            this.customer.birth_date = this.formatDate(this.date);
            if (this.$refs.form.validate()) {
                this.showLoader = true;
                this.customer.birth_date = this.formatDate(this.date);
                this.createCustomer(this.customer).then(result => {
                    this.showLoader = false;
                    this.showAlert = true;
                    //if (result == true) this.$refs.form.reset();
                });
            } else {
                console.log(this.customer);
                console.log(this.select);
            }
        },

        formatDate(date) {
            if (!date) return null;

            const [year, month, day] = date.split("-");
            return `${year}/${month}/${day}`;
        },

        
    },

    beforeMount(){
        this.listApartments()
        this.listConcessionaires()
    },
};
</script>

<style></style>
