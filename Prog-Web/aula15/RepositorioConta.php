<?php

namespace acme;

class RepositorioException extends \RuntimeException{}

class Conta {
    public int $id;
    public string $descricao;
    public float $valor;

    public function __construct(int $id = 0, string $descricao = '', float $valor = 0.0) {
        $this->id = $id;
        $this->descricao = $descricao;
        $this->valor = $valor;
    }
}

interface RepositorioConta{

    function conta();
    
    function adicionar(Conta $c);
}



