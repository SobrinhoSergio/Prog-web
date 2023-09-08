<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cadastro_pessoas_db";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtém os dados do formulário
        $nome = $_POST['nome'];
        $peso = $_POST['peso'];
        $altura = $_POST['altura'];

        // Consulta SQL de inserção
        $sql = "INSERT INTO lutador (nome, peso, altura) VALUES (:nome, :peso, :altura)";

        // Prepara a consulta
        $ps = $pdo->prepare($sql);

        // Bind dos parâmetros
        $ps->bindParam(':nome', $nome);
        $ps->bindParam(':peso', $peso);
        $ps->bindParam(':altura', $altura);

        // Executa a consulta
        $ps->execute();

        echo "Lutador cadastrado com sucesso!";
    }
} catch (PDOException $e) {
    die("Error ao consultar o banco de dados: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cadastro de Lutador</title>
</head>
<body>
    <h2>Cadastro de Lutador</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" required><br>

        <label for="peso">Peso:</label>
        <input type="number" name="peso" required><br>

        <label for="altura">Altura:</label>
        <input type="number" step="0.01" name="altura" required><br>

        <input type="submit" value="Cadastrar">
    </form>
</body>
</html>
