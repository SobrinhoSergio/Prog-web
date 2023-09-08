<?php
    class Contato {
        private $nome = '';
        private $telefone = '';

        private static $contador = 0;

        //contrutor e destrutor
        public function __construct($nome, $telefone){
            $this->setNome($nome);
            $this->setTelefone($telefone);
            //echo 'Criado ', $this->formatar(), PHP_EOL;

            self::$contador++;
        }

        public function __destruct(){
            //echo 'Destruindo ', $this->formatar(), PHP_EOL;
            self::$contador--;
        }
        
        //get and set
        public function getNome(){
            return $this->nome;
        }

        public function setNome($nome){
            if(mb_strlen($nome) >= 2 && mb_strlen($nome) <= 100){
                $this->nome = $nome;
            }
        }

        public function getTelefone(){
            return $this->telefone;
        }

        public function setTelefone($telefone){
            if(mb_strlen($telefone) >= 8 && mb_strlen($telefone) <= 10 && is_numeric($telefone)){
                $this->telefone = $telefone;
            }
        }
        //Funções
        public function formatar(){
            return $this->getNome() . ' - ' . $this->getTelefone();
        }

        public static function getContador(){
            return self::$contador;
        }
    }

    class ContatoProfissional extends Contato{
        private $email = '';

        public function __construct($nome, $telefone, $email = ''){
            parent::__construct($nome,$telefone);
            $this->setEmail($email);
        }
        
        public function setEmail($email){
            //if(!(mb_strpos($email,'@')) && mb_substr($email,0,1) !== '@' && mb_substr($email,mb_strlen($email) - 1,1) !== '@'){
              //  $this->email = $email;
            //}
            if(mb_strpos($email,'@') === false || mb_substr($email,0,1) === '@' || mb_substr($email,mb_strlen($email) - 1,1) === '@'){
                return;
            }
            $this->email = $email;
        }

        public function getEmail(){
            return $this->email;
        }

        public function formatar(){
            return parent::formatar() . ' - ' . $this->getEmail();
        }

    }

    //$c1 = new Contato('Ana', '12345678');
    //$c2 = new Contato('Bia', '12345786');
    $c3 = new ContatoProfissional('Ana', '12345678','email@email.com');
    echo Contato::getContador(), ' instancias', PHP_EOL;

    echo 'Contato3: ', $c3->formatar(), PHP_EOL;
?>