<?php

class Aplicacao {
    private $repositorio;

    public function __construct(RepositorioProduto $repositorio) {
        $this->repositorio = $repositorio;
    }

    public function iniciar() {
        
        $telaProduto = new TelaProduto();
        
        do {
            
            $opcao = $telaProduto->menu();
            
            switch ($opcao) {
                case '1':
                    $produtos = $this->repositorio->carregar();
                    $telaProduto->mostrarProdutos($produtos);
                    break;
                case '2':
                    $produto = $telaProduto->obterProduto();
                    $this->repositorio->salvar([$produto]);
                    break;
                case '0':
                    echo "Saindo...\n";
                    break;
                default:
                    echo "Opção inválida.\n";
                    break;
            }
        } while ($opcao != '0');
    }
    
}
