<?php
namespace App\Models\Entidades;

class ProdutorRural
{
    private $id_produtor;
    private $nome_produtor;
    private $municipio;
    private $bairro;
    private $telefone;

    // Crie os Getters e Setters para cada atributo
    public function getIdProdutor() { return $this->id_produtor; }
    public function setIdProdutor($id) { $this->id_produtor = $id; }
    
    public function getNomeProdutor() { return $this->nome_produtor; }
    public function setNomeProdutor($nome) { $this->nome_produtor = $nome; }
    
    // ... (repetir para municipio, bairro e telefone)
}