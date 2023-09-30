<?php

namespace Mma;

require_once "lutador.php";

// Guardar as funcionalidades do Sistema

interface RepositorioLutador {
    public function adicionarLutador(Lutador $lutador);
    public function remover(int $id);
    public function listar();
}

?>
