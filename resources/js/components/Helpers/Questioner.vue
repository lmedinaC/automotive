<template>
    <div>
        <v-dialog :value="question" max-width="600px" persistent>
            <v-card>
                <v-toolbar color="light-blue darken-4" dark class="pa-0">
                    <v-toolbar-title v-html="title"></v-toolbar-title>
                </v-toolbar>

                <v-card-text class="mt-4">
                    <div class="text--primary">
                        <h5>{{ message }}</h5>
                    </div>
                </v-card-text>

                <v-divider></v-divider>

                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="primary" text @click="accept">
                        Accept
                    </v-btn>
                    <v-btn color="red lighten-1" text @click="close">
                        Cancel
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </div>
</template>

<script>
export default {
    name: "Questioner",
    props: {
        /*
         *  Var to show the Question
         */
        dialog: {
            type: Boolean,
            default: false
        },
        /*
         *  Title of the Question
         */
        title: {
            type: String,
            default: "TITULO"
        },
        /*
         *  Message of the Question
         */
        message: {
            type: String,
            default: "MENSAJasdasdasdsdE"
        }
    },
    computed: {
        question() {
            return this.dialog;
        }
    },
    methods: {
        /*
         *   Close the model
         */
        close() {
            this.$emit("close");
        },
        /*
         *  Emmit a function to component parent before accept
         */
        accept() {
            this.$emit("accept");
        }
    }
};
</script>

<style lang="scss" scoped></style>
