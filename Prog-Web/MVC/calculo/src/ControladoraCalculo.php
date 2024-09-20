<?php
require_once 'VisaoCalculo.php';
require_once 'Calculadora.php';

class ControladoraCalculo {

    private $visao;
    private $calculadora;

    public function __construct( VisaoCalculo $visao ) {
        $this->visao = $visao;
        $this->calculadora = new Calculadora();
    }

    public function realizarOperacao(): void {
        $op = $this->visao->operacao(); 
        $n1 = $this->visao->numero1();
        $n2 = $this->visao->numero2();
        try {
            $resultado = $this->calculadora->realizarOperacao( $op, $n1, $n2 );
            $this->visao->mostrarResultado( $resultado );
        } catch ( Exception $e ) {
            $this->visao->mostrarExcecao( $e );
        }
    }
}