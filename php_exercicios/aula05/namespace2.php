<?php
    require_once 'aluno.php';

    use cefet\Aluno;
    use cefet\Turma;

    $a = new Aluno('Bia', new Turma());
    $a->turma->descricao = '3002';
    echo $a->nome,' da turma ', $a->turma->descricao, PHP_EOL;

    $b = new Aluno('Maria', new Turma());
    $b->turma->descricao = '3001';
    echo $b->nome,' da turma ', $b->turma->descricao;
?>      