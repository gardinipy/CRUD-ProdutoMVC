<?php
namespace App\Controllers;

use App\Lib\Sessao;
use App\Lib\Util;
use App\Models\DAO\JuizDAO;
use App\Models\Entidades\Juiz;

class JuizController extends Controller
{
    public function index()
    {
        $juizDAO = new JuizDAO();
        self::setViewParam('juizes', $juizDAO->listar());
        $this->render('juiz/listar');
        Sessao::limpaMensagem();
    }

    public function cadastrar()
    {
        $this->render('juiz/cadastrar');
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function editar($param)
    {
        $id = $param[0] ?? null;
        $juizDAO = new JuizDAO();
        $juiz = $juizDAO->buscar($id);

        if (!$juiz) {
            Sessao::gravaMensagem('<div class="alert alert-danger">Juiz não encontrado.</div>');
            $this->redirect('/juiz/index');
        }

        self::setViewParam('juiz', $juiz);
        $this->render('juiz/editar');
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function salvar($param)
    {
        $cmd = $param[0] ?? 'novo';
        $dados = Util::sanitizar($_POST);

        $juiz = new Juiz();
        $juiz->setJuiz($dados);

        if (empty($dados['nome_juiz'])) {
            Sessao::gravaMensagem('<div class="alert alert-danger">O nome do juiz é obrigatório.</div>');
            self::setViewParam('juiz', $juiz);
            $this->render($cmd == 'editar' ? 'juiz/editar' : 'juiz/cadastrar');
            return;
        }

        $juizDAO = new JuizDAO();

        if ($cmd == 'editar') {
            $juizDAO->atualizar($juiz);
            Sessao::gravaMensagem('<div class="alert alert-success">Juiz atualizado com sucesso.</div>');
        } else {
            $juizDAO->salvar($juiz);
            Sessao::gravaMensagem('<div class="alert alert-success">Juiz cadastrado com sucesso.</div>');
        }

        $this->redirect('/juiz/index');
    }

    public function excluir()
    {
        $id = Util::sanitizar($_POST['id_juiz']);
        $juizDAO = new JuizDAO();

        try {
            if ($juizDAO->excluir($id)) {
                Sessao::gravaMensagem('<div class="alert alert-success">Juiz excluído com sucesso.</div>');
            } else {
                Sessao::gravaMensagem('<div class="alert alert-danger">Erro ao excluir o juiz.</div>');
            }
        } catch (\Exception $e) {
            Sessao::gravaMensagem('<div class="alert alert-danger">Não é possível excluir: juiz possui julgamentos vinculados.</div>');
        }

        $this->redirect('/juiz/index');
    }
}
