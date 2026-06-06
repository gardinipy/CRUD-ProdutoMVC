<?php
namespace App\Controllers;

use App\Lib\Sessao;
use App\Lib\Util;
use App\Models\DAO\UsuarioDAO;
use App\Models\Entidades\Usuario;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarioDAO = new UsuarioDAO();
        self::setViewParam('usuarios', $usuarioDAO->listar());
        $this->render('usuario/listar');
        Sessao::limpaMensagem();
    }

    public function cadastrar()
    {
        $this->render('usuario/cadastrar');
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function editar($param)
    {
        $id = $param[0] ?? null;
        $usuarioDAO = new UsuarioDAO();
        $usuario = $usuarioDAO->buscar($id);

        if (!$usuario) {
            Sessao::gravaMensagem('<div class="alert alert-danger">Usuário não encontrado.</div>');
            $this->redirect('/usuario/index');
        }

        self::setViewParam('usuario', $usuario);
        $this->render('usuario/editar');
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function salvar($param)
    {
        $cmd = $param[0] ?? 'novo';
        $dados = Util::sanitizar($_POST);

        $usuario = new Usuario();
        $usuario->setIdUsuario($dados['id_usuario'] ?? null);
        $usuario->setNome($dados['nome'] ?? '');
        $usuario->setEmail($dados['email'] ?? '');
        $usuario->setSenha($dados['senha'] ?? '');
        $usuario->setPapel($dados['papel'] ?? 'cadastro');

        if (empty($dados['nome']) || empty($dados['email']) || empty($dados['senha']) || empty($dados['papel'])) {
            Sessao::gravaMensagem('<div class="alert alert-danger">Preencha todos os campos obrigatórios.</div>');
            self::setViewParam('usuario', $usuario);
            $this->render($cmd == 'editar' ? 'usuario/editar' : 'usuario/cadastrar');
            return;
        }

        $usuarioDAO = new UsuarioDAO();
        $emailExistente = $usuarioDAO->buscarPorEmail($dados['email'], $dados['id_usuario'] ?? null);

        if ($emailExistente) {
            Sessao::gravaMensagem('<div class="alert alert-danger">Este e-mail já está cadastrado.</div>');
            self::setViewParam('usuario', $usuario);
            $this->render($cmd == 'editar' ? 'usuario/editar' : 'usuario/cadastrar');
            return;
        }

        if ($cmd == 'editar') {
            $usuarioDAO->atualizar($usuario);
            Sessao::gravaMensagem('<div class="alert alert-success">Usuário atualizado com sucesso.</div>');
        } else {
            $usuarioDAO->salvar($usuario);
            Sessao::gravaMensagem('<div class="alert alert-success">Usuário cadastrado com sucesso.</div>');
        }

        $this->redirect('/usuario/index');
    }

    public function excluir()
    {
        $id = Util::sanitizar($_POST['id_usuario']);

        if ($id == Sessao::retornaValor('id_usuario')) {
            Sessao::gravaMensagem('<div class="alert alert-danger">Você não pode excluir o usuário logado.</div>');
            $this->redirect('/usuario/index');
        }

        $usuarioDAO = new UsuarioDAO();

        try {
            if ($usuarioDAO->excluir($id)) {
                Sessao::gravaMensagem('<div class="alert alert-success">Usuário excluído com sucesso.</div>');
            } else {
                Sessao::gravaMensagem('<div class="alert alert-danger">Erro ao excluir o usuário.</div>');
            }
        } catch (\Exception $e) {
            Sessao::gravaMensagem('<div class="alert alert-danger">Não é possível excluir: usuário possui inscrições vinculadas.</div>');
        }

        $this->redirect('/usuario/index');
    }
}
