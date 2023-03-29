<?php
/*
    * Autor: Gulherme Gonçalves de Freitas 
    * Data: 25/03/2023
    * Classe para vendas
*/

require_once 'ItensVendaDAO.php';

class VendasDAO {
    private $pdo;
    private $itensVendaDAO;

    public function __construct() {
        $this->pdo = Singleton::getInstance();
        $this->itensVendaDAO = new ItensVendaDAO();
    }

    public function insert($valor_total, $valor_impostos) {
        $stmt = $this->pdo->prepare('INSERT INTO vendas (data_hora, valor_total, valor_impostos) VALUES (CURRENT_TIMESTAMP, :valor_total, :valor_impostos)');
        $success = $stmt->execute(array(':valor_total' => $valor_total, ':valor_impostos' => $valor_impostos));
        if ($success) {
            return $this->pdo->lastInsertId();
        } else {
            return false;
        }
    }    

    public function getById($id) {
        $stmt = $this->pdo->prepare('SELECT * FROM vendas WHERE id = :id');
        $stmt->execute(array(':id' => $id));
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function delete($id) {
        $itensVendaDAO = new ItensVendaDAO();
        $itensVenda = $itensVendaDAO->getByVendaId($id);
        foreach ($itensVenda as $item) {
            $itensVendaDAO->delete($item['id']);
        }
        $stmt = $this->pdo->prepare('DELETE FROM vendas WHERE id = :id');
        return $stmt->execute(array(':id' => $id));
    }

    public function update($id, $valor_total, $valor_impostos) {
        $stmt = $this->pdo->prepare('UPDATE vendas SET data_hora = CURRENT_TIMESTAMP, valor_total = :valor_total, valor_impostos = :valor_impostos WHERE id = :id');
        return $stmt->execute(array(':id' => $id, ':valor_total' => $valor_total, ':valor_impostos' => $valor_impostos));
    }

    public function getAll() {
        $stmt = $this->pdo->prepare('SELECT * FROM vendas order by id desc');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
