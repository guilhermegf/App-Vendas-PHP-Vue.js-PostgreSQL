<template>
  <div>
    <form>
      <div class="form-group">
        <label for="nome" class="form-control">Nome:</label>
        <input type="text" id="nome" v-model="produto.nome" required class="form-control">
      </div>
      <div class="form-group">
        <label for="descricao">Descrição:</label>
        <textarea class="form-control" id="descricao" v-model="produto.descricao"></textarea>
      </div>
      <div class="form-group">
        <label for="marca">Marca:</label>
        <input type="text" id="marca" v-model="produto.marca" required class="form-control">
      </div>
      <div class="form-group">
        <label for="preco" class="form-control">Preço:</label>
        <input type="number" step="0.01" id="preco" v-model="produto.preco" required class="form-control">
      </div>
      <div class="form-group">
        <label for="quantidade_estoque" class="form-control">Quantidade em Estoque:</label>
        <input type="number" id="quantidade_estoque" v-model="produto.quantidade_estoque" required class="form-control">
      </div>
      <div class="form-group">
        <label for="tipo_id" class="form-control">Tipo de Produto:</label>
        <select id="tipo_id" v-model="produto.tipo_id" required class="form-control">
          <option v-for="tipo_produto in tipos_produto" :value="tipo_produto.id" :key="tipo_produto.id">{{ tipo_produto.nome }}</option>
        </select>
      </div>
      <br>
      <div class="form-group">
        <button @click.prevent="salvarProduto()" class="btn btn-primary">Salvar</button>
      </div>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      produto: {},
      tipos_produto: []
    };
  },
  created() {
    const produto_id = this.$route.params.id;
    axios.get(`https://apiwebsenac21.azurewebsites.net/produtos/${produto_id}`).then(response => {
      this.produto = response.data;
    });
    axios.get('https://apiwebsenac21.azurewebsites.net/tipos_produto').then(response => {
      this.tipos_produto = response.data;
    });
  },
  methods: {
    salvarProduto() {
      const produto_id = this.$route.params.id;
      axios.put(`https://apiwebsenac21.azurewebsites.net/produtos/${produto_id}`, this.produto).then(() => {
        this.$router.push({ name: 'produtos-list' });
      });
    }
  }
};
</script>
