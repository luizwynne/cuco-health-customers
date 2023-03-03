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

        <h1>Editar cliente</h1>

        <v-form
            ref="form"
            v-model="valid"
            lazy-validation
        >
            <v-text-field
                v-model="customer.name"
                :rules="nameRules"
                label="Nome"
                required
            ></v-text-field>

            <v-text-field
                v-model="customer.birthdate"
                :rules="birthdateRules"
                label="Data de nascimento"
                required
            ></v-text-field>

            <v-text-field
                v-model="customer.phone_number"
                label="Telefone"
                required
            ></v-text-field>

            <v-btn
                :disabled="!isValidForm"
                color="primary"
                class="mr-4"
                @click="save"
            >
                Salvar
            </v-btn>

            <v-btn
                color="error"
                @click="redirect"
            >
                Cancelar
            </v-btn>
        </v-form>           
    </div>
    
</template>

<script>

import { ENV_URL } from '../env'
import axios from 'axios';

export default {

    data(){
        return{
            valid: true,
            apiResponse: '',
            showCreatedMessage: false,
            customer: {id:'', name: '', ra:'', cpf:''},
            nameRules: [
                v => !!v || 'O campo Nome é obrigatório',
                v => (v && v.length >= 2) || 'O campo Nome precisa ter mais de 10 caracteres',
            ],
            birthdateRules: [
                v => !!v || 'O campo E-mail é obrigatório'
            ]
        }
    },

    created(){  
        this.getcustomer()
    },

    methods: {

        getcustomer(){
            let uri = '/api/customers/'+this.$route.params.id;
            axios.get(ENV_URL+uri).then((response) => {
                this.customer = response.data
            });
        },

        save(){
            this.validate()
            let uri = '/api/customers/'+this.customer.id;
            axios.put(ENV_URL+uri, {
                name: this.customer.name,
                birthdate: this.customer.birthdate,
                phone_number: this.customer.phone_number
            }).then(response => {
                
                if(response.status === 200){
                    this.apiResponse = 'Cliente editado com sucesso'
                }else{
                    this.apiResponse = 'Algum problema aconteceu. Tente novamente mais tarde'
                }

                this.showCreatedMessage = true

                setTimeout(() => {
                    this.showCreatedMessage = false
                    this.apiResponse = ''
                }, 5000)

                this.reset()

            }).catch(() => {

                this.apiResponse = 'Algum problema aconteceu. Tente novamente mais tarde'
                this.showErrorMessage = true 

                setTimeout(() => {
                    this.showErrorMessage = false
                    this.apiResponse = ''
                }, 5000)

            })
        },

        validate () {
            this.$refs.form.validate()
        },

        reset () {
            this.$refs.form.resetValidation()
        },

        redirect(){
            this.$router.push('/') 
        }

    },

    computed:{
        isValidForm(){
           return (this.customer.name && this.customer.name.length >= 2) &&
           (this.customer.birthdate && this.customer.birthdate.length >= 2)
        }
    },

}

</script>
