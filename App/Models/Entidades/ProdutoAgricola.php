<?php
namespace App\Models\Entidades;

class ProdutoAgricola {
    private $id_produto;
    private $nome_produto;
    private $variedade;

    public function getIdProduto() { return $this->id_produto; }
    public function setIdProduto($id) { $this->id_produto = $id; }
    public function getNomeProduto() { return $this->nome_produto; }
    public function setNomeProduto($n) { $this->nome_produto = $n; }
    public function getVariedade() { return $this->variedade; }
    public function setVariedade($v) { $this->variedade = $v; }
}