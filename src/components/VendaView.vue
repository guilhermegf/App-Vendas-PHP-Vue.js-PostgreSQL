<template>
  <div>
    <h1>Detalhes da venda {{ venda.id }}</h1>
    <p>Data/Hora: {{ formatarData(venda.data_hora) }}</p>
    <p>Valor total: R$ {{ (venda.valor_total).toString().replace('.', ',') }}</p>
    <p>Valor impostos: R$ {{ (venda.valor_impostos).toString().replace('.', ',') }}</p>
    <h2>Itens</h2>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Produto</th>
          <th>Quantidade</th>
          <th>Preço Unitário</th>
          <th>Imposto Unitário</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="item in venda.itens" :key="item.produto_id">
          <td>{{ item.nome }}</td>
          <td>{{ item.quantidade }}</td>
          <td>R$ {{ (item.preco_unitario).toString().replace('.', ',') }}</td>
          <td>R$ {{ (item.imposto_unitario).toString().replace('.', ',') }}</td>
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
      venda: {}
    };
  },
  created() {
    const id = this.$route.params.id;
    axios.get(`https://apiwebsenac21.azurewebsites.net/vendas/${id}`).then(response => {
      this.venda = response.data;
    });
  },
  methods: {
    formatarData(data) {
      const dataObj = new Date(data);
      return `${dataObj.getDate().toString().padStart(2, '0')}/${(dataObj.getMonth()+1).toString().padStart(2, '0')}/${dataObj.getFullYear()} ${dataObj.getHours()}:${dataObj.getMinutes()}`;

    }
  }
};
</script>
