<template>
    <v-dialog
        :value="alert"
        persistent
        no-click-animation
        max-width="300"
        overlay-opacity="0"
        elevation="0"
        content-class="elevation"
    >
        <v-card v-click-outside="false" content-class="elevation" elevation="0" >
            <v-alert :type="type" prominent class="ma-0 ">
                <div class="ml-3">{{ message }}</div>
            </v-alert>
        </v-card>
    </v-dialog>
</template>

<script>
export default {
    name: "Alert",
    props: {
        /*
         *   Var to show the alert
         */
        dialog: {
            type: Boolean,
            default: false
        },
        /*
         *   Type of alert (success, warning, info, danger)
         */
        type: {
            type: String,
            default: "success"
        },
        /*
         *   The message of the alert
         */
        message: {
            type: String,
            default: "La acción ha sido realizada con éxito."
        }
    },
    computed: {
        /*
         *   Close the model before 1.5 seg
         */
        alert() {
            if (this.dialog == true) {
                setTimeout(() => {
                    this.$emit("close");
                }, 2500);
            }
            return this.dialog;
        }
    }
};
</script>

<style >
    .elevation{
        box-shadow: none ;
    }
</style>
