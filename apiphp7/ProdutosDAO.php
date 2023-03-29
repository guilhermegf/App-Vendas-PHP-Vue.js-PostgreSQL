<?php
/*
    * Autor: Gulherme Gonçalves de Freitas 
    * Data: 25/03/2023
    * Classe para produtos
*/

class ProdutosDAO {
    private $pdo;

    public function __construct() {
        $this->pdo = Singleton::getInstance();
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare('SELECT 
                                        produtos.id, 
                                        produtos.nome, 
                                        produtos.descricao, 
                                        produtos.marca, 
                                        produtos.quantidade_estoque, 
                                        produtos.preco, 
                                        produtos.tipo_id,     
                                        tipos_produto.nome as nome_tipo_produto,
                                        ROUND((tipos_produto.imposto_percentual * produtos.preco)/100,2) as imposto_unitario
                                    FROM produtos
                                    JOIN tipos_produto ON produtos.tipo_id = tipos_produto.id 
                                    WHERE produtos.id = :id');
        $stmt->execute(array(':id' => $id));
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAll() {
        $stmt = $this->pdo->query('SELECT 
                                    produtos.id, 
                                    produtos.nome, 
                                    produtos.descricao, 
                                    produtos.marca, 
                                    produtos.quantidade_estoque, 
                                    produtos.preco, 
                                    produtos.tipo_id,     
                                    tipos_produto.nome as nome_tipo_produto,
                                    ROUND((tipos_produto.imposto_percentual * produtos.preco)/100,2) as imposto_unitario
                                FROM produtos
                                JOIN tipos_produto ON produtos.tipo_id = tipos_produto.id
                                order by produtos.id');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert($nome, $descricao, $marca, $quantidade_estoque, $preco, $tipo_id) {
        $stmt = $this->pdo->prepare('INSERT INTO produtos (nome, descricao, marca, quantidade_estoque, preco, tipo_id) VALUES (:nome, :descricao, :marca, :quantidade_estoque, :preco, :tipo_id)');
        return $stmt->execute(array(':nome' => $nome, ':descricao' => $descricao, ':marca' => $marca, ':quantidade_estoque' => $quantidade_estoque, ':preco' => $preco, ':tipo_id' => $tipo_id));
    }

    public function update($id, $nome, $descricao, $marca, $quantidade_estoque, $preco, $tipo_id) {
        $stmt = $this->pdo->prepare('UPDATE produtos SET nome = :nome, descricao = :descricao, marca = :marca, quantidade_estoque = :quantidade_estoque, preco = :preco, tipo_id = :tipo_id WHERE id = :id');
        return $stmt->execute(array(':id' => $id, ':nome' => $nome, ':descricao' => $descricao, ':marca' => $marca, ':quantidade_estoque' => $quantidade_estoque, ':preco' => $preco, ':tipo_id' => $tipo_id));
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare('DELETE FROM produtos WHERE id = :id');
        return $stmt->execute(array(':id' => $id));
    }

    public function getProdutosByTipoId($tipo_id) {
        $stmt = $this->pdo->prepare('SELECT 
                                        produtos.id                                       
                                    FROM produtos
                                    JOIN tipos_produto ON produtos.tipo_id = tipos_produto.id
                                    WHERE produtos.tipo_id = :tipo_id
                                    ORDER BY produtos.id');
        $stmt->execute(array(':tipo_id' => $tipo_id));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateQuantity($produto_id, $quantidade) {
        error_log("qte: ".$quantidade." produto: ".$produto_id, 0);
        $stmt = $this->pdo->prepare("UPDATE produtos SET quantidade_estoque = quantidade_estoque + :quantidade WHERE id = :produto_id");
        $stmt->bindParam(":produto_id", $produto_id, PDO::PARAM_INT);
        $stmt->bindParam(":quantidade", $quantidade, PDO::PARAM_INT);
        return $stmt->execute();
    }
    
}
