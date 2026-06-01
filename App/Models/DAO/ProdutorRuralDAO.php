<?php
namespace App\Models\DAO;
use App\Models\Entidades\ProdutorRural;
use App\Lib\Conexao;

class ProdutorRuralDAO {
    public function salvar(ProdutorRural $produtor) {
        $conexao = Conexao::getConnection();
        $stmt = $conexao->prepare("INSERT INTO produtores_rurais (nome_produtor, municipio, bairro, telefone) VALUES (?, ?, ?, ?)");
        return $stmt->execute([
            $produtor->getNomeProdutor(),
            $produtor->getMunicipio(),
            $produtor->getBairro(),
            $produtor->getTelefone()
        ]);
    }

    public function listar() {
        $conexao = Conexao::getConnection();
        $stmt = $conexao->query("SELECT * FROM produtores_rurais");
        return $stmt->fetchAll();
    }
}