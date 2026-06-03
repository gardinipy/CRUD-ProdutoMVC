<?php
namespace App\Models\DAO;

class JulgamentoDAO extends BaseDAO {
    
    public function salvarNotas($id_inscricao, $id_juiz, $notas) {
        try {
            $this->conexao->beginTransaction();
            
            // Loop para as 6 notas (assumindo que os IDs dos critérios no BD vão de 1 a 6)
            $sql = "INSERT INTO julgamentos (id_inscricao, id_juiz, id_criterio, nota) 
                    VALUES (:id_inscricao, :id_juiz, :id_criterio, :nota)";
            $stmt = $this->conexao->prepare($sql);

            foreach ($notas as $id_criterio => $nota) {
                $stmt->bindValue(':id_inscricao', $id_inscricao);
                $stmt->bindValue(':id_juiz', $id_juiz);
                $stmt->bindValue(':id_criterio', $id_criterio);
                $stmt->bindValue(':nota', $nota);
                $stmt->execute();
            }
            
            $this->conexao->commit();
            return true;
        } catch (\Exception $e) {
            $this->conexao->rollBack();
            throw new \Exception("Erro ao salvar julgamento: " . $e->getMessage());
        }
    }
}