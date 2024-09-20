<?php

require_once 'conectar.php';
require_once 'RepositorioFraseEmBDR.php';

$pdo = null;

try{

    $pdo = conectar();

    $repositorio = new RepositorioFraseEmBDR($pdo);

    $frases = $repositorio->frasesComAutor();

    echo <<<HTML
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Nota</th>
                    <th>Autor<th>
                <tr>
            <thead>
            <tbody>
    HTML;

    foreach($frases as $f){
        echo <<<HTML
            <tr>
                <td>{$f->id}</td>
                <td>{$f->nome}</td>
                <td>{$f->nota}</td>
                <td>{$f->autor}</td>
            </tr>
    HTML;

    }

    echo <<<HTML
            </tbody>
        </table>
    HTML;

    http_reponse_code(200);

}catch(Exception $e){
    http_reponse_code(500);
    die("Error: " . $e->getMessage());
}

