<template>
    <div>
        <!-- Modal fot update a customer --->
        <update-customer-modal
            :dialog="showUpdateModal"
            @close="showUpdateModal = false"
            :customerEdit="itemUpdate"
        />
        <!--End Modal-->

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
            @accept="deleteItemConfirm()"
            :title="questionerData.title"
            :message="questionerData.message"
        />
        <!--End Questioner-->

        <v-card class="mx-auto">
            <v-card-title style="color: #01579B">CUSTOMERS REPORT</v-card-title>
            <v-card-text>
                <v-data-table
                    v-if="getCustomersList == null"
                    item-key="name"
                    hide-default-footer
                    class="elevation-1"
                    loading
                    loading-text="Loading Customer List ..... Please wait :3"
                ></v-data-table>
                <v-data-table
                    v-if="getCustomersList != null"
                    :headers="headers"
                    :items="getCustomersList"
                    :page.sync="page"
                    :items-per-page="itemsPerPage"
                    hide-default-footer
                    class="elevation-1"
                    @page-count="pageCount = $event"
                >
                    <template v-slot:[`item.actions`]="{ item }">
                        <v-btn
                            elevation="1"
                            dark
                            small
                            color="green"
                            @click="editItem(item)"
                        >
                            <v-icon dark>
                                mdi-pencil
                            </v-icon>
                        </v-btn>

                        <v-btn
                            elevation="1"
                            dark
                            small
                            color="red"
                            @click="deleteItem(item)"
                        >
                            <v-icon dark>
                                mdi-delete
                            </v-icon>
                        </v-btn>
                    </template>
                    <template v-slot:no-data>
                        <v-btn color="primary" @click="initialize">
                            Reset
                        </v-btn>
                    </template>
                </v-data-table>
                <div class="text-center pt-2">
                    <v-pagination
                        color="light-blue darken-4"
                        v-model="page"
                        :length="pageCount"
                    ></v-pagination>
                </div>
            </v-card-text>
        </v-card>
    </div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
import Alert from '../Helpers/Alert.vue';
import Loader from "../Helpers/Loader.vue";
import Questioner from "../Helpers/Questioner.vue";
import UpdateCustomerModal from "./Modals/UpdateCustomerModal.vue";
export default {
    components: { UpdateCustomerModal, Questioner, Loader, Alert },
    name: "ReportCustomerComponent",
    data: () => ({
        showLoader: false,
        showAlert: false,
        showUpdateModal: false,
        showQuestioner: false,
        questionerData: {
            title: "DELETE CUSTOMER",
            message: "¿Are you sure to want delete this customer?"
        },

        itemUpdate: {
            id: '0',
            name: "TEST",
            last_name: "TEST",
            phone_number: 999999999,
            address: "TEST",
            birth_date: "1998/10/10",
            state: 1,
            concessionaire_id: "2",
            district_id: "2"
        },
        itemDelete: {},
        page: 1,
        pageCount: 0,
        itemsPerPage: 7,
        headers: [
            {
                text: "Concessionaire",
                align: "start",
                sortable: false,
                value: "concessionaire.name"
            },
            { text: "Name", value: "name" },
            { text: "Lastname", value: "last_name" },
            { text: "Phone", value: "phone_number" },
            { text: "Apartment", value: "address.nameApartment" },
            { text: "Provincy", value: "address.nameProvincy" },
            { text: "District", value: "address.nameDistrict" },
            { text: "Address", value: "address.address" },
            { text: "Actions", value: "actions", sortable: false }
        ]
    }),

    computed: {
        ...mapGetters(["getCustomersList","getDataRequest"])
    },

    methods: {
        ...mapActions([
            "getCustomers",
            "getCustomersByAttributeDeterminate",
            "deleteCustomer"
        ]),

        editItem(item) {
            this.itemUpdate = item;
            this.itemUpdate.birth_date = new Date(
                this.itemUpdate.birth_date.split('-')[0],
                this.itemUpdate.birth_date.split("-")[1] - 1,
                this.itemUpdate.birth_date.split("-")[2]
            ).toISOString().substr(0, 10),
            this.showUpdateModal = true;
        },

        deleteItem(item) {
            this.itemDelete = item;
            this.showQuestioner = true;
        },

        deleteItemConfirm() {
            console.log("ELEMENT DROP");

            this.showQuestioner = false;
            this.showLoader = true;
            this.deleteCustomer({ id: this.itemDelete.id }).then(result => {
                this.showLoader = false;
                this.showAlert = true;
                this.getItems();
            });
        },

        getItems() {
            /*this.getCustomers()
                .then(result => {
                    console.log("La lista es");
                    console.log(this.getCustomersList);
                })
            */
            this.getCustomersByAttributeDeterminate({
                attribute: "state",
                value: 1
            }).then(result => {
                console.log("La lista es");
                console.log(this.getCustomersList);
            });
        }
    },

    mounted() {
        this.getItems();
    }
};
</script>

<style></style>
