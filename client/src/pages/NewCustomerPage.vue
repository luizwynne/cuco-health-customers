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

         <v-alert
            dense
            text
            type="error"
            v-if="showErrorMessage"
        >
           {{apiResponse}}
        </v-alert>

        <h1>Cadastrar cliente</h1>
        
        <v-form
            ref="form"
            v-model="valid"
            lazy-validation
        >
            <v-text-field
                v-model="name"
                :rules="nameRules"
                label="Nome"
                required
            ></v-text-field>

            <v-text-field
                v-model="cpf"
                :rules="cpfRules"
                label="CPF"
                required
            ></v-text-field>

            <v-text-field
                v-model="birthdate"
                :rules="birthdateRules"
                label="Data de nascimento"
                required
            ></v-text-field>

            <v-text-field
                v-model="phone_number"
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
    data: () => ({
      valid: true,
      apiResponse: '',
      showCreatedMessage: false,
      showErrorMessage: false,
      name: '',
      nameRules: [
        v => !!v || 'O campo Nome é obrigatório',
        v => (v && v.length >= 2) || 'O campo Nome precisa ter mais de 10 caracteres',
      ],
      cpf: '',
      cpfRules: [
        v => !!v || 'O campo CPF é obrigatório',
        v => (v && v.length == 11) || 'O campo CPF precisa ter 11 caracteres',
      ],
      birthdate: '',
      birthdateRules: [
        v => !!v || 'O campo Data de nascimento é obrigatório'
      ],
    }),

    computed:{
        isValidForm(){
           return (this.name && this.name.length >= 2) &&
           this.cpf.length == 11 &&
           this.birthdate.length > 0
        }
    },

    methods: {
        
      save(){
        this.validate()
        axios.post(ENV_URL+'/api/customers', {
            name: this.name,
            email: this.email,
            cpf: this.cpf,
            birthdate: this.birthdate,
            phone_number: this.phone_number
        }).then(response => {
            
              if(response.status === 200){
                this.apiResponse = 'Cliente cadastrado com sucesso'
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
        this.$refs.form.reset()
        this.$refs.form.resetValidation()
      },

      redirect(){
        this.$router.push('/') 
      }
    },
  }
</script>