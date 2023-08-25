<?php
$servername = "localhost";
$username = "dev";
$password = "123456";
$dbname = "mma";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $nome = $_POST["nome"];
        $peso = $_POST["peso"];
        $altura = $_POST["altura"];

        $query = "INSERT INTO lutador (nome, peso_em_quilos, altura_em_metros) VALUES (:nome, :peso, :altura)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':peso', $peso);
        $stmt->bindParam(':altura', $altura);
        $stmt->execute();

        header("Location: listar-lutadores.php");
    } catch(PDOException $e) {
        echo "Erro na conexão: " . $e->getMessage();
    }

    $conn = null;
}
?>
