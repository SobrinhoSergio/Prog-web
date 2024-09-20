<?php
require_once 'log.php';
require_once 'RepositorioContaEmBDR.php';
require_once 'conectar.php';

function criarRepositorioConta() {

    $pdo = null;

    try {
        $pdo = conectar();

        $repositorio = new RepositorioContaEmBDR( $pdo );
        
        return $repositorio;
    
    }catch ( PDOException  $e ) {
        
        logar( $e );
        
        return null;
    }    
}