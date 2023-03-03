<template>
  <v-app>
    <v-app-bar
      app
      color="white"
      dark
    >
      <div class="d-flex align-center">

         <v-img
          :src="require('./assets/logo.png')"
          class="my-3 logo-holder"
          contain
          height="180"
        />

      </div>

      <v-spacer></v-spacer>

      <ul>
        <li>
          <router-link to="/">Consulta de clientes</router-link>
        </li>
        <li>
          <router-link to="/cadastro">Cadastrar cliente</router-link>
        </li>
      </ul>

    </v-app-bar>

    <v-main>
      <v-container class="spacing-playground pa-6" fluid>
        <router-view/>
      </v-container>
    </v-main>
  </v-app>
</template>

<script>

export default {
  name: 'App',

  data: () => ({
    //
  }),
};
</script>

<style scoped>

  .logo-holder{
    margin-left: 10px;
  }

  .v-application a {
    text-decoration: none;
  }

  ul{
    display: flex;
    flex-direction: row;
    list-style-type: none;
  }

  li{
    padding-left:15px;
    cursor: pointer;
    font-weight: bold;
    transition: all 0.2s;
  }

  li:hover{
    text-shadow: 0.5px 0.5px;
  }
</style>
