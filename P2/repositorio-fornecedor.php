<?php

namespace acme;

require_once 'fornecedor.php';

class RepositorioException extends \RuntimeException{}

interface RepositorioFornecedor{
    
    // Retorna um array de objetos de fornecedor
    function todos(string $filtro = '');
    
    // Fornecedor recebido deve ganhar o ID gerado pelo meio de persistência
    function cadastrar(Fornecedor & $fornecedor);

    // ID do fornecedor não deve ser atualizado
    function atualizar(Fornecedor $fornecedor);

    // Remover pelo ID ou pelo código
    function remover(Fornecedor $idOuCodigo);
    

}