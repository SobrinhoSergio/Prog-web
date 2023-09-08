<?php
    require_once 'conta.php';
    require_once 'repositorio-conta-em-bdr.php';
    require_once 'repositorio-conta.php';
    require_once 'repositorio-exception.php';
    require_once 'conta-exception.php';

    const OPCAO_SAIR = '0';
    const OPCAO_CADASTRAR = '1';
    const OPCAO_LISTAR = '2';
    const OPCAO_DEPOSITAR = '3';
    const OPCAO_TRANSFERIR = '4';


    function exibirMenu(){
        echo 'Escolha uma opcao: ', PHP_EOL;
        echo '0)Sair', PHP_EOL;
        echo '1)Cadastrar uma conta', PHP_EOL;
        echo '2)Listar contas cadastradas', PHP_EOL;
        echo '3)Depositar', PHP_EOL;
        echo '4)Transferir', PHP_EOL;
    }

    function cadastrar(RepositorioConta $repositorio){
        echo 'Cadastrar ', PHP_EOL;
        $dono = readline('Dono: ');
        $cpf = readline('CPF: ');
        $senha = readline('Senha: ');
        $saldo = readline('Saldo: ');   
        $conta = new Conta(0, $dono, $cpf, $senha, $saldo);
        $repositorio->cadastrar($conta);
    }

    function listar(RepositorioConta $repositorio){
        $contas = $repositorio->listar();
        echo 'Contas ',PHP_EOL;
        foreach($contas as $i => $c){
            echo $i + 1, ') ', $c->dono, ' ', $c->cpf, ' ', $c->saldo, PHP_EOL;
        }
    }

    function depositar(RepositorioConta $repositorio){
        echo 'Deposito ', PHP_EOL;
        $cpf = readline('CPF: ');
        $senha = readline('Senha: ');
        $valor = readline('Valor a ser depositado: ');
        $ok = $repositorio->depositar($cpf, $senha, $valor);
        echo $ok ? 'Deposito concluido' : 'Erro durante o deposito', PHP_EOL;
    }

    function solicitarCpf(){
        return readline('CPF: ');
    }

    function solicitarSenha(){
        return readline('Senha: ');
    }

    function transferir(RepositorioConta $repositorio){
        echo 'Transferencai: ', PHP_EOL;
        echo 'Informe a conta de retirada ', PHP_EOL;
        $cpfRemetente = solicitarCpf();
        $senhaRemetente = solicitarSenha();
        echo 'Informe a conta a ser depositado ', PHP_EOL;
        $cpfDestinatario = solicitarCpf();
        $senhaDestinatario = solicitarSenha();
        echo 'Informe o valor a ser transferido ', PHP_EOL;
        $valor = readline('');
        $ok = $repositorio->transferir($cpfRemetente, $cpfDestinatario, $senhaRemetente, $senhaDestinatario,$valor);
        echo $ok ? 'Transferencia concluida' : 'Erro durante a transferencia', PHP_EOL;
    }

    try {
        $pdo = new PDO(
            'mysql:host=localhost;dbname=aula07;charset=utf8',
            'admin', 'admin', [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ]
        );
    } catch ( PDOException $pe ) {
        die( 'Erro ao conectar com o banco de dados: ' . $pe->getMessage() );
    }

    $repositorio = new RepositorioContaEmBDR($pdo);
        
    
    do{
        exibirMenu();
        $opcao = readline('');

        try{
            if($opcao == OPCAO_CADASTRAR){
                cadastrar($repositorio);
            }
            else if($opcao == OPCAO_LISTAR){
                listar($repositorio);
            }
            else if($opcao == OPCAO_DEPOSITAR){
                depositar($repositorio);
            }
            else if($opcao == OPCAO_TRANSFERIR){
                transferir($repositorio);
            }
        }catch (RepositorioException $pe){
            die($pe->getMessage());
        }
    }while(OPCAO_SAIR != $opcao);

?>