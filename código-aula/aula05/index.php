<?php

// Incluir as classes necessárias
require_once "Aplicativo.php";
require_once "telaProduto.php";
require_once "RepositorioProdutoEmJSON.php";

// Criar uma instância do repositório (neste caso, RepositorioProdutoEmJSON)
$repositorio = new RepositorioProdutoEmJSON("produtos.json");

// Criar uma instância da aplicação passando o repositório
$aplicacao = new Aplicacao($repositorio);

// Iniciar a aplicação
$aplicacao->iniciar();