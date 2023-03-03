<template>
    <div>

        <v-alert
            dense
            text
            type="success"
            v-if="showCreatedMessage"
        >
           {{apiResponse}}
        </v-alert>

        <h1>Clientes</h1>
        <div class="d-flex">
            <v-text-field v-model="filterValue" class="pt-5 mr-2" placeholder="Digite sua busca por nome ou CPF" outlined clearable></v-text-field>
        </div>
        
        <v-data-table
            :headers="headers"
            :items="this.customers"
            sort-by="name"
            class="elevation-1"
        >
            <template v-slot:top>
                <v-toolbar flat>
                    <v-dialog v-model="dialogDelete" max-width="600px">
                        <v-card>
                            <v-card-title class="text-h5 v-card-title">Tem certeza que deseja deletar esse cliente?</v-card-title>
                            <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="blue darken-1" text @click="closeDelete">Cancelar</v-btn>
                            <v-btn color="blue darken-1" text @click="deleteItemConfirm">Deletar</v-btn>
                            <v-spacer></v-spacer>
                            </v-card-actions>
                        </v-card>
                    </v-dialog>
                </v-toolbar>
            </template>

            <template v-slot:[`item.actions`]="{ item }">
                <v-icon small class="mr-2" @click="editItem(item)">
                    mdi-pencil
                </v-icon>
                <v-icon small @click="deleteItem(item)">
                    mdi-delete
                </v-icon>
            </template>
        </v-data-table>

    </div>
</template>

<script>

import { ENV_URL } from '../env'
import axios from 'axios';

export default {

    data(){
        return{
            dialog: false,
            dialogDelete: false,
            loading: false,
            apiResponse: '',
            showCreatedMessage: false,
            headers: [
                { text: 'Nome', value: 'name' },
                { text: 'CPF', value: 'cpf' },
                { text: 'Data de nascimento', value: 'birthdate', sortable: false },
                { text: 'Telefone', value: 'phone_number', sortable: false },
                { text: 'Açoes', value: 'actions', sortable: false }
            ],
            customers: [],
            customers_backup: [],
            customers_filtered: [],
            filterValue : '',
            itemIndex: -1,
            itemItemId: null
        }
    },

    watch: {
      dialog (val) {
        val || this.close()
      },
      dialogDelete (val) {
        val || this.closeDelete()
      },
      filterValue (val) {
        this.getCustomersByParams(val)
      }
    },

    created(){
        this.get_customers()
    },
        
    methods: {

        get_customers(){
            axios.get(ENV_URL+'/api').then(response => {
                this.customers = response.data
                this.customers_backup = this.customers
                console.log(this.customers)
            }).catch(e => {
                console.log(e)
            })
        },

        getCustomersByParams(val){

            axios.get(ENV_URL+'/api/customers?params='+val).then(response => {
                this.customers = response.data
            }) .catch(e => {
                console.log(e)
            })
            
        },

        editItem (item) {
            this.$router.push('/editar/'+item.id)
        },

        deleteItem (item) {
            this.itemIndex = this.customers.indexOf(item)
            this.itemItemId = item.id
            this.dialogDelete = true
        },

        deleteItemConfirm () {

            axios.delete(ENV_URL+'/api/customers/'+this.itemItemId).then(response => {

                this.customers.splice(this.itemIndex, 1)
                this.closeDelete()
                this.apiResponse = 'Cliente deletado com sucesso'
                this.showCreatedMessage = true
                console.log(response)

                setTimeout(() => {
                    this.showCreatedMessage = false
                    this.apiResponse = ''
                }, 5000)
            }).catch(() => {
                this.apiResponse = 'Algum problema aconteceu. Tente novamente mais tarde'
                this.showErrorMessage = true 

                setTimeout(() => {
                    this.showErrorMessage = false
                    this.apiResponse = ''
                }, 5000)
        })
            
        },

        close () {
            this.dialog = false
            this.$nextTick(() => {
                this.itemIndex = -1
            })
        },

        closeDelete () {
            this.dialogDelete = false
            this.$nextTick(() => {
                this.itemIndex = -1
            })
        }

    }

}

</script>

<style scoped>

    .d-flex{
        align-items: baseline;
    }
    .v-card-title{
        justify-content: center;
    }

</style>
