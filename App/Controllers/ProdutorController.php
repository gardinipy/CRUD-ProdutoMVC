<?php
namespace App\Controllers;

use App\Lib\Sessao;
use App\Lib\Util;
use App\Models\Entidades\ProdutorRural;
use App\Models\DAO\ProdutorRuralDAO;

class ProdutorController extends Controller
{
    public function index()
    {
        $produtorDAO = new ProdutorRuralDAO();
        self::setViewParam('produtores', $produtorDAO->listar());
        $this->render('produtor/listar');
        Sessao::limpaMensagem();
    }

    public function cadastrar()
    {
        $this->render('produtor/cadastrar');
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function editar($param)
    {
        $id = $param[0] ?? null;
        $produtorDAO = new ProdutorRuralDAO();
        $produtor = $produtorDAO->buscar($id);

        if (!$produtor) {
            Sessao::gravaMensagem('<div class="alert alert-danger">Produtor não encontrado.</div>');
            $this->redirect('/produtor/index');
        }

        self::setViewParam('produtor', $produtor);
        $this->render('produtor/editar');
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function salvar($param)
    {
        $cmd = $param[0] ?? 'novo';
        $dados = Util::sanitizar($_POST);

        $produtor = new ProdutorRural();
        $produtor->setIdProdutor($dados['id_produtor'] ?? null);
        $produtor->setNomeProdutor($dados['nome_produtor'] ?? '');
        $produtor->setMunicipio($dados['municipio'] ?? '');
        $produtor->setBairro($dados['bairro'] ?? '');
        $produtor->setTelefone($dados['telefone'] ?? '');

        if (empty($dados['nome_produtor']) || empty($dados['municipio']) || empty($dados['bairro']) || empty($dados['telefone'])) {
            Sessao::gravaMensagem('<div class="alert alert-danger">Preencha todos os campos obrigatórios.</div>');
            self::setViewParam('produtor', $produtor);
            $this->render($cmd == 'editar' ? 'produtor/editar' : 'produtor/cadastrar');
            return;
        }

        $produtorDAO = new ProdutorRuralDAO();

        if ($cmd == 'editar') {
            $produtorDAO->atualizar($produtor);
            Sessao::gravaMensagem('<div class="alert alert-success">Produtor atualizado com sucesso.</div>');
        } else {
            $produtorDAO->salvar($produtor);
            Sessao::gravaMensagem('<div class="alert alert-success">Produtor cadastrado com sucesso.</div>');
        }

        $this->redirect('/produtor/index');
    }

    public function excluir()
    {
        $id = Util::sanitizar($_POST['id_produtor']);
        $produtorDAO = new ProdutorRuralDAO();

        try {
            if ($produtorDAO->excluir($id)) {
                Sessao::gravaMensagem('<div class="alert alert-success">Produtor excluído com sucesso.</div>');
            } else {
                Sessao::gravaMensagem('<div class="alert alert-danger">Erro ao excluir o produtor.</div>');
            }
        } catch (\Exception $e) {
            Sessao::gravaMensagem('<div class="alert alert-danger">Não é possível excluir: produtor possui inscrições vinculadas.</div>');
        }

        $this->redirect('/produtor/index');
    }
}
