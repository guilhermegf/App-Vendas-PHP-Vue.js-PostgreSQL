<template>
  <div id="app">
    <nav>
      <ul>
        <li><router-link to="/tipos_produto">Tipos de Produto</router-link></li>
        <li><router-link to="/produtos">Produtos</router-link></li>
        <li><router-link to="/vendas">Vendas</router-link></li>
      </ul>
    </nav>
    <router-view />
  </div>
</template>

<script>
import { defineComponent } from 'vue'
import { RouterLink } from 'vue-router'

export default defineComponent({
  name: 'App',
  components: {
    RouterLink},
})
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
nav {
  background-color: #333;
  overflow: hidden;
}

nav ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
}

nav li {
  float: left;
}

nav li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

nav li a:hover {
  background-color: #111;
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}
</style>