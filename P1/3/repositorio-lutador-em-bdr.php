<?php

namespace Mma;

class LutadorRepositoryBDR implements LutadorRepositoryInterface {
    private $conn;

    public function __construct(\PDO $conn) {
        $this->conn = $conn;
    }

    public function adicionarLutador(Lutador $lutador) {
        $query = "INSERT INTO lutador (nome, peso_em_quilos, altura_em_metros) VALUES (:nome, :peso, :altura)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':nome', $lutador->nome);
        $stmt->bindValue(':peso', $lutador->pesoEmKilos);
        $stmt->bindValue(':altura', $lutador->alturaEmMetros);
        $stmt->execute();
    }

    public function removerLutadorPorId($id) {
        $query = "DELETE FROM lutador WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    }
}

?>
