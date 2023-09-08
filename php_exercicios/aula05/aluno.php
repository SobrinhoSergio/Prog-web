<?php
    namespace cefet;
    require_once 'turma.php';
    use Exception;

    class Aluno {
        public $nome = '';
        public $turma = null;
        public function __construct($nome, Turma $turma){
            $this->nome = $nome;
            $this->turma = $turma;
        }

        public function lancarExececao(){
            throw new Exception('Excecao aqui');
        }
    }
?>