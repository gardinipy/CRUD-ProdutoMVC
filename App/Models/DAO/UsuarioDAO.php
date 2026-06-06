<?php
namespace App\Models\DAO;

use App\Models\Entidades\Usuario;

class UsuarioDAO extends BaseDAO
{
    private function montarUsuario($dado)
    {
        $usuario = new Usuario();
        $usuario->setIdUsuario($dado->id_usuario ?? $dado['id_usuario']);
        $usuario->setNome($dado->nome ?? $dado['nome']);
        $usuario->setEmail($dado->email ?? $dado['email']);
        $usuario->setSenha($dado->senha ?? $dado['senha'] ?? null);
        $usuario->setPapel($dado->papel ?? $dado['papel']);
        return $usuario;
    }

    public function verificarCredenciais($email, $senha)
    {
        $sql = "SELECT * FROM usuarios WHERE email = :email AND senha = :senha";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':senha', $senha);
        $stmt->execute();

        if ($stmt->rowCount()) {
            return $this->montarUsuario($stmt->fetch(\PDO::FETCH_OBJ));
        }
        return false;
    }

    public function listar()
    {
        $stmt = $this->conexao->query("SELECT * FROM usuarios ORDER BY nome");
        $usuarios = [];
        while ($dado = $stmt->fetch(\PDO::FETCH_OBJ)) {
            $usuarios[] = $this->montarUsuario($dado);
        }
        return $usuarios;
    }

    public function buscar($id)
    {
        $stmt = $this->conexao->prepare("SELECT * FROM usuarios WHERE id_usuario = ?");
        $stmt->execute([$id]);
        $dado = $stmt->fetch(\PDO::FETCH_OBJ);
        return $dado ? $this->montarUsuario($dado) : null;
    }

    public function buscarPorEmail($email, $excluirId = null)
    {
        $sql = "SELECT * FROM usuarios WHERE email = ?";
        $params = [$email];
        if ($excluirId) {
            $sql .= " AND id_usuario != ?";
            $params[] = $excluirId;
        }
        $stmt = $this->conexao->prepare($sql);
        $stmt->execute($params);
        $dado = $stmt->fetch(\PDO::FETCH_OBJ);
        return $dado ? $this->montarUsuario($dado) : null;
    }

    public function salvar(Usuario $usuario)
    {
        $sql = "INSERT INTO usuarios (nome, email, senha, papel) VALUES (:nome, :email, :senha, :papel)";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':nome', $usuario->getNome());
        $stmt->bindValue(':email', $usuario->getEmail());
        $stmt->bindValue(':senha', $usuario->getSenha());
        $stmt->bindValue(':papel', $usuario->getPapel());
        return $stmt->execute();
    }

    public function atualizar(Usuario $usuario)
    {
        $sql = "UPDATE usuarios SET nome = :nome, email = :email, senha = :senha, papel = :papel WHERE id_usuario = :id";
        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(':nome', $usuario->getNome());
        $stmt->bindValue(':email', $usuario->getEmail());
        $stmt->bindValue(':senha', $usuario->getSenha());
        $stmt->bindValue(':papel', $usuario->getPapel());
        $stmt->bindValue(':id', $usuario->getIdUsuario());
        return $stmt->execute();
    }

    public function excluir($id)
    {
        $stmt = $this->conexao->prepare("DELETE FROM usuarios WHERE id_usuario = ?");
        return $stmt->execute([$id]);
    }
}
