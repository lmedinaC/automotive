<template>
    <v-app>
        <div class="indexComponent">
            <v-row>
                <v-col sm="3" md="3" lg="3" class="sm-2 md-2 lg-2">
                    <menu-component />
                </v-col>
                <v-col sm="9" md="9" lg="9"  class="sm-10 md-10 lg-10">
                    <component v-bind:is="getAdminComponent"></component>
                </v-col>
            </v-row>
        </div>
    </v-app>
</template>

<script>
import { mapGetters } from "vuex";
import CreateCustomerComponent from "../Customers/CreateCustomerComponent.vue";
import MenuComponent from "./MenuComponent.vue";
import HomeAdminComponent from "./HomeAdminComponent.vue";
import ReportCustomerComponent from "../Customers/ReportCustomerComponent.vue";
export default {
    name: "IndexComponent",
    components: {
        MenuComponent,
        CreateCustomerComponent,
        HomeAdminComponent,
        ReportCustomerComponent
    },
    computed: {
        ...mapGetters(["getAdminComponent"])
    }
};
</script>

<style lang="scss" scoped>
    .indexComponent{
        margin: 10px 25px 10px 25px;
    }
</style>


