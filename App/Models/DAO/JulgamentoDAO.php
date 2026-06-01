<?php
namespace App\Models\DAO;
use App\Lib\Conexao;

class JulgamentoDAO {
    public function buscarCriterios() {
        $conexao = Conexao::getConnection();
        return $conexao->query("SELECT * FROM criterios_julgamento")->fetchAll();
    }

    public function buscarJuizes() {
        $conexao = Conexao::getConnection();
        return $conexao->query("SELECT * FROM juizes")->fetchAll();
    }

    public function salvarNota($id_inscricao, $id_juiz, $id_criterio, $nota) {
        $conexao = Conexao::getConnection();
        $stmt = $conexao->prepare("INSERT INTO julgamentos (id_inscricao, id_juiz, id_criterio, nota) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$id_inscricao, $id_juiz, $id_criterio, $nota]);
    }

    public function atualizarNotaFinal($id_inscricao) {
        $conexao = Conexao::getConnection();
        $stmt = $conexao->prepare("UPDATE inscricoes SET pontuacao_final = (SELECT SUM(nota) FROM julgamentos WHERE id_inscricao = ?) WHERE numero_inscricao = ?");
        return $stmt->execute([$id_inscricao, $id_inscricao]);
    }
}