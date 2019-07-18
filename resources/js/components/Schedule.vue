<template>
    <v-container fluid>
        <v-alert
            :value="error"
            color="error"
        >
            {{ errorMessage}}
        </v-alert>
        <v-select
            :items="items"
            label="Doctor"
            item-value="id"
            item-text="name"
            v-model="doctor"
            solo
        ></v-select>
        <v-layout row wrap>
            <v-flex md12 lg6>
                <v-date-picker v-model="picker"></v-date-picker>
            </v-flex>
            <v-flex md12 lg6>

                <v-layout row wrap>
                    <v-flex md12>
                        <v-dialog
                            ref="dialogInicio"
                            v-model="modalInicio"
                            :return-value.sync="timeInicio"
                            persistent
                            lazy
                            full-width
                            width="290px"
                        >
                            <template v-slot:activator="{ on }">
                                <v-text-field
                                    v-model="timeInicio"
                                    label="Hora entrada"
                                    prepend-icon="fas fa-clock"
                                    readonly
                                    v-on="on"
                                ></v-text-field>
                            </template>
                            <v-time-picker
                                v-if="modalInicio"
                                v-model="timeInicio"
                                full-width
                            >
                                <v-spacer></v-spacer>
                                <v-btn flat color="primary" @click="modalInicio = false">Cancel</v-btn>
                                <v-btn flat color="primary" @click="$refs.dialogInicio.save(timeInicio)">OK</v-btn>
                            </v-time-picker>
                        </v-dialog>
                    </v-flex>
                    <v-flex md12 >
                        <v-dialog
                            ref="dialogFin"
                            v-model="modalFin"
                            :return-value.sync="timeFin"
                            persistent
                            lazy
                            full-width
                            width="290px"
                        >
                            <template v-slot:activator="{ on }">
                                <v-text-field
                                    v-model="timeFin"
                                    label="Hora salida"
                                    prepend-icon="fas fa-clock"
                                    readonly
                                    v-on="on"
                                ></v-text-field>
                            </template>
                            <v-time-picker
                                v-if="modalFin"
                                v-model="timeFin"
                                full-width
                            >
                                <v-spacer></v-spacer>
                                <v-btn flat color="primary" @click="modalFin = false">Cancel</v-btn>
                                <v-btn flat color="primary" @click="$refs.dialogFin.save(timeFin)">OK</v-btn>
                            </v-time-picker>
                        </v-dialog>
                    </v-flex>
                </v-layout>
            </v-flex>
        </v-layout>
        <v-layout justify-center>
            <v-spacer></v-spacer>
            <button type="button" class="btn btn-primary" v-on:click="saveSchedule()">Guardar</button>
        </v-layout>

        <v-layout row justify-center>
            <v-dialog v-model="dialogNoPermission" persistent max-width="290">
                <v-card>
                    <v-card-title class="headline">Permiso Denegado</v-card-title>
                    <v-card-text>No tienes acceso a esta seccion o no cumples con los permisos necesarios, por favor contacta al administrador</v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="red darken-1" flat @click="acceptNoPermissionDialog()">Aceptar</v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
        </v-layout>
        <v-layout row justify-center>
            <v-dialog v-model="dialogSucces" persistent max-width="290">
                <v-card>
                    <v-card-title class="headline">Se agendo correctamente</v-card-title>
                    <v-card-text>{{ dialogSuccesMessage }}</v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="green darken-1" flat @click="acceptDialogSucces()">Aceptar</v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
        </v-layout>
    </v-container>
</template>

<script>
    export default {
        data: ()=> ({
            items: [],
            doctor: 0,
            picker: new Date().toISOString().substr(0, 10),
            timeInicio: null,
            modalInicio: false,
            timeFin: null,
            modalFin: false,
            dialogNoPermission: false,
            dialogSucces: false,
            dialogSuccesMessage: 'Correcto',
            redirectUrl: null,
            error: false,
            errorMessage: 'Ups... Algo salio mal',
        }),
        async mounted() {
           this.items = [];
                try {
                    let response = await window.axios.post('/schedule/retrieveDoctors', {
                    });
                    this.items = response.data;
                } catch (e) {
                    console.log('Error');
                }


        },
        methods: {
            async saveSchedule(){
                    let dateFormated = this.formatDate(this.picker);
                    try {
                        let response = await window.axios.post('/schedule',{
                            doctor_id: this.doctor,
                            date: dateFormated,
                            time_start: this.timeInicio,
                            time_end: this.timeFin
                        });
                        if (response.status === 200) {
                            let data = response.data;
                            if (data.code === 'success') {
                                this.redirectUrl = data.redirectUrl;
                                this.successAlert(true, data.message);
                            } else if (data.code === 'no-permission') {
                                this.redirectUrl = data.redirectUrl;
                                this.errorAlert(true, data.message);
                            }else if (data.code === 'fail') {
                                this.errorAlert(true, data.message);
                            }
                        }
                    }catch (e) {
                        this.errorAlert(true, 'Ups... Algo salio mal');
                    }



            },
            errorAlert (value, message) {
                this.error = value;
                this.errorMessage = message;
                setTimeout(()=> {
                    this.error =  false;
                }, 3000);
            },
            successAlert (value, message) {
                this.dialogSucces = value;
                //this.errorMessage = message;
                this.dialogSuccesMessage = message;
            },
            formatDate (date) {
                if (!date) {
                    return null;
                }
                const [year, month, day] = date.split('-');
                return `${year}/${month}/${day}`;
            },
            acceptNoPermissionDialog() {
                this.dialogNoPermission = false;
                if (this.redirectUrl !== null && this.redirectUrl != '') {
                    window.location = this.redirectUrl;
                }
            },
            acceptDialogSucces() {
                this.dialogSucces = false;
                if (this.redirectUrl !== null && this.redirectUrl != '') {
                    window.location = this.redirectUrl;
                }
            }
        }

    }
</script>

<style scoped>

</style>
