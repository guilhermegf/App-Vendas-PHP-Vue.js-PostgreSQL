<?php
/*
    * Autor: Gulherme Gonçalves de Freitas 
    * Data: 25/03/2023
    * API para tabelas de: tipos de produtos, produtos, vendas e itens de venda
*/

require_once 'Singleton.php';
require_once 'TiposProdutoDAO.php';
require_once 'ProdutosDAO.php';
require_once 'ItensVendaDAO.php';
require_once 'VendasDAO.php';

// Adiciona headers para permitir solicitações de qualquer origem, método ou cabeçalho
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// Recebe a requisição
$method = $_SERVER['REQUEST_METHOD'];
$path = $_SERVER['PATH_INFO'] ?? '/';

error_log("method: ".$method, 0);
error_log("path: ".$path, 0);

// Verifica se o método é OPTIONS e responde com os headers apropriados
if ($method === 'OPTIONS') {
    http_response_code(204);
    exit();
}

// Cria as instâncias das classes DAO
$tiposProdutoDAO = new TiposProdutoDAO();
$produtosDAO = new ProdutosDAO();
$vendasDAO = new VendasDAO();
$itensVendaDAO = new ItensVendaDAO();

// Verifica qual método HTTP foi utilizado e qual endpoint foi acessado
if ($method === 'GET' && $path === '/tipos_produto') {

    $data = $tiposProdutoDAO->getAll();
    echo json_encode($data);

} elseif ($method === 'GET' && preg_match('/' . preg_quote('/tipos_produto/', '/') . '(\d+)/', $path, $matches)) {

    $id = $matches[1];
    $data = $tiposProdutoDAO->getById($id);
    echo json_encode($data);

} elseif ($method === 'POST' && $path === '/tipos_produto') {

    $data = json_decode(file_get_contents('php://input'), true);
    $nome = $data['nome'];
    $imposto_percentual = $data['imposto_percentual'];
    $success = $tiposProdutoDAO->insert($nome, $imposto_percentual);
    http_response_code($success ? 201 : 500);

} elseif ($method === 'PUT' && preg_match('/' . preg_quote('/tipos_produto/', '/') . '(\d+)/', $path, $matches)) {

    $id = $matches[1];
    $data = json_decode(file_get_contents('php://input'), true);
    $nome = $data['nome'];
    $imposto_percentual = $data['imposto_percentual'];
    $success = $tiposProdutoDAO->update($id, $nome, $imposto_percentual);
    http_response_code($success ? 200 : 500);

} elseif ($method === 'DELETE' && preg_match('/' . preg_quote('/tipos_produto/', '/') . '(\d+)/', $path, $matches)) {

    $id = $matches[1];
    $success = $tiposProdutoDAO->delete($id);
    http_response_code($success ? 200 : 500);

} elseif ($method === 'GET' && $path === '/produtos') {

    $data = $produtosDAO->getAll();
    echo json_encode($data);

} elseif ($method === 'GET' && preg_match('/' . preg_quote('/produtos/', '/') . '(\d+)/', $path, $matches)) {

    $id = $matches[1];
    $data = $produtosDAO->getById($id);
    echo json_encode($data);

} elseif ($method === 'POST' && $path === '/produtos') {
    
    $data = json_decode(file_get_contents('php://input'), true);
    $nome = $data['nome'];
    $descricao = $data['descricao'];
    $marca = $data['marca'];
    $quantidade_estoque = $data['quantidade_estoque'];
    $preco = $data['preco'];
    $tipo_id = $data['tipo_id'];
    $success = $produtosDAO->insert($nome, $descricao, $marca, $quantidade_estoque, $preco, $tipo_id);
    http_response_code($success ? 201 : 500);

} elseif ($method === 'PUT' && preg_match('/' . preg_quote('/produtos/', '/') . '(\d+)/', $path, $matches)) {

    $id = $matches[1];
    $data = json_decode(file_get_contents('php://input'), true);
    $nome = $data['nome'];
    $descricao = $data['descricao'];
    $marca = $data['marca'];
    $quantidade_estoque = $data['quantidade_estoque'];
    $preco = $data['preco'];
    $tipo_id = $data['tipo_id'];
    $success = $produtosDAO->update($id, $nome, $descricao, $marca, $quantidade_estoque, $preco, $tipo_id);
    http_response_code($success ? 200 : 500);

} elseif ($method === 'DELETE' && preg_match('/' . preg_quote('/produtos/', '/') . '(\d+)/', $path, $matches)) {

    $id = $matches[1];
    error_log("apagar produto: ".$id, 0);
    $success = $produtosDAO->delete($id);
    error_log("sucesso: ".$success, 0);
    http_response_code($success ? 200 : 500);

} elseif ($method === 'GET' && preg_match('/' . preg_quote('/temitensvenda/', '/') . '(\d+)/', $path, $matches)) {

    $id = $matches[1];
    $data = $itensVendaDAO->getItensVendaByProdutoId($id);
    echo json_encode($data);    

} elseif ($method === 'GET' && preg_match('/' . preg_quote('/temprodutos/', '/') . '(\d+)/', $path, $matches)) {

    $tipoId = $matches[1];
    $data = $produtosDAO->getProdutosByTipoId($tipoId);
    echo json_encode($data);

} elseif ($method === 'GET' && $path === '/vendas') {

    $data = $vendasDAO->getAll();
    echo json_encode($data);

} elseif ($method === 'GET' && preg_match('/' . preg_quote('/vendas/', '/') . '(\d+)/', $path, $matches)) {

    $id = $matches[1];
    $data = $vendasDAO->getById($id);
    $itens = $itensVendaDAO->getByVendaId($id);

    $itensArray = array();
    foreach ($itens as $item) {
        $itensArray[] = array(
            'produto_id' => $item['produto_id'],
            'quantidade' => $item['quantidade'],
            'preco_unitario' => $item['preco_unitario'],
            'imposto_unitario' => $item['imposto_unitario'],
            'nome' => $item['nome'],
            'descricao' => $item['descricao']
        );
    }

    $result = array(
        'id' => $data['id'],
        'data_hora' => $data['data_hora'],
        'valor_total' => $data['valor_total'],
        'valor_impostos' => $data['valor_impostos'],
        'itens' => $itensArray
    );

    echo json_encode($result);

} elseif ($method === 'POST' && $path === '/vendas') {

    $data = json_decode(file_get_contents('php://input'), true);
    $valor_total = $data['valor_total'];
    $valor_impostos = $data['valor_impostos'];
    $itens = $data['itens'];
    $id_venda = $vendasDAO->insert($valor_total,$valor_impostos);

    if ($id_venda) {
        foreach ($itens as $item) {
            $produto_id = $item['produto_id'];
            $quantidade = $item['quantidade'];
            $preco_unitario = $item['preco_unitario'];
            $imposto_unitario = $item['imposto_unitario'];
            $success = $itensVendaDAO->insert($id_venda, $produto_id, $quantidade, $preco_unitario, $imposto_unitario);
            
            if (!$success) {       
                http_response_code(500);
                exit();                
            } else { 
                $success = $produtosDAO->updateQuantity($produto_id, -$quantidade);
                if (!$success) {      
                    http_response_code(500);
                    exit();                    
                }
            }
        }

        http_response_code(201);
    } else {
        http_response_code(500);
    }

} elseif ($method === 'PUT' && preg_match('/' . preg_quote('/vendas/', '/') . '(\d+)/', $path, $matches)) {

    $id = $matches[1];
    $data = json_decode(file_get_contents('php://input'), true);
    $valor_total = $data['valor_total'];
    $valor_impostos = $data['valor_impostos'];
    $itens = $data['itens'];
    $success = $vendasDAO->update($id, $valor_total, $valor_impostos);

    if ($success) {
        $itensVendaDAO->deleteByVendaId($id);
        foreach ($itens as $item) {
            $produto_id = $item['produto_id'];
            $quantidade = $item['quantidade'];
            $preco_unitario = $item['preco_unitario'];
            $imposto_unitario = $item['imposto_unitario'];
            $success = $itensVendaDAO->insert($id, $produto_id, $quantidade, $preco_unitario, $imposto_unitario);

            if (!$success) {
                http_response_code(500);
                exit();
            }
        }

        http_response_code(200);
    } else {
        http_response_code(500);
    }

} elseif ($method === 'DELETE' && preg_match('/' . preg_quote('/vendas/', '/') . '(\d+)/', $path, $matches)) {

    $id = $matches[1];
    $success = $vendasDAO->delete($id);
    http_response_code($success ? 200 : 500);

} elseif ($method === 'GET' && preg_match('/' . preg_quote('/itens_venda/', '/') . '(\d+)/', $path, $matches)) {

    $id = $matches[1];
    $data = $itensVendaDAO->getById($id);
    echo json_encode($data);

} elseif ($method === 'GET' && preg_match('/' . preg_quote('/itens_venda_venda_id/', '/') . '(\d+)/', $path, $matches)) {

    $venda_id = $matches[1];
    $data = $itensVendaDAO->getByVendaId($venda_id);
    echo json_encode($data);

} elseif ($method === 'POST' && preg_match('/' . preg_quote('/itens_venda/', '/') . '(\d+)/', $path, $matches)) {

    $venda_id = $matches[1];
    $data = json_decode(file_get_contents('php://input'), true);
    $produto_id = $data['produto_id'];
    $quantidade = $data['quantidade'];
    $preco_unitario = $data['preco_unitario'];
    $imposto_unitario= $data['imposto_unitario'];
    $success = $itensVendaDAO->insert($venda_id, $produto_id, $quantidade, $preco_unitario, $imposto_unitario);
    http_response_code($success ? 200 : 500);

} elseif ($method === 'PUT' && preg_match('/' . preg_quote('/itens_venda/', '/') . '(\d+)/', $path, $matches)) {

    $id = $matches[1];
    
    $data = json_decode(file_get_contents('php://input'), true);
    $produto_id = $data['produto_id'];
    $quantidade = $data['quantidade'];
    $preco_unitario = $data['preco_unitario'];
    $imposto_unitario= $data['imposto_unitario'];

    error_log($id.' '.$produto_id.' '.$quantidade.' '.$preco_unitario.' '.$imposto_unitario);
    $success = $itensVendaDAO->update($id, $produto_id, $quantidade, $preco_unitario, $imposto_unitario);
    http_response_code($success ? 200 : 500);

} elseif ($method === 'DELETE' && preg_match('/' . preg_quote('/itens_venda/', '/') . '(\d+)/', $path, $matches)) {

    $id = $matches[1];
    $success = $itensVendaDAO->delete($id);
    http_response_code($success ? 200 : 500);

} elseif ($method === 'DELETE' && preg_match('/' . preg_quote('/itens_venda_venda_id/', '/') . '(\d+)/', $path, $matches)) {

    $venda_id = $matches[1];
    $success = $itensVendaDAO->deleteByVendaId($venda_id);
    http_response_code($success ? 200 : 500);

} else {

    http_response_code(404);
    echo json_encode(array('error' => 'Endpoint nao encontrado.'));
    
}
