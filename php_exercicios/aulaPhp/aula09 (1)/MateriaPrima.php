<?php
require_once 'Categoria.php';

class MateriaPrima {

    public $id = 0;
    public $descricao = '';
    public $quantidade = 0;
    public $custo = 0.00;
    public $categoria = null;

    public function __construct(
        int $id = 0,
        string $descricao = '',
        int $quantidade = 0,
        float $custo = 0.00,
        Categoria $categoria = null
    ) {
        $this->id = $id;
        $this->descricao = $descricao;
        $this->quantidade = $quantidade;
        $this->custo = $custo;
        $this->categoria = $categoria;
    }
}

?>