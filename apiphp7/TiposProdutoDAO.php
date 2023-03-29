<?php
/*
    * Autor: Gulherme Gonçalves de Freitas 
    * Data: 25/03/2023
    * Classe para para tipos de produtos
*/

class TiposProdutoDAO {
    private $pdo;

    public function __construct() {
        $this->pdo = Singleton::getInstance();
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare('SELECT * FROM tipos_produto WHERE id = :id');
        $stmt->execute(array(':id' => $id));
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAll() {
        $stmt = $this->pdo->query('SELECT * FROM tipos_produto order by id');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert($nome, $imposto_percentual) {
        $stmt = $this->pdo->prepare('INSERT INTO tipos_produto (nome, imposto_percentual) VALUES (:nome, :imposto_percentual)');
        return $stmt->execute(array(':nome' => $nome, ':imposto_percentual' => $imposto_percentual));
    }

    public function update($id, $nome, $imposto_percentual) {
        $stmt = $this->pdo->prepare('UPDATE tipos_produto SET nome = :nome, imposto_percentual = :imposto_percentual WHERE id = :id');
        return $stmt->execute(array(':id' => $id, ':nome' => $nome, ':imposto_percentual' => $imposto_percentual));
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare('DELETE FROM tipos_produto WHERE id = :id');
        return $stmt->execute(array(':id' => $id));
    }
}
