<?php
    interface Impressora{
        function imprimir($valor);
    }

    class ImpressoraEmConsole implements Impressora{
        public function imprimir ($valor){
            echo $valor;
        }
    }

    class ImpressoraEmArquivo implements Impressora{
        public function imprimir($valor){
            //Obtém conteudo do arquivo como string
            $conteudo = @file_get_contents('saida.txt');
            if($conteudo === false){
                $conteudo = '';
            }
            //Guarda o conteudo do arquivo como string
            file_put_contents('saida.txt', $conteudo . $valor);
        }
    }

    function gerarSaida(array $palavras, Impressora $impressora){
        foreach($palavras as $p){
            $impressora->imprimir($p . "\n");
        }
    }

    $palavras = ['Progrmacao para web', 'CEFET/RJ', 'Nova Friburgo'];
    gerarSaida($palavras, new ImpressoraEmConsole());
    gerarSaida($palavras, new ImpressoraEmArquivo());
?>