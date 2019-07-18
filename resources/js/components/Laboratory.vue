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
            label="Paciente"
            item-value="id"
            item-text="name"
            v-model="paciente"
            solo
        ></v-select>
        <v-select
            :items="itemsAnalisi"
            label="Tipo de analisis"
            item-value="id"
            item-text="name"
            v-model="typeAnalisis"
            solo
        ></v-select>
        <v-layout row wrap>
            <v-flex md12 lg6>
                <v-date-picker v-model="picker"></v-date-picker>
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
            itemsAnalisi: [],
            paciente: 0,
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
            typeAnalisis: 0
        }),
        async mounted() {
            this.items = [];
            this.itemsAnalisi = [];
            try {
                let response = await window.axios.get('/patients/get', {
                });
                console.log(response);
                if (response.data !== null) {
                    this.items = response.data;
                }
            } catch (e) {
                console.log('Error');
            }
            try {
                let response = await window.axios.get('laboratory/typeAnalises/get', {
                });
                console.log(response);
                if (response.data !== null) {
                    this.itemsAnalisi = response.data.data;
                }
            } catch (e) {
                console.log('Error');
            }

        },
        methods: {
            async saveSchedule(){
                let dateFormated = this.formatDate(this.picker);
                try {
                    let response = await window.axios.post('/laboratory/analises',{
                        patient_id: this.paciente,
                        arrived_analysis_date: dateFormated,
                        type_analisis_id: this.typeAnalisis

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
