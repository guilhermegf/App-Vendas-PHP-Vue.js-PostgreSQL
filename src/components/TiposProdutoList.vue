<template>
  <div>
    <router-link to="/tipos_produto/add" style="float: left; margin-right: 10px;">
      <button class="btn btn-primary">+</button>
    </router-link>
    <table class="table table-striped" >
      <thead>
        <tr>
          <th>ID</th>
          <th>Nome</th>
          <th>Imposto Percentual (%)</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="tipo in tipos" :key="tipo.id">
          <td>{{ tipo.id }}</td>
          <td>{{ tipo.nome }}</td>
          <td>{{ tipo.imposto_percentual.toString().replace('.', ',') }}</td>
          <td>
            <button @click="editTipo(tipo.id)" class="btn btn-primary">Editar</button>
            <button @click="deleteTipo(tipo.id)" :disabled="tipo.temProdutos" class="btn btn-danger">Excluir</button>
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
      tipos: []
    };
  },
  created() {
    axios.get('http://localhost:8000/tipos_produto').then(response => {
      this.tipos = response.data;
      // Verifica se há produtos para cada tipo e adiciona a propriedade 'temProdutos'
      this.tipos.forEach(tipo => {
        axios.get(`http://localhost:8000/temprodutos/${tipo.id}`).then(response => {
          tipo.temProdutos = response.data.length > 0;
        });
      });
    });
  },
  methods: {
    deleteTipo(id) {
      //axios.defaults.xsrfCookieName = 'csrftoken';
      //axios.defaults.xsrfHeaderName = 'X-CSRFToken';
      axios.delete(`http://localhost:8000/tipos_produto/${id}`).then(() => {
        // Atualiza a lista de tipos de produto
        this.tipos = this.tipos.filter(tipo => tipo.id !== id);
      });
    },
    editTipo(id) {
      this.$router.push({ name: 'tipos-produto-edit', params: { id: id } });
    }
  }
};
</script>

<style>
.mdi-plus {
  font-size: 2em;
}
</style>