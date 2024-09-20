<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Cadastro de Conta</h1>
    
    <form method="POST" action="cadastrar.php" >
        <input type="hidden" name="id" value="50" >
        <label for="descricao">Descrição:</label>
        <input type="text" id="descricao" name="descricao" >
        
        <label for="tipo">Tipo:</label>
        <fieldset id="tipo" name="tipo">
            <input type="radio" name="tipo" value="P" id="Pagar" checked/>  
            <label for="pagar" accesskey="P">Pagar</label>     
            <input type="radio" name="tipo" value="R" id="Receber"/>  
            <label for="receber" accesskey="R">Receber</label>     
        </fieldset>

        <label for="valor">Valor: </label>
        <input type="number" name="valor" id="valor"/>

        <label for="vencimento">Vencimento: </label>
        <input type="date" name="vencimento" id="vencimento"/>

        <input for="checkbox" name="paga" id="paga" value="1"/>
        <label for="paga">Paga</label>

        <button type="submit" id="enviar">Enviar</button>
    </form>
</body>
</html>