<?php
$nome = readline( 'Nome: ' );
echo $nome, ' tem ', mb_strlen( $nome ), ' caracteres', PHP_EOL;

$posicao = mb_strpos( $nome, 'a' );
echo ( $posicao === false ? 'Não tem "a"' : 'Tem "a"' ), PHP_EOL;

echo 'Trocando "a" por "e"...', PHP_EOL;
echo str_replace( ['A', 'a'], 'e', $nome, $substuicoes ), PHP_EOL;
echo 'Foram feitas ', $substuicoes, ' substituições.', PHP_EOL;

echo str_repeat( '-', 40 ), PHP_EOL;

?>