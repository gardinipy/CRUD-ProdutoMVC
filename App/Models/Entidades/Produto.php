<?php
namespace App\Models\Entidades;

class Produto {
    private $id_produto;
    private $nome_produto;
    private $variedade;

    public function getIdProduto() { return $this->id_produto; }
    public function setIdProduto($id_produto) { $this->id_produto = $id_produto; }

    public function getNomeProduto() { return $this->nome_produto; }
    public function setNomeProduto($nome_produto) { $this->nome_produto = $nome_produto; }

    public function getVariedade() { return $this->variedade; }
    public function setVariedade($variedade) { $this->variedade = $variedade; }

    // Método para preencher os dados via array do formulário
    public function setProduto($dados) {
        $this->id_produto = $dados['id_produto'] ?? null;
        $this->nome_produto = $dados['nome_produto'] ?? null;
        $this->variedade = $dados['variedade'] ?? null;
    }
}