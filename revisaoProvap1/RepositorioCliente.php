<?php

require_once 'Cliente.php';

interface RepositorioCliente{
    function adicionar(Cliente $cliente);
    function removerPeloId(int $id);
    function todos();
}