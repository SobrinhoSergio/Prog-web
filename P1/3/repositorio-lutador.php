<?php

namespace Mma;

interface LutadorRepositoryInterface {
    public function adicionarLutador(Lutador $lutador);
    public function removerLutadorPorId($id);
}

?>
