<?php
namespace App\Models\DAO;

use App\Models\Entidades\ProdutorRural;
use App\Lib\Conexao;

class ProdutorRuralDAO
{
    private function montarProdutor($dado)
    {
        $produtor = new ProdutorRural();
        $produtor->setIdProdutor($dado->id_produtor ?? $dado['id_produtor']);
        $produtor->setNomeProdutor($dado->nome_produtor ?? $dado['nome_produtor']);
        $produtor->setMunicipio($dado->municipio ?? $dado['municipio']);
        $produtor->setBairro($dado->bairro ?? $dado['bairro']);
        $produtor->setTelefone($dado->telefone ?? $dado['telefone']);
        return $produtor;
    }

    public function salvar(ProdutorRural $produtor)
    {
        $conexao = Conexao::getConnection();
        $stmt = $conexao->prepare(
            "INSERT INTO produtores_rurais (nome_produtor, municipio, bairro, telefone) VALUES (?, ?, ?, ?)"
        );
        return $stmt->execute([
            $produtor->getNomeProdutor(),
            $produtor->getMunicipio(),
            $produtor->getBairro(),
            $produtor->getTelefone()
        ]);
    }

    public function listar()
    {
        $conexao = Conexao::getConnection();
        $stmt = $conexao->query("SELECT * FROM produtores_rurais ORDER BY nome_produtor");
        $produtores = [];
        while ($dado = $stmt->fetch(\PDO::FETCH_OBJ)) {
            $produtores[] = $this->montarProdutor($dado);
        }
        return $produtores;
    }

    public function buscar($id)
    {
        $conexao = Conexao::getConnection();
        $stmt = $conexao->prepare("SELECT * FROM produtores_rurais WHERE id_produtor = ?");
        $stmt->execute([$id]);
        $dado = $stmt->fetch(\PDO::FETCH_OBJ);
        return $dado ? $this->montarProdutor($dado) : null;
    }

    public function atualizar(ProdutorRural $produtor)
    {
        $conexao = Conexao::getConnection();
        $stmt = $conexao->prepare(
            "UPDATE produtores_rurais SET nome_produtor = ?, municipio = ?, bairro = ?, telefone = ? WHERE id_produtor = ?"
        );
        return $stmt->execute([
            $produtor->getNomeProdutor(),
            $produtor->getMunicipio(),
            $produtor->getBairro(),
            $produtor->getTelefone(),
            $produtor->getIdProdutor()
        ]);
    }

    public function excluir($id)
    {
        $conexao = Conexao::getConnection();
        $stmt = $conexao->prepare("DELETE FROM produtores_rurais WHERE id_produtor = ?");
        return $stmt->execute([$id]);
    }
}
