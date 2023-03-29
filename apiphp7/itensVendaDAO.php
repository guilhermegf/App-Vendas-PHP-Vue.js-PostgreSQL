<?php
/*
    * Autor: Gulherme Gonçalves de Freitas 
    * Data: 25/03/2023
    * Classe para itens de venda
*/

class ItensVendaDAO {
    private $pdo;

    public function __construct() {
        $this->pdo = Singleton::getInstance();
    }

    public function insert($venda_id, $produto_id, $quantidade, $preco_unitario, $imposto_unitario) {
        $stmt = $this->pdo->prepare('INSERT INTO itens_venda (produto_id, venda_id, quantidade, preco_unitario, imposto_unitario) VALUES (:produto_id, :venda_id, :quantidade, :preco_unitario, :imposto_unitario)');
        return $stmt->execute(array(':produto_id' => $produto_id, ':venda_id' => $venda_id, ':quantidade' => $quantidade, ':preco_unitario' => $preco_unitario, ':imposto_unitario' => $imposto_unitario));
    }

    public function getByVendaId($venda_id) {
        $stmt = $this->pdo->prepare('SELECT 
                                        itens_venda.id,
                                        itens_venda.produto_id,
                                        itens_venda.venda_id,
                                        itens_venda.quantidade,
                                        itens_venda.preco_unitario,
                                        itens_venda.imposto_unitario,
                                        produtos.nome,
                                        produtos.descricao
                                     FROM itens_venda
                                     JOIN produtos ON (produtos.id = itens_venda.produto_id)
                                     WHERE venda_id = :venda_id');
        $stmt->execute(array(':venda_id' => $venda_id));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare('DELETE FROM itens_venda WHERE id = :id');
        return $stmt->execute(array(':id' => $id));
    }

    public function update($id, $produto_id, $quantidade, $preco_unitario, $imposto_unitario) {
        $stmt = $this->pdo->prepare('UPDATE itens_venda SET produto_id = :produto_id, quantidade = :quantidade, preco_unitario = :preco_unitario, imposto_unitario = :imposto_unitario WHERE id = :id');
        return $stmt->execute(array(':id' => $id, ':produto_id' => $produto_id, ':quantidade' => $quantidade, ':preco_unitario' => $preco_unitario, ':imposto_unitario' => $imposto_unitario));
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare('SELECT * FROM itens_venda WHERE id = :id');
        $stmt->execute(array(':id' => $id));
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteByVendaId($venda_id) {
        $stmt = $this->pdo->prepare('DELETE FROM itens_venda WHERE venda_id = :venda_id');
        return $stmt->execute(array(':venda_id' => $venda_id));
    }

    public function getItensVendaByProdutoId($id) {
        $stmt = $this->pdo->prepare('SELECT 
                                        itens_venda.id                                       
                                    FROM itens_venda
                                    JOIN produtos ON produtos.id = itens_venda.produto_id
                                    WHERE itens_venda.produto_id = :produto_id
                                    ORDER BY produtos.id');
        $stmt->execute(array(':produto_id' => $id));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}

