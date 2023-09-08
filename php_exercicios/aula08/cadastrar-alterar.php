<?php
    //phh -S localhost:8080
    //$_POST $_GET
    //header('Content-Type: text/plain'); //texto simple
    //http_response_code( 404 );//not found

    //echo 'Recebi <b>', $_POST['nome'], '</b> - <i>', $_POST['telefone'], '</i>';

    require_once 'conexao.php';
    $pdo = CriarConexao();

    $id = htmlspecialchars($_POST['id']);
    $nome = htmlspecialchars($_POST['nome']);
    $tel = htmlspecialchars($_POST['telefone']);
    //htmlspecialchars(); //Deixa o texto vindo do html seguro

    try{
        if($id == 0){
            $ps = $pdo->prepare('INSERT INTO contato(nome,telefone) VALUES(:nome, :tel)');
            $ps->execute([
                'nome' => $nome,
                'tel' => $tel
            ]);
        }else{
            $ps = $pdo->prepare('UPDATE contato SET nome = :nome, telefone = :tel WHERE id = :id');
            $ps->execute([
                'nome' => $nome,
                'tel' => $tel,
                'id' => $id
            ]);
        }
        if($ps->rowCount()<1){
            http_response_code(500);
            echo 'Erro ao cadastrar/alterar o contato';
            die();
        }
        header("Location: contatos.php"); //redirecionar
    }catch(PDOException $e){
        http_response_code(500);
        echo "Erro ao salvar o contato";
    }

?>