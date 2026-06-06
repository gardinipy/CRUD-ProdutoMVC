<?php
namespace App\Models\DAO;

use App\Models\Entidades\Juiz;
use App\Lib\Conexao;

class JuizDAO extends BaseDAO
{
    private function montarJuiz($dado)
    {
        $juiz = new Juiz();
        $juiz->setIdJuiz($dado->id_juiz ?? $dado['id_juiz']);
        $juiz->setNomeJuiz($dado->nome_juiz ?? $dado['nome_juiz']);
        $juiz->setEmail($dado->email ?? $dado['email'] ?? null);
        $juiz->setSenha($dado->senha ?? $dado['senha'] ?? null);
        return $juiz;
    }

    public function listar()
    {
        $conexao = Conexao::getConnection();
        $stmt = $conexao->query("SELECT * FROM juizes ORDER BY nome_juiz");
        $juizes = [];
        while ($dado = $stmt->fetch(\PDO::FETCH_OBJ)) {
            $juizes[] = $this->montarJuiz($dado);
        }
        return $juizes;
    }

    public function buscar($id)
    {
        $conexao = Conexao::getConnection();
        $stmt = $conexao->prepare("SELECT * FROM juizes WHERE id_juiz = ?");
        $stmt->execute([$id]);
        $dado = $stmt->fetch(\PDO::FETCH_OBJ);
        return $dado ? $this->montarJuiz($dado) : null;
    }

    public function salvar(Juiz $juiz)
    {
        $conexao = Conexao::getConnection();
        $sql = "INSERT INTO juizes (nome_juiz, email, senha) VALUES (:nome, :email, :senha)";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':nome', $juiz->getNomeJuiz());
        $stmt->bindValue(':email', $juiz->getEmail());
        $stmt->bindValue(':senha', $juiz->getSenha());
        return $stmt->execute();
    }

    public function atualizar(Juiz $juiz)
    {
        $conexao = Conexao::getConnection();
        $sql = "UPDATE juizes SET nome_juiz = :nome, email = :email, senha = :senha WHERE id_juiz = :id";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':nome', $juiz->getNomeJuiz());
        $stmt->bindValue(':email', $juiz->getEmail());
        $stmt->bindValue(':senha', $juiz->getSenha());
        $stmt->bindValue(':id', $juiz->getIdJuiz());
        return $stmt->execute();
    }

    public function excluir($id)
    {
        $conexao = Conexao::getConnection();
        $stmt = $conexao->prepare("DELETE FROM juizes WHERE id_juiz = ?");
        return $stmt->execute([$id]);
    }
}
