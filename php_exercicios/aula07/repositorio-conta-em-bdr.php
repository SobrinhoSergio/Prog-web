<?php
    require_once 'repositorio-conta.php';
    require_once 'conta.php';
    require_once 'repositorio-exception.php';
    require_once 'hash.php';
    require_once 'conta-exception.php';
 

    class RepositorioContaEmBDR implements RepositorioConta {
        private $pdo = null;
        
        function __construct (PDO $pdo){
            $this->pdo = $pdo;
        }

        public function cadastrar(Conta $conta){
            try{
                $sql = 'INSERT INTO conta (dono, cpf, senha, saldo) VALUES (:dono, :cpf, :senha, :saldo)'; 
                $ps =  $this->pdo->prepare($sql);
                $ps->execute([
                    'dono' => $conta->dono,
                    'cpf' => $conta->cpf,
                    'senha' => meuHash($conta->senha),
                    'saldo' => $conta->saldo
                ]);
        }catch (PDOException $e){
            throw new RepositorioException('Erro ao cadastrar a conta.', $e->getCode(), $e);
        }

        }

        public function listar(){
            try{
                $ps =$this->pdo->prepare("SELECT id,dono,cpf,saldo FROM conta");
                $ps->setFetchMode(PDO::FETCH_ASSOC);
                $ps->execute();
                $contas = [];
                foreach($ps as $reg){
                    $contas []= new Conta(
                        $reg['id'],
                        $reg['dono'],
                        $reg['cpf'],
                        '',
                        $reg['saldo']
                    );
                }
                return $contas;
            }catch(PDOException $e){
                throw new RepositorioException('Erro ao consultar as contas', $e->getCode(), $e);
            }
        }

        public function depositar($cpf, $senha, $valor){
            try{
                $sql = 'UPDATE conta SET saldo = saldo + :valor WHERE cpf = :cpf AND senha = :senha';
                $ps = $this->pdo->prepare($sql);
                $ps->execute(['cpf' => $cpf, 'senha' => meuHash($senha), 'valor' => $valor]);
                if($ps->rowCount() < 1){
                    return false;
                }
                return true;
            }catch (PDOException $e){
                throw new RepositorioException('Erro ao cadastrar a conta.', $e->getCode(), $e);
            }
        }

        public function transferir($cpfRemetente, $cpfDestinatario, $senhaRemetente, $senhaDestinatario, $valor){
            try{
                $this->pdo->beginTransaction();
                $sql1 = 'UPDATE conta SET saldo = saldo - :valor Where cpf = :cpf AND senha = :senha AND :valor <= saldo
                AND :valor > 0';
                $ps = $this->pdo->prepare($sql1);
                $ps->execute([
                    'valor' => $valor,
                    'cpf' => $cpfRemetente,
                    'senha' => meuHash($senhaRemetente)
                ]);
                if($ps->rowCount() < 1){
                    return false;
                }
                $sql2 = 'UPDATE conta SET saldo = saldo + :valor WHERE cpf = :cpf AND senha = :senha';
                $pss = $this->pdo->prepare($sql2);
                $pss->execute([
                    'valor' => $valor,
                    'cpf' => $cpfDestinatario,
                    'senha' => meuHash($senhaDestinatario)
                ]);
                if($pss->rowCount() < 1){
                    return false;
                }
                return true;
            }catch(PDOException $e){
                throw new ContaException('Valor invalido.', $e->getCode());
            }
        }
    }
?>