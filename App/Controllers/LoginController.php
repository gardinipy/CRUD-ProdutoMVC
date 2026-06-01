<?php
namespace App\Controllers;
use App\Models\DAO\UsuarioDAO;
use App\Lib\Sessao;

class LoginController extends Controller {
    public function index() {
        $this->render('login/index');
    }

    public function autenticar() {
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $dao = new UsuarioDAO();
        $usuario = $dao->verificarLogin($email, $senha);

        if ($usuario) {
            Sessao::grava('id_usuario', $usuario->id_usuario);
            Sessao::grava('papel', $usuario->papel);
            Sessao::grava('nome', $usuario->nome);
            
            if ($usuario->papel == 'cadastro') {
                $this->redirect('/produtor');
            } else {
                $this->redirect('/julgamento');
            }
        } else {
            $this->redirect('/login');
        }
    }

    public function sair() {
        Sessao::limpa('id_usuario');
        $this->redirect('/login');
    }
}