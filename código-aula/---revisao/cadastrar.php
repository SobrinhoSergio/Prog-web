<?php

require_once 'conta/conta.php';

$id = random_bytes(5);

$c = new Conta(
    $id,
    $_POST['descricao'],
    $_POST['tipo'],
    $_POST['valor'],
    $_POST['vencimento'],
    $_POST['paga'] == '1',

)