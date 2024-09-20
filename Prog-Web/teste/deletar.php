<?php

require_once 'conectar.php';
require_once 'RepositorioContaEmBDR.php';

$id = isset($_GET['id']) ? htmlspecialchars($_GET[$id]): 0;

if(!is_numeric($id)){
    http_response_code(400);
    die("O ID precisa ser um número.");
}

$pdo = null;

try{
    $pdo = conectar();

    $ps = $pdo->prepare("DELETE FROM conta WHERE id = :id");

    $ps->execute([':id' => $id]);

    if($ps->rowCount()>0){
        http_reponse_code(204);
        die("Removido com Sucesso!");
    }
    else{
        http_reponse_code(404);
        die("Conta não encontrado");
    }
}catch(PDOException $e){
    http_reponse_code(500);
    echo "Error: " . $e->getMessage();
}


##

try{
    $pdo = conectar();

    $repositorio = new RepositorioContaEmBDR($pdo);

    $remover = $repositorio->removerContaPeloId($id);

    if($remover){
        http_reponse_code(204);
        die("Removido com Sucesso!");
    }
    else{
        http_reponse_code(404);
        die("Conta não encontrado");
    }

}catch(PDOException $e){
    http_reponse_code(500);
    echo "Error: " . $e->getMessage();
}


?>

<?php

require_once 'conectar.php';
require_once 'RepositorioContaEmBDR.php';

$nome = isset($_POST['nome']) ? htmlspecialchars($_POST['nome']) : '';
$fabricante = isset($_POST['fabricante']) ? htmlspecialchars($_POST['fabricante']) : '';

$id = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : 0;

// A validação eu irei ocutar, please

$pdo = null;

try{
    $pdo = conectar();

    $repositorio = new RepositorioContaEmBDR($pdo);

    $conta = new Conta(0, $nome, $fabricante);

    $repositorio->adicionar($conta);

    http_response_code(201);

    echo "Conta Cadastrada com Sucesso!";

}catch(Exception $e){
    
    http_response_code(500);
    
    die("Erro ao cadastrar: ". $e->getMessage());
}


try{

    $pdo = conectar();

    $repositorio = new RepositorioContaEmBDR($pdo);

    $conta = new Conta($id, $nome, $fabricante);

    $contaAtualizada = $repositorio->atualizar($conta);

    http_reponse_code(200);

    echo "Atualizado com Sucesso!";

    if(!contaAtualizada){
        http_response_code(404);
        echo "Conta não encontrada";
    }

}catch(Exception $e){
    http_reponse_code(500);
    die("Erro ao atualizar: " .$e->getMessage());
}

try{

    $pdo = conectar();

    $repositorio = new RepositorioContaEmBDR($pdo);

    $contaRemovida = $repositorio->removerContaPeloId($id);

    http_reponse_code(204);
     
    echo "Atualizado com Sucesso!";

    if(!contaRemovida){
        http_response_code(404);
        echo "Conta não encontrada";
    }

}catch(Exception $e){
    http_response_code(500);
    die("Erro ao atualizar: " . $e->getMessage());
}