<?php
namespace App\Models\Entidades;

class Inscricao {
    private $numero_inscricao;
    private $id_produtor;
    private $id_produto;
    private $tipo_produto; // 'organico', 'convencional', 'nao_convencional'
    private $pontuacao_final;
    private $id_usuario;

    // Propriedades auxiliares para as Views
    private $nome_produtor;
    private $nome_produto;

    // Getters e Setters
    public function getNumeroInscricao() { return $this->numero_inscricao; }
    public function setNumeroInscricao($numero_inscricao) { $this->numero_inscricao = $numero_inscricao; }
    public function getIdProdutor() { return $this->id_produtor; }
    public function setIdProdutor($id_produtor) { $this->id_produtor = $id_produtor; }
    public function getIdProduto() { return $this->id_produto; }
    public function setIdProduto($id_produto) { $this->id_produto = $id_produto; }
    public function getTipoProduto() { return $this->tipo_produto; }
    public function setTipoProduto($tipo_produto) { $this->tipo_produto = $tipo_produto; }
    public function getPontuacaoFinal() { return $this->pontuacao_final; }
    public function setPontuacaoFinal($pontuacao_final) { $this->pontuacao_final = $pontuacao_final; }
    public function getIdUsuario() { return $this->id_usuario; }
    public function setIdUsuario($id_usuario) { $this->id_usuario = $id_usuario; }
    
    public function getNomeProdutor() { return $this->nome_produtor; }
    public function setNomeProdutor($nome_produtor) { $this->nome_produtor = $nome_produtor; }
    public function getNomeProduto() { return $this->nome_produto; }
    public function setNomeProduto($nome_produto) { $this->nome_produto = $nome_produto; }
}