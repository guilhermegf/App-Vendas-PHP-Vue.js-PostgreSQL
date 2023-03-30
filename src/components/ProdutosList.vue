<template>
  <div>
    <router-link to="/produtos/add" style="float: left; margin-right: 10px;">
      <button class="btn btn-primary">+</button>
    </router-link>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nome</th>
          <th>Descrição</th>
          <th>Marca</th>
          <th>Preço (R$)</th>          
          <th>Quantidade em Estoque</th>
          <th>Tipo de Produto</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="produto in produtos" :key="produto.id">
          <td>{{ produto.id }}</td>
          <td>{{ produto.nome }}</td>
          <td>{{ produto.descricao }}</td>
          <td>{{ produto.marca }}</td>
          <td>{{ produto.preco.toString().replace('.', ',') }}</td>
          <td>{{ produto.quantidade_estoque }}</td>
          <td>{{ produto.nome_tipo_produto }}</td>
          <td>
            <button @click="editarProduto(produto.id)" class="btn btn-primary">Editar</button>
            <button @click="deleteProduto(produto.id)" :disabled="produto.temItensVenda" class="btn btn-danger">Excluir</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
<script>
import axios from 'axios';

export default {
  data() {
    return {
      produtos: []
    };
  },
  created() {
    axios.get('http://localhost:8000/produtos').then(response => {
      //console.log(response.data);
      this.produtos = response.data;
      // Verifica se há itens venda para cada produto e adiciona a propriedade 'temItensVenda'
      this.produtos.forEach(produto => {
        axios.get(`http://localhost:8000/temitensvenda/${produto.id}`).then(response => {
          produto.temItensVenda = response.data.length > 0;
        });
      });
    });
  },
  methods: {
    deleteProduto(id) {
      axios.delete(`http://localhost:8000/produtos/${id}`).then(() => {
        // Atualiza a lista de produtos
        this.produtos = this.produtos.filter(produto => produto.id !== id);
      });
    },
    editarProduto(id) {
      this.$router.push({ name: 'produtos-edit', params: { id } });
    }
  }
};
</script>