<?php
namespace App\Controllers;
use App\Lib\Sessao;
use App\Models\DAO\UsuarioDAO;

class LoginController extends Controller {

    public function index() {
        $this->render('login/index', false); 
    }

    public function autenticar() {
        $email = $_POST['email'] ?? null;
        $senha = $_POST['senha'] ?? null;

        $usuarioDAO = new UsuarioDAO();
        $usuario = $usuarioDAO->verificarCredenciais($email, $senha);

        if ($usuario) {
            Sessao::gravar('usuario_logado', true);
            Sessao::gravar('id_usuario', $usuario->getIdUsuario());
            Sessao::gravar('nome_usuario', $usuario->getNome());
            Sessao::gravar('papel_usuario', $usuario->getPapel());
            $this->redirect('/home');
        } else {
            Sessao::gravar('mensagemErro', 'Email ou senha inválidos.');
            $this->redirect('/login');
        }
    }

    public function sair() {
        Sessao::limpar('usuario_logado');
        Sessao::limpar('id_usuario');
        Sessao::limpar('nome_usuario');
        Sessao::limpar('papel_usuario');
        $this->redirect('/login');
    }
}