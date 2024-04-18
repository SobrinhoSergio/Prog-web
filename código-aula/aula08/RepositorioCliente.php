<?php
require_once 'Cliente.php';

interface RepositorioCliente {

    /**
     * @throws RepositorioException
     */
    function adicionar( Cliente &$c );

    /**
     * @throws RepositorioException
     */    
    function removerPeloId( $id );

    /**
     * @throws RepositorioException
     */    
    function todos();    

}

?>