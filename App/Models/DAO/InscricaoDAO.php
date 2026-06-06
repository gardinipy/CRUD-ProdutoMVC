<?php
namespace App\Models\DAO;

use App\Models\Entidades\Inscricao;

class InscricaoDAO extends BaseDAO
{
    public function salvar(Inscricao $inscricao)
    {
        $sql = "INSERT INTO inscricoes (id_produtor, id_produto, tipo_produto, id_usuario)
                VALUES (:id_produtor, :id_produto, :tipo_produto, :id_usuario)";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':id_produtor', $inscricao->getIdProdutor());
        $stmt->bindValue(':id_produto', $inscricao->getIdProduto());
        $stmt->bindValue(':tipo_produto', $inscricao->getTipoProduto());
        $stmt->bindValue(':id_usuario', $inscricao->getIdUsuario());
        return $stmt->execute();
    }

    public function listarCompleto()
    {
        $sql = "SELECT i.numero_inscricao, i.id_produtor, i.id_produto, i.tipo_produto,
                       i.pontuacao_final, i.id_usuario,
                       p.nome_produtor, pa.nome_produto, pa.variedade
                FROM inscricoes i
                INNER JOIN produtores_rurais p ON i.id_produtor = p.id_produtor
                INNER JOIN produtos_agricolas pa ON i.id_produto = pa.id_produto
                ORDER BY i.numero_inscricao DESC";

        $stmt = $this->conexao->query($sql);
        $inscricoes = [];

        if ($stmt) {
            while ($dado = $stmt->fetch(\PDO::FETCH_OBJ)) {
                $inscricao = new Inscricao();
                $inscricao->setNumeroInscricao($dado->numero_inscricao);
                $inscricao->setIdProdutor($dado->id_produtor);
                $inscricao->setIdProduto($dado->id_produto);
                $inscricao->setTipoProduto($dado->tipo_produto);
                $inscricao->setPontuacaoFinal($dado->pontuacao_final);
                $inscricao->setIdUsuario($dado->id_usuario);
                $inscricao->setNomeProdutor($dado->nome_produtor);
                $inscricao->setNomeProduto($dado->nome_produto . ' (' . $dado->variedade . ')');
                $inscricoes[] = $inscricao;
            }
        }
        return $inscricoes;
    }

    public function buscar($numero)
    {
        $sql = "SELECT * FROM inscricoes WHERE numero_inscricao = ?";
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute([$numero]);
        $dado = $stmt->fetch(\PDO::FETCH_OBJ);
        if (!$dado) {
            return null;
        }
        $inscricao = new Inscricao();
        $inscricao->setNumeroInscricao($dado->numero_inscricao);
        $inscricao->setIdProdutor($dado->id_produtor);
        $inscricao->setIdProduto($dado->id_produto);
        $inscricao->setTipoProduto($dado->tipo_produto);
        $inscricao->setPontuacaoFinal($dado->pontuacao_final);
        $inscricao->setIdUsuario($dado->id_usuario);
        return $inscricao;
    }

    public function atualizar(Inscricao $inscricao)
    {
        $sql = "UPDATE inscricoes SET id_produtor = :id_produtor, id_produto = :id_produto,
                tipo_produto = :tipo_produto WHERE numero_inscricao = :numero";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':id_produtor', $inscricao->getIdProdutor());
        $stmt->bindValue(':id_produto', $inscricao->getIdProduto());
        $stmt->bindValue(':tipo_produto', $inscricao->getTipoProduto());
        $stmt->bindValue(':numero', $inscricao->getNumeroInscricao());
        return $stmt->execute();
    }

    public function excluir($numero)
    {
        $stmt = $this->conexao->prepare("DELETE FROM inscricoes WHERE numero_inscricao = ?");
        return $stmt->execute([$numero]);
    }
}
