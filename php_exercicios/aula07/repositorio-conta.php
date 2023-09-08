<?php
    require_once 'conta.php';

    interface RepositorioConta{
        /**
         * Adiciona uma conta.
         * @throws RepositorioException
         */
        function cadastrar(Conta $conta);
        function listar();
        function depositar($cpf, $senha, $valor);
        function transferir($cpfRemetente, $cpfDestinatario, $senhaRemetente, $senhaDestinatario, $valor);
    }
?>