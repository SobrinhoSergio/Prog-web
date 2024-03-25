<?php

const TAM_CODIGO = 6;
const TAM_MIN_DESCRICAO = 2;
const TAM_MAX_DESCRICAO = 100;

class Produto {
    public $codigo;
    public $descricao;
    public $estoque;
    public $preco;

    public function __construct(
        $codigo = '000000',
        $descricao = '??',
        $estoque = 0,
        $preco = 0.01
    ) {
        $this->codigo = $codigo;
        $this->descricao = $descricao;
        $this->estoque = $estoque;
        $this->preco = $preco;
    }

    public function validar() {
        $mensagens = [];
        
        // O código deve ter 6 caracteres numéricos (ex. "000001");
        
        $tamCodigo = mb_strlen( $this->codigo );
        
        if ( $tamCodigo != TAM_CODIGO ) {
            $mensagens []= 'O código deve ter 6 caracteres';
        } 
        
        else if ( ! is_numeric( $this->codigo ) ) {
            $mensagens []= 'O código deve ser numérico';
        }


        // A descrição deve ter entre 2 e 100 caracteres;
        $tamDescricao = mb_strlen( $this->descricao );
        
        if ( $tamDescricao < TAM_MIN_DESCRICAO || $tamDescricao > TAM_MAX_DESCRICAO ) {
            $mensagens []= 'A descrição deve ter entre 2 e 100 caracteres';
        }

        // O preço deve ser um número igual ou superior a 0,01.
        if ( ! is_numeric( $this->preco ) || $this->preco < 0.01 ) {
            $mensagens []= 'O preço deve ser um número igual ou superior a 0,01.';
        }

        // O estoque deve ser um numero e ser no mínimo zero.
        if ( ! is_numeric( $this->estoque ) || $this->estoque < 0 ) {
            $mensagens []= 'O estoque deve ser um numero e ser no mínimo zero.';
        }

        return $mensagens;
    }
}

// $p = new Produto();
// $p->codigo = '123';
// $p->descricao = 'Água Mineral';
// $p->preco = 0.00;
// $p->estoque = -1;

// var_dump( $p->validar() );

?>