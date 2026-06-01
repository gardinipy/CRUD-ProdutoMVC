<?php
namespace App\Models\DAO;
use App\Lib\Conexao;

class UsuarioDAO {
    public function verificarLogin($email, $senha) {
        $conexao = Conexao::getConnection();
        $stmt = $conexao->prepare("SELECT * FROM usuarios WHERE email = ? AND senha = ?");
        $stmt->execute([$email, $senha]);
        return $stmt->fetch();
    }
}