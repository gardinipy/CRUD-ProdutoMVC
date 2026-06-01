<?php
namespace App\Models\Entidades;

class ProdutorRural {
    private $id_produtor;
    private $nome_produtor;
    private $municipio;
    private $bairro;
    private $telefone;

    public function getIdProdutor() { return $this->id_produtor; }
    public function setIdProdutor($id) { $this->id_produtor = $id; }
    public function getNomeProdutor() { return $this->nome_produtor; }
    public function setNomeProdutor($nome) { $this->nome_produtor = $nome; }
    public function getMunicipio() { return $this->municipio; }
    public function setMunicipio($m) { $this->municipio = $m; }
    public function getBairro() { return $this->bairro; }
    public function setBairro($b) { $this->bairro = $b; }
    public function getTelefone() { return $this->telefone; }
    public function setTelefone($t) { $this->telefone = $t; }
}