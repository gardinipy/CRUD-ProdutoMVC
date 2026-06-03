namespace App\Models\Entidades;

class FichaInscricao {
    private $numero_inscricao;
    private $id_produtor;
    private $id_produto;
    private $tipo_produto; // orgânico, convencional, não convencional

    // Getters e Setters
    public function getNumeroInscricao() { return $this->numero_inscricao; }
    public function setNumeroInscricao($numero_inscricao) { $this->numero_inscricao = $numero_inscricao; }
    
    public function getIdProdutor() { return $this->id_produtor; }
    public function setIdProdutor($id_produtor) { $this->id_produtor = $id_produtor; }
    
    // ... (implementar os restantes getters e setters)
}