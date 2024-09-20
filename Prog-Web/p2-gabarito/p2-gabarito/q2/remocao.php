<?php
require_once 'ControladoraRemocao.php';
require_once 'VisaoRemocaoCLI.php';

$c = new ControladoraRemocao( new VisaoRemocaoCLI() );
$c->remover();
?>