<template>
  <div>
    <router-link to="/vendas/add" style="float: left; margin-right: 10px;">
      <button class="btn btn-primary">+</button>
    </router-link>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Data / Hora</th>
          <th>Valor Total (R$)</th>
          <th>Valor dos Impostos (R$)</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="venda in vendas" :key="venda.id">
          <td>{{ venda.id }}</td>
          <td>{{ formatarData(venda.data_hora) }}</td>
          <td>{{ venda.valor_total.toString().replace('.', ',') }}</td>
          <td>{{ venda.valor_impostos.toString().replace('.', ',') }}</td>
          <td><button @click="visualizarVenda(venda.id)" class="btn btn-primary">Visualizar</button></td>
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
      vendas: []
    };
  },
  created() {
    axios.get('http://localhost:8000/vendas').then(response => {
      //console.log(response.data);
      this.vendas = response.data;      
    });
  },
  methods: {
    formatarData(data) {
      const dataObj = new Date(data);
      return `${dataObj.getDate().toString().padStart(2, '0')}/${(dataObj.getMonth()+1).toString().padStart(2, '0')}/${dataObj.getFullYear()} ${dataObj.getHours()}:${dataObj.getMinutes()}`;

    },
    visualizarVenda(id) {
      this.$router.push({ name: 'venda-view', params: { id } });
    }
  }
};
</script>