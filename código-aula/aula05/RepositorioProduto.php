<?php
/**
 * Representa um repositório de produtos.
 *
 * @author Thiago <email>
 */
 interface RepositorioProduto {
    /**
     * Salva vários produtos.
     *
     * @param array<Produto> $produtos Produtos a serem salvos.
     */
    function salvar( $produtos );

    /**
     * Carrega todos os produtos.
     *
     * @return array<Produto>
     */
    function carregar();
}

?>