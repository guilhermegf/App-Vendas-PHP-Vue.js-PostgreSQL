<template>
  <div>
    <form @submit.prevent="submitForm">
    <div class="form-group">    
        <label for="nome" class="form-control">Nome: </label>
        <input type="text" v-model="tipo.nome" required class="form-control"/>       
      </div>
      <div class="form-group">        
        <label for="imposto_percentual" class="form-control">Imposto Percentual (%): </label>
        <input type="number" v-model="tipo.imposto_percentual" required class="form-control"/>       
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
      tipo: {
        id: null,
        nome: '',
        imposto_percentual: null
      }
    };
  },
  computed: {
    imposto_percentual() {
      return parseFloat(this.imposto.replace(',', '.'));
    }
  },
  created() {
    const id = this.$route.params.id;
    axios.get(`https://apiwebsenac21.azurewebsites.net/tipos_produto/${id}`).then(response => {
      this.tipo = response.data;
    });
  },
  methods: {
    submitForm() {
      const id = this.tipo.id;
      axios.put(`https://apiwebsenac21.azurewebsites.net/tipos_produto/${id}`, this.tipo).then(() => {
        this.$router.push({ name: 'tipos-produto-list' });
      });
    }
  }
};
</script>
