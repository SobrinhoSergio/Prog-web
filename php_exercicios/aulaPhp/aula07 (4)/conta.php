<?php
class Conta {
    public $id = 0;
    public $dono = '';
    public $cpf = '';
    public $senha = '';
    public $saldo = 0.0;

    public function __construct(
        $id = 0,
        $dono = '',
        $cpf = '',
        $senha = '',
        $saldo = 0.0
    ) {
        $this->id = $id;
        $this->dono = $dono;
        $this->cpf = $cpf;
        $this->senha = $senha;
        $this->saldo = $saldo;
    }
}
?>