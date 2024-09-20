<?php

require_once "conexao.php";
require_once "RepositorioFrasesEmBDR.php";

function listagemFrases(){

    $pdo = null;

    try{

        $pdo = conectar();
        
        $repositorio = new RepositorioFrasesEmBDR($pdo);
        
        $frases = $repositorio->FrasesComAutor();

        echo <<<HTML
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Frase</th>
                        <th>Nota</th>
                        <th>Autor</th>
                    </tr>
                </thead>
                <tbody>
        HTML;

        foreach ($frases as $frase) {
            echo <<<HTML
                    <tr>
                        <td>{$frase->id}</td>
                        <td>{$frase->texto}</td>
                        <td>{$frase->nota}</td>
                        <td>{$frase->nomeAutor}</td>
                    </tr>
            HTML;
        }

        echo <<<HTML
                </tbody>
            </table>
        HTML;

        http_reponse_code(200);

    }catch (Exception $e) {
        http_response_code(500);
        die("Erro ao acessar o banco de dados: " . $e->getMessage());
    }

}



