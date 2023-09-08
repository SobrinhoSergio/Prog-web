<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<p>
<?php
$desc = $_POST['descricao'];
$regexd = "/^[A-Z][A-Za-z\-. ]{1,99}$/";
if(preg_match($regexd,$desc)){
    echo "Descricao valida.";
}else{
    echo "Descricao invalida";
}
?>
</p>
<p>
<?php
$val = $_POST['validade'];
$regexv = "/^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[0-2])\/[0-9]{4}$/";
if(preg_match($regexv,$val)){
    echo "Data valida.";
}else{
    echo "Data invalida";
}
?>

<p>
<?php

$est = $_POST['estoque'];
$regexe = "/^-?[0-1000000]+$/";
if(preg_match($regexe,$est)){
    echo "Estoque valida.";
}else{
    echo "Estoque invalido";
}
?>
</p>    
</body>
</html>
