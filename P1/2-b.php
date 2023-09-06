<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cadastro_pessoas_db";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta para listar todos os lutadores
    $ps = $pdo->prepare("
        SELECT 
            COUNT(id) AS total_lutadores,
            AVG(altura) AS media_alturas,
            MAX(altura) AS maior_altura,
            MAX(peso) AS maior_peso
        FROM lutador
    ");

    $ps->setFetchMode(PDO::FETCH_ASSOC);
    $ps->execute();
    $dados = $ps->fetch();

    echo 'Total de Lutadores: ', $dados['total_lutadores'],
    '. Media das alturas', $dados['media_alturas'],  
    '. Maior altura', $dados['maior_altura'],  
    '. Maior peso', $dados['maior_peso'];

}catch(PDOException $e){
    die("Error ao consultar o banco de dados: " . $e->getMessage());
}

?>