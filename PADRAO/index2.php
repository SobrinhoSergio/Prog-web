<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
</head>
<body>


<div class="container mt-5">
        <a href="index.php" class="btn btn-primary"><i class="bi bi-arrow-left"></i></a>
        <h2>Dados Cadastrados</h2>
        <table class="table table-striped">
            <?php require_once 'listar.php'; ?>
        </table>
    </div>
</body>
</html>