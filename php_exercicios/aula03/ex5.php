<?php
    $inventores = [
        [ "nome" => 'Albert', "sobrenome" => 'Einstein', "nasc" => 1879, 
        "morte" => 1955 ],
        [ "nome" => 'Isaac', "sobrenome" => 'Newton', "nasc" => 1643, 
        "morte" => 1727 ],
        [ "nome" => 'Galileo', "sobrenome" => 'Galilei', "nasc" => 1564, 
        "morte" => 1642 ],
        [ "nome" => 'Nicolaus', "sobrenome" => 'Copernicus', "nasc" => 1473, 
        "morte" => 1543 ],
        [ "nome" => 'Ada', "sobrenome" => 'Lovelace', "nasc" => 1815, 
        "morte" => 1852 ]
    ];
    //a) Crie uma função que receba o array de inventores e retorne outro array contendo o 
    //sobrenome de cada inventor e uma chave indicando quantos anos viveu
    function sobrenomeVida(array $inventores){
        $sobrenome = [];
        foreach($inventores as $inventor){
            $sobrenome[] = ['sobrenome' => $inventor['sobrenome'], 'vida' =>$inventor['morte'] - $inventor['nasc']];
        }
        return $sobrenome;
    }
    //b) Crie uma função que receba o array de inventores e retorne a média de anos vividos por eles
    function mediaVida(array $inventores){
        $idades = array_map(function($inventor) {
            return $inventor['morte'] - $inventor['nasc'];
        }, $inventores);
        return array_sum($idades) / count($idades);
    }

    //c) Crie uma função que receba o array de inventores e número de um século (ex.: 16) e 
    //retorne somente os inventores que viveram nele, mesmo que parcialmente
    function seculoVivido(array $inventores, $seculo){
        $inventoresDoSeculo = [];
        foreach($inventores as $inventor){
            if((mb_substr($inventor['nasc'],0,2) + 1) == $seculo || (mb_substr($inventor['morte'],0,2) + 1) == $seculo){
                $inventoresDoSeculo[] = $inventor;
            }
        }
        return $inventoresDoSeculo;
    }

    //d) Crie uma função que retorne os inventores ordenados pelo sobrenome.
    function ordenarSobrenome($inventores) {
        usort($inventores, function ($a, $b) {
            if ($a["sobrenome"] == $b["sobrenome"]) {
                return 0;
            }
            return ($a["sobrenome"] < $b["sobrenome"]) ? -1 : 1;
        });
        return $inventores;
      }

    //print_r(sobrenomeVida($inventores));
    //echo 'A media de anos vividos por eles é: ', mediaVida($inventores), ' anos.', PHP_EOL;
    //print_r(seculoVivido($inventores,19));
    print_r(ordenarSobrenome(($inventores)));
?>