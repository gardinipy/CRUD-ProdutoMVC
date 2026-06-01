<?php
namespace App\Models\DAO;
use App\Models\Entidades\ProdutoAgricola;
use App\Lib\Conexao;

class ProdutoAgricolaDAO {
    public function salvar(ProdutoAgricola $produto) {
        $conexao = Conexao::getConnection();
        $stmt = $conexao->prepare("INSERT INTO produtos_agricolas (nome_produto, variedade) VALUES (?, ?)");
        return $stmt->execute([$produto->getNomeProduto(), $produto->getVariedade()]);
    }

    public function listar() {
        $conexao = Conexao::getConnection();
        $stmt = $conexao->query("SELECT * FROM produtos_agricolas");
        return $stmt->fetchAll();
    }
}