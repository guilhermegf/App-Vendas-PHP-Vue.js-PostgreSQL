<template>
  <div>
    <h2>Vendas</h2>
    <table class="table table-striped">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Preço</th>
            <th>Imposto Unitário</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <tr v-for="produto in produtos" :key="produto.id">
            <td>{{ produto.nome }}</td>
            <td>R$ {{ (produto.preco).toString().replace('.', ',') }}</td>
            <td>R$ {{ (produto.imposto_unitario).toString().replace('.', ',') }}</td>
            <td>
                <button @click="adicionar(produto)" class="btn btn-primary">+</button>
                <button @click="remover(produto)" class="btn btn-danger">-</button>
            </td>
        </tr>
    </tbody>
    </table>
    <h2>Carrinho</h2>
    <table class="table table-striped">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Preço</th>
            <th>Imposto</th>
            <th>Quantidade</th>
            <th>Preço Total</th>
        </tr>
    </thead>
    <tbody>
        <tr v-for="item in carrinho" :key="item.produto.id">
            <td>{{ item.produto.nome }}</td>
            <td>R$ {{ (item.produto.preco).toString().replace('.', ',') }}</td>
            <td>R$ {{ (item.produto.imposto_unitario * item.quantidade).toFixed(2).toString().replace('.', ',') }}</td>
            <td>{{ item.quantidade }}</td>
            <td>R$ {{ (parseInt(item.quantidade) * (parseFloat(item.produto.preco) + parseFloat(item.produto.imposto_unitario))).toFixed(2).toString().replace('.', ',') }}</td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td><strong>R$ {{ totalImpostoCarrinho.toFixed(2).toString().replace('.', ',') }}</strong></td>
            <td></td>
            <td><strong>R$ {{ totalPrecoCarrinho.toFixed(2).toString().replace('.', ',') }}</strong></td>
        </tr>
    </tbody>
    </table>
    <br>
    <button @click="salvarVenda" class="btn btn-primary">Salvar</button>
  </div>
</template>

<script>
export default {
  data() {
    return {
      produtos: [],
      carrinho: [],
    };
  },
  methods: {
    async carregarProdutos() {
      const response = await fetch('http://localhost:8000/produtos');
      const produtos = await response.json();
      this.produtos = produtos;
    },
    adicionar(produto) {
      const item = this.carrinho.find((item) => item.produto.id === produto.id);
      if (item) {
        item.quantidade += 1;
      } else {
        this.carrinho.push({
          produto,
          quantidade: 1,
        });
      }
    },
    remover(produto) {
      const itemIndex = this.carrinho.findIndex((item) => item.produto.id === produto.id);
      if (itemIndex !== -1) {
        const item = this.carrinho[itemIndex];
        if (item.quantidade > 1) {
          item.quantidade -= 1;
        } else {
          this.carrinho.splice(itemIndex, 1);
        }
      }
    },
    async salvarVenda() {
      const itens = this.carrinho.map((item) => ({
        produto_id: item.produto.id,
        quantidade: item.quantidade,
        preco_unitario: item.produto.preco,
        imposto_unitario: item.produto.imposto_unitario,
      }));
      const valor_total = this.totalPrecoCarrinho;
      const valor_impostos = this.totalImpostoCarrinho;
      const response = await fetch('http://localhost:8000/vendas', {
        method: 'POST',
        body: JSON.stringify({
          valor_total,
          valor_impostos,
          itens,
        }),
        headers: {
          'Content-Type': 'application/json',
        },
      });
      response.json();
      this.$router.push('/vendas');
    },
  },
  computed: {
    totalPrecoCarrinho() {
      return this.carrinho.reduce((total, item) => {
        const precoTotalItem = (parseFloat(item.produto.preco) + parseFloat(item.produto.imposto_unitario)) * parseInt(item.quantidade);
        return total + precoTotalItem;
      }, 0);
    },
    totalImpostoCarrinho() {
      return this.carrinho.reduce((total, item) => {
        const precoTotalItem = parseFloat(item.produto.imposto_unitario) * parseInt(item.quantidade);
        return total + precoTotalItem;
      }, 0);
    },
  },
  created() {
    this.carregarProdutos();
  },
};
</script>
