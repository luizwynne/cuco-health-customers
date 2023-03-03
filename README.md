# Cuco Health Clientes - Documentação

#### Arquitetura
A arquitetura da aplicação é divida em dois diretórios: api e client, sendo respectivamente responsáveis pelo Backend e Frontend, ambas dentro de um mesmo repositório. O Frontend se comunica com o Backend através de requisições REST. 

O Frontend faz as chamadas a API através da biblioteca Axios de dentro dos compoentes presentes no 
repositório Pages. 

#### Bibliotecas e Frameworks
##### Frontend
- Vue.js 2.6
- Vue CLI
- Vuetify 2.6
- Vue Router
- Axios
##### Backend
- PHP 8.1
- Laravel Framework 10
- Eloquent ORM
- Banco de dados SQLite

#### Instalação

##### Backend
Em um terminal execute um por um os comandos abaixo:
```sh
cd api
composer install
php artisan key:generate
php artisan migrate
php artisan serve
```

##### Frontend
Em outro terminal, execute um a um os comandos abaixo:
```sh
cd client
npm install
npm run serve
```

#### Funcionalidades do projeto
##### Listagem de clientes
Na página inicial é possivel ver todos clientes listados. Os dados vem de uma chamada do Frontend  a uma API Rest no Backend que traz toda a relacao no banco de dados. É possivel tambem fazer uma paginacao caso haja mais do que 10 clientes e ordenamento por Nome e CPF.

##### Busca por Nome e CPF
No campo de texto superior é possível realizar uma busca por nome ou CPF do cliente. Esse resultado vem diretamente do banco de dados através de uma busca da API feita por parametros passados do Frontend para o Backend.

##### Editar clientes
Clicando no botao Lápis a aplicacao te leva para uma outra página onde é possivel editar o cliente escolhido.

##### Deletar clientes
Os clientes também podem ser deletados através do botao deletar, caracterizado pelo ícone de lixo. 

##### Criar clientes
No link superior direito do menu é possível ir a uma página onde se pode criar um novo cliente. Logo após sua criacao, será visualizado na lista geral de cliente no inicio da aplicacao.

##### Banco de dados
Optei por usar o banco de dados SQLite pois trabalha em formato de arquivo e nao precisariamos de uma configuracao específica do banco de dados de quem quer que estivesse testando a aplicacao. 

##### Testes Unitários
Alguns teste unitários e de Features foram disponibilizados. Para checa-los, basta conferir na pasta api/testes. Para executa-los para rodar os seguintes comandos em um terminal: 
```sh 
cd api
php artisan test
```

##### URL da Aplicacao
Acesse a aplicaco pela URL: http://localhost:8080 
