<?php
require_once 'conta.php';

/**
 *
 * @author Thiago
 * @since 0.1
 */
interface RepositorioConta {

    /**
     * Adiciona uma conta.
     *
     * @throws RepositorioException
     */
    function cadastrar( Conta $conta );


    /**
     * Retorna todas as contas.
     *
     * @return array de Conta
     * @throws RepositorioException
     */
    function todasAsContas();


    /**
     * Deposita um valor na conta, estando autenticado.
     *
     * @param string $cpf CPF do dono.
     * @param string $senha Senha da conta.
     * @param string $valor Valor a ser depositado.
     * @throws RepositorioException
     */
    function depositar( $cpf, $senha, $valor );

    /**
     * Retira um valor na conta, estando autenticado.
     *
     * @param string $cpf CPF do dono.
     * @param string $senha Senha da conta.
     * @param string $valor Valor a ser retirado.
     * @throws RepositorioException
     */
    function retirar( $cpf, $senha, $valor );


    function transferir(
        $cpfOrigem,
        $senhaOrigem,
        $cpfDestino,
        $senhaDestino,
        $valor
    );
}
?>