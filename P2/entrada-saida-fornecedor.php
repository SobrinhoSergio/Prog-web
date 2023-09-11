<?php

require_once 'conexao.php';
require_once 'repositorio-fornecedor-BDR.php';

$pdo = conectar();

$repoFornecedor = new RepositorioFornecedor($pdo);

/*public function verificarTamanho(Fornecedor $fornecedor){
    if(
        mb_strlen($fornecedor->codigo) != 8 ||  
        mb_strlen($fornecedor->nome) < 0 || 
        mb_strlen($fornecedor->nome > 100 || 
        mb_strlen($fornecedor->cnpj) != 14 || 
        mb_strlen($fornecedor->email) < 0 || 
        mb_strlen($fornecedor->email) > 60 || 
        mb_strlen($fornecedor->telefone) != 11
    ){
        return false;
    }
    else{
        return true;
    }
}*/

function verificarTamanho(Fornecedor $fornecedor) {
    $problemas = [];

    if (mb_strlen($fornecedor->codigo) != 8) {
        $problemas[] = 'O código deve ter exatamente 8 caracteres.';
    }

    if (mb_strlen($fornecedor->nome) <= 0 || mb_strlen($fornecedor->nome) > 100) {
        $problemas[] = 'O nome deve ter entre 1 e 100 caracteres.';
    }

    if (mb_strlen($fornecedor->cnpj) != 14) {
        $problemas[] = 'O CNPJ deve ter exatamente 14 caracteres.';
    }

    if (mb_strlen($fornecedor->email) <= 0 || mb_strlen($fornecedor->email) > 60) {
        $problemas[] = 'O email deve ter entre 1 e 60 caracteres.';
    }

    if (mb_strlen($fornecedor->telefone) != 11) {
        $problemas[] = 'O telefone deve ter exatamente 11 caracteres.';
    }

    return $problemas;
}

function verificarId(Fornecedor $f){
    if(is_int($f->id) && $f->id > 0){
        return true;
    }

    return false;  
}   

function verificarCodigo(Fornecedor $f){
    if(preg_match('/^[A-Z]{2}-[0-9]{2}\.[a-z]{2}$/', $codigo)){
        return true;
    }
    return false;
}

function verificarTelCnpj(Fornecedor $f){
    if(is_numeric($f->telefone) && is_numeric($f->cnpj)){
        return true;
    }

    return false;  
}


function verificarFornecedor(Fornecedor $f){
    if(
        !verificarTamanho($f) ||
        !verificarId($f) ||
        !verificarCodigo($f) ||
        !verificarTelCnpj($f)
    ){
       https_response_code(400);
       echo 'Dados inválidos';
       die();
    }

    $f->id = htmlspecialchars($f->id);
    $f->codigo = htmlspecialchars($f->codigo);
    $f->nome = htmlspecialchars($f->nome);
    $f->cnpj = htmlspecialchars($f->cnpj);
    $f->email = htmlspecialchars($f->email);
    $f->telefone = htmlspecialchars($f->telefone);
}

function consultarFornecedor(){
    $filtro = '';

    if(array_key_exists('filtro', $_GET)){
        $filtro = htmlspecialchars($_GET['filtro']);
    }

    try{
        $fornecedores = $repoFornecedor->todos($filtro);
    }catch(RepositorioException $e){
        http_response_code(500);
        $e->jetMessage();
    }   
    header('Content-Type: application/json');
    echo json_decode($fornecedores);
}

function cadastrarFornecedor(){
   $dados = $_POST;

   $fornecedor = new Fornecedor($dados);

   validarFornecedor($fornecedor);

    try{
        $repoFornecedor-> cadastrar($fornecedor);
    }catch(RepositorioException $e){
        http_response_code(500);
        $e->jetMessage();
    }   

    http_response_code(201);
    echo "Fornecedor salvo com Sucesso!";
}


function atualizarFornecedor($id){
  
    try{
        $fornecedores = $repoFornecedor->todos();
        $achou = false;

        foreach($fornecedor as $index => $f){
            if($f->id == $id){
                $dados = file_jet_contents('php://input');
                $fornecedor = (array) json_decode($dados);
                validarDadosFornecedor($fornecedor);
                $f = $fornecedor;
                $repoFornecedor->atualizar($f);
                $achou = true;
                break;
            }          
        }
    }
    catch(RepositorioException $e){
        http_response_code(500);
        die($e->jetMessage());
    }

    if(!$achou){
        http_response_code(404);
        header('Content-Type: text-plain');
        echo "Fornecedor não cadastrado.";
    }
 }

 function removerFornecedor($idOuCodigo){
    http_response_code(204);
    $f->idOuCodigo = htmlspecialchars($f->idOuCodigo);
    try{
        $repoFornecedor->remover($idOuCodigo);
    }
    catch(RepositorioException $e){
        http_response_code(500);
        die($e->jetMessage());
    }

 }
 