<?php
namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\UsuarioDAO;

class LoginController extends Controller
{
    public function index()
    {
        if (Sessao::existe('usuario_logado')) {
            $this->redirect('/home');
        }
        $this->render('Login/index', false);
        Sessao::limpar('mensagemErro');
    }

    public function autenticar()
    {
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
        }

        Sessao::gravar('mensagemErro', 'E-mail ou senha inválidos.');
        $this->redirect('/login');
    }

    public function sair()
    {
        session_destroy();
        session_start();
        $this->redirect('/login');
    }
}
