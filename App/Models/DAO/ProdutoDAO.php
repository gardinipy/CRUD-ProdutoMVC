<?php
namespace App\Models\DAO;

use App\Models\Entidades\Produto;
use App\Lib\Conexao;

class ProdutoDAO extends BaseDAO {
    
    public function listar($id = null) {
        $conexao = Conexao::getConnection();
        
        if ($id) {
            $sql = "SELECT * FROM produtos_agricolas WHERE id_produto = :id";
            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $dado = $stmt->fetch(\PDO::FETCH_ASSOC);
                $produto = new Produto();
                $produto->setProduto($dado);
                return $produto;
            }
            return null;
        } else {
            $sql = "SELECT * FROM produtos_agricolas";
            $stmt = $conexao->query($sql);
            $produtos = [];
            if ($stmt) {
                while ($dado = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                    $produto = new Produto();
                    $produto->setProduto($dado);
                    $produtos[] = $produto;
                }
            }
            return $produtos;
        }
    }

    public function salvar(Produto $produto) {
        $conexao = Conexao::getConnection();
        $sql = "INSERT INTO produtos_agricolas (nome_produto, variedade) VALUES (:nome, :variedade)";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':nome', $produto->getNomeProduto());
        $stmt->bindValue(':variedade', $produto->getVariedade());
        return $stmt->execute();
    }

    public function atualizar(Produto $produto) {
        $conexao = Conexao::getConnection();
        $sql = "UPDATE produtos_agricolas SET nome_produto = :nome, variedade = :variedade WHERE id_produto = :id";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':nome', $produto->getNomeProduto());
        $stmt->bindValue(':variedade', $produto->getVariedade());
        $stmt->bindValue(':id', $produto->getIdProduto());
        return $stmt->execute();
    }

    public function excluir($id) {
        $conexao = Conexao::getConnection();
        $sql = "DELETE FROM produtos_agricolas WHERE id_produto = :id";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }
}