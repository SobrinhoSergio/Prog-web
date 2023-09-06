<?php

class Lutador{
    public $id = 0;
    public $nome = '';
    public $pesoEmQuilos = 0.00;
    public $alturaEmMetros = 0.00;

    public function __construct($id = 0, $nome = '', $pesoEmKilos = 0.00, $alturaEmMetros = 0.00){
       $this->id = $id;
       $this->nome = $nome;
       $this->pesoEmKilos = $pesoEmKilos; 
       $this->alturaEmMetros = $alturaEmMetros;
    }
}