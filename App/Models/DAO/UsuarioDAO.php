<?php
namespace App\Models\DAO;
use App\Models\Entidades\Usuario;

class UsuarioDAO extends BaseDAO {
    
    public function verificarCredenciais($email, $senha) {
        $sql = "SELECT * FROM usuarios WHERE email = :email AND senha = :senha";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':senha', $senha);
        $stmt->execute();

        if ($stmt->rowCount()) {
            $resultado = $stmt->fetch(\PDO::FETCH_ASSOC);
            $usuario = new Usuario();
            $usuario->setIdUsuario($resultado['id_usuario']);
            $usuario->setNome($resultado['nome']);
            $usuario->setEmail($resultado['email']);
            $usuario->setPapel($resultado['papel']);
            return $usuario;
        }
        return false;
    }
}