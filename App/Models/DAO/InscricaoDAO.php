<?php
namespace App\Models\DAO;
use App\Lib\Conexao;

class InscricaoDAO {
    public function salvar($id_produtor, $id_produto, $tipo_produto, $id_usuario) {
        $conexao = Conexao::getConnection();
        $stmt = $conexao->prepare("INSERT INTO inscricoes (id_produtor, id_produto, tipo_produto, id_usuario) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$id_produtor, $id_produto, $tipo_produto, $id_usuario]);
    }

    public function listarInscricoesPendentes() {
        $conexao = Conexao::getConnection();
        // Traz as inscrições que ainda não têm nota final
        $sql = "SELECT i.numero_inscricao, p.nome_produtor, pa.nome_produto, i.tipo_produto 
                FROM inscricoes i
                JOIN produtores_rurais p ON i.id_produtor = p.id_produtor
                JOIN produtos_agricolas pa ON i.id_produto = pa.id_produto
                WHERE i.pontuacao_final IS NULL";
        $stmt = $conexao->query($sql);
        return $stmt->fetchAll();
    }
}