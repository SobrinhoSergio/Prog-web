<?php

require_once 'Equipamento.php';

interface RepositorioEquipamento {

    /**
     * Retorna uma lista de equipamentos
     *
     * @return array<Equipamento>
     */
    public function equipamentos(): array;

    /**
     * Adiciona um novo equipamento no repositório
     *
     * @param Equipamento $equipamento
     * @return void
     */
    public function adicionar(Equipamento $equipamento): void;

    /**
     * Deleta um equipamento do repositório
     *
     * @param int $id
     * @return bool
     */
    public function removerPeloId(int $id): bool;
}
