<template>
  <div>
    <h1>Adicionar Tipo de Produto</h1>
    <form @submit.prevent="addTipo">
      <div class="form-group">
        <label for="nome">Nome: </label>
        <input type="text" id="nome" v-model="nome" required class="form-control">
      </div>
      <div class="form-group">
        <label for="imposto_percentual">Imposto Percentual (%): </label>
        <input type="text" id="imposto_percentual" v-model.trim="imposto" required class="form-control">
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
      nome: '',
      imposto: ''
    };
  },
  computed: {
    imposto_percentual() {
      return parseFloat(this.imposto.replace(',', '.'));
    }
  },
  methods: {
    addTipo() {
      const tipo = {
        nome: this.nome,
        imposto_percentual: this.imposto_percentual
      };
      axios.post('http://localhost:8000/tipos_produto', tipo).then(() => {
        // Redireciona para a página de listagem de tipos de produto
        this.$router.push({ name: 'tipos-produto-list' });
      });
    }
  }
};
</script>
