<template>
  <div class="container mt-3">
    <h2>Cadastrar Produto</h2>
    <form @submit.prevent="handleSubmit">
      <div class="form-group">
        <label for="nome">Nome: </label>
        <input type="text" class="form-control" id="nome" v-model="produto.nome" required>
      </div>
      <div class="form-group">
        <label for="descricao">Descrição: </label>
        <textarea class="form-control" id="descricao" v-model="produto.descricao"></textarea>
      </div>
      <div class="form-group">
        <label for="marca">Marca: </label>
        <textarea class="form-control" id="marca" v-model="produto.marca"></textarea>
      </div>
       <div class="form-group">
        <label for="preco">Preço (R$): </label>
        <input type="text" id="preco" v-model.trim="produto.preco" required class="form-control">
      </div>
      <div class="form-group">
        <label for="quantidade">Quantidade: </label>
        <input type="number" id="quantidade" v-model="produto.quantidade" required class="form-control">
      </div>
      <div class="form-group">
        <label for="tipo">Tipo: </label>
        <select class="form-control" id="tipo" v-model="produto.tipo">
          <option v-for="tipo in tipos" :key="tipo.id" :value="tipo.id">{{ tipo.nome }}</option>
        </select>
      </div>
      <br>
      <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      produto: {
        nome: '',
        descricao: '',
        marca: '',
        preco: '',
        quantidade_estoque:'',
        tipo: null,
      },
      tipos: [],
    };
  },
  mounted() {
    this.carregarTipos();
  },
  computed: {
    preco() {
      return parseFloat(this.produto.preco.replace(',', '.'));
    }
  },
  methods: {
    carregarTipos() {
      axios.get('https://apiwebsenac21.azurewebsites.net/tipos_produto').then((response) => {
        this.tipos = response.data;
      });
    },
    handleSubmit() {
      const produto = {
        nome: this.produto.nome,
        descricao: this.produto.descricao,
        marca: this.produto.marca,
        preco: this.preco,
        quantidade_estoque: this.produto.quantidade,
        tipo_id: this.produto.tipo
      };

      //console.log(produto);
      
       axios.post('https://apiwebsenac21.azurewebsites.net/produtos', produto).then(() => {
        // Redireciona para a página de listagem de tipos de produto
        this.$router.push({ name: 'produtos-list' });
      });
      
    },
  },
};
</script>
