<?php
require_once 'src/ControladoraCalculo.php';
require_once 'src/VisaoCalculoEmWeb.php';

$visao = new VisaoCalculoEmWeb();
$controladora = new ControladoraCalculo( $visao );
$controladora->realizarOperacao();