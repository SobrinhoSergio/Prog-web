<?php
require_once 'src/MenuConta.php';
require_once 'src/ControladoraConta.php';

$menu = new MenuConta();
$controladora = new ControladoraConta();

if ($menu->desejaCadastrarConta()) {
    $controladora->cadastrarConta();
} elseif ($menu->desejaRemoverConta()) {
    $controladora->removerConta();
} elseif ($menu->desejaAtualizarConta()) {
    $controladora->atualizarConta();
} else {
    $menu->mostrarOpcaoInvalida();
}
