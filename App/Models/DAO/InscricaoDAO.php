<?php
namespace App\Models\DAO;
use App\Models\Entidades\Inscricao;

class InscricaoDAO extends BaseDAO {
    
    public function salvar(Inscricao $inscricao) {
        try {
            $sql = "INSERT INTO inscricoes (id_produtor, id_produto, tipo_produto, id_usuario) 
                    VALUES (:id_produtor, :id_produto, :tipo_produto, :id_usuario)";
            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(':id_produtor', $inscricao->getIdProdutor());
            $stmt->bindValue(':id_produto', $inscricao->getIdProduto());
            $stmt->bindValue(':tipo_produto', $inscricao->getTipoProduto());
            $stmt->bindValue(':id_usuario', $inscricao->getIdUsuario());
            return $stmt->execute();
        } catch (\Exception $e) {
            throw new \Exception("Erro ao salvar inscrição: " . $e->getMessage());
        }
    }

    public function listarCompleto() {
        $sql = "SELECT i.numero_inscricao, i.tipo_produto, p.nome_produtor, pa.nome_produto 
                FROM inscricoes i
                INNER JOIN produtores_rurais p ON i.id_produtor = p.id_produtor
                INNER JOIN produtos_agricolas pa ON i.id_produto = pa.id_produto";
        
        $resultado = $this->select($sql);
        $inscricoes = [];
        
        if ($resultado) {
            foreach ($resultado as $dado) {
                $inscricao = new Inscricao();
                $inscricao->setNumeroInscricao($dado['numero_inscricao']);
                $inscricao->setTipoProduto($dado['tipo_produto']);
                $inscricao->setNomeProdutor($dado['nome_produtor']);
                $inscricao->setNomeProduto($dado['nome_produto']);
                $inscricoes[] = $inscricao;
            }
        }
        return $inscricoes;
    }
}