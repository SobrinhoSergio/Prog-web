<?php

namespace acme;

class RepositorioException extends \RuntimeException{}

class FrasecomAutor{
    public $id;
    public $texto;
    public $nota;
    public $nomeAutor;
}

interface RepositorioFrases{
    
    function frasesComAutor();
    
    function removerFrasesComNotaMenorOuIgualA(int $nota);
}