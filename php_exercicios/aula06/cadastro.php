<?php
require_once 'conexao.php';
require_once 'produto.php';
$pdo = null;
const OPCAO_SAIR = '0';
const OPCAO_CADASTRAR = '1';
const OPCAO_ALTERAR = '2';
const OPCAO_EXCLUIR = '3';
const OPCAO_LISTAR = '4';
const OPCAO_BUSCAR = '5';

try {
  $pdo = conectar();
} catch (PDOException $e) {
  die('Erro: ' . $e->getMessage());
}


function pedirProduto()
{
  echo 'Cadastro', PHP_EOL;
  $codigo = readline('Codigo: ');
  $descricao = readline('Descricao: ');
  $estoque = readline('Estoque: ');
  $preco = readline('Preco: (R$)');

  return new Produto($codigo, $descricao, $estoque, $preco);
}

function cadastrar(PDO $pdo)
{
  $p = pedirProduto();

  $sql = "INSERT INTO produto(codigo,descricao,estoque,preco) VALUES('" . $p->codigo . "', '" . $p->descricao . "',
          " . $p->estoque . ", " . $p->preco . ")";

  try {
    $pdo->exec($sql);
  } catch (PDOException $e) {
    echo 'Erro: ', $e->getMessage(), PHP_EOL;
  }
}

function cadastrar2(PDO $pdo)
{
  $p = pedirProduto();

  $sql = "INSERT INTO produto(codigo,descricao,estoque,preco) VALUES(:codigo,:descricao,:estoque,:preco)";

  try {
    $ps = $pdo->prepare($sql);
    $ps->execute([
      'codigo' => $p->codigo,
      'descricao' => $p->descricao,
      'estoque' => $p->estoque,
      'preco' => $p->preco
    ]);
  } catch (PDOException $e) {
    echo 'Erro: ', $e->getMessage(), PHP_EOL;
  }
}

function cadastrar3(PDO $pdo)
{
  $p = pedirProduto();
  $sql = "INSERT INTO produto(codigo,descricao,estoque,preco) VALUES(?,?,?,?)";

  try {
    $ps = $pdo->prepare($sql);
    $ps->execute([
      $p->codigo,
      $p->descricao,
      $p->estoque,
      $p->preco
    ]);
    $p->id = $pdo->lastInsertId();
    return $p;
  } catch (PDOException $e) {
    echo 'Erro: ', $e->getMessage(), PHP_EOL;
  }
}

function alterar(PDO $pdo)
{
  echo 'Digite o codigo do produto a ser alterado: ';
  $c = readline('');
  $p = pedirProduto();
  $sql = "UPDATE produto SET codigo = ?,descricao = ?,estoque = ?,preco = ? WHERE codigo = ?";

  try {
    $ps = $pdo->prepare($sql);
    $ps->execute([
      $p->codigo,
      $p->descricao,
      $p->estoque,
      $p->preco,
      $c
    ]);
  } catch (PDOException $e) {
    echo 'Erro: ', $e->getMessage(), PHP_EOL;
  }
}

function excluir($pdo)
{
  echo 'Digite o codigo do produto a ser excluido: ';
  $c = readline('');
  $sql = "DELETE FROM produto WHERE codigo = ?";

  try {
    $ps = $pdo->prepare($sql);
    $ps->execute([$c]);
  } catch (PDOException $e) {
    echo 'Erro: ', $e->getMessage(), PHP_EOL;
  }
}

function listarProdutos($ps){
  echo 'PRODUTOS', PHP_EOL;
  foreach ($ps as $linha) {
    echo $linha['id'], ' - ',
    $linha['codigo'], ' - ',
    $linha['descricao'], ' - ',
    $linha['estoque'], ' - ',
    $linha['preco'], PHP_EOL;
  }
}

function listar(PDO $pdo)
{
  $ps = $pdo->query("SELECT * FROM produto", PDO::FETCH_ASSOC);
  listarProdutos($ps);
}

function buscar(PDO $pdo)
{
  echo 'Digite o nome ou codigo do produto desejado: ';
  $busca = readline('');
  $sql = "SELECT * FROM produto WHERE (descricao LIKE :descricao) OR (codigo LIKE :codigo);";
  try {
    $ps = $pdo->prepare($sql);
    $ps->execute([
      'descricao' => '%' . $busca . '%',
      'codigo' => '%' . $busca . '%'
    ]);
    $p = $ps->fetchAll();
  } catch (PDOException $e) {
    echo 'Erro: ', $e->getMessage(), PHP_EOL;
  }

  listarProdutos($p);
}

do {
  echo 'MENU', PHP_EOL;
  echo '0) Sair', PHP_EOL;
  echo '1) Cadastrar', PHP_EOL;
  echo '2) Alterar', PHP_EOL;
  echo '3) Excluir', PHP_EOL;
  echo '4) Listar', PHP_EOL;
  echo '5) Buscar', PHP_EOL;
  $opcao = readline('Opcao: ');
  if ($opcao == OPCAO_CADASTRAR) {
    $p = cadastrar3($pdo);
    echo 'Produto cadastrado com o id ', $p->id, PHP_EOL;
  } else if ($opcao == OPCAO_ALTERAR) {
    alterar($pdo);
  } else if ($opcao == OPCAO_EXCLUIR) {
    excluir($pdo);
  } else if ($opcao == OPCAO_LISTAR) {
    listar($pdo);
  } else if ($opcao == OPCAO_BUSCAR) {
    buscar($pdo);
  }
} while ($opcao != OPCAO_SAIR);
