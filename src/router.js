import { createRouter, createWebHistory } from 'vue-router'
import TiposProdutoList from './components/TiposProdutoList.vue';
import TiposProdutoAdd from './components/TiposProdutoAdd.vue';
import TiposProdutoEdit from './components/TiposProdutoEdit.vue';
import ProdutosList from './components/ProdutosList.vue';
import ProdutosAdd from './components/ProdutosAdd.vue';
import ProdutosEdit from './components/ProdutosEdit.vue';
import VendasList from './components/VendasList.vue';
import VendasAdd from './components/VendasAdd.vue';
import VendaView from './components/VendaView.vue';

const routes = [
  { path: '/', name: 'produtos-list', component: ProdutosList },
  { path: '/tipos_produto', name: 'tipos-produto-list', component: TiposProdutoList },
  { path: '/tipos_produto/add', name: 'tipos-produto-add', component: TiposProdutoAdd },
  { path: '/tipos_produto/:id/edit', name: 'tipos-produto-edit', component: TiposProdutoEdit },
  { path: '/produtos', name: 'produtos-list', component: ProdutosList },
  { path: '/produtos/add', name: 'produtos-add', component: ProdutosAdd },
  { path: '/produtos/:id/edit', name: 'produtos-edit', component: ProdutosEdit },
  { path: '/vendas', name: 'vendas-list', component: VendasList },
  { path: '/vendas/add', name: 'vendas-add', component: VendasAdd },
  { path: '/vendas/:id/view', name: 'venda-view', component: VendaView },
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router
