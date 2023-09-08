<?php
    require_once 'conexao.php';
    $id = htmlspecialchars($_GET['id']);

    $pdo = CriarConexao();
    try{
        $ps = $pdo->prepare('DELETE FROM contato WHERE id = ?');
        $ps->execute([$id]);

        echo <<<html
            <script>
                alert('Removido com sucesso');
                location.href="contatos.php";
            </script>
        html;

        //header('Location: contatos.php');
    }catch(PDOException $e){
        http_response_code(500);
        echo "Erro ao exlcuir";
    }
?>