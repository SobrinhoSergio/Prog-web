<?php
echo 'Seja bem-vindo(a). Agora são ',
    (new DateTime('now',
        new DateTimeZone('America/Sao_Paulo'))
    )->format('d-m-Y H:n');
?>