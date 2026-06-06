<?php
namespace App\Controllers;

use App\Lib\Sessao;
use App\Lib\Util;
use App\Models\DAO\ProdutorRuralDAO;
use App\Models\DAO\ProdutoDAO;
use App\Models\DAO\InscricaoDAO;
use App\Models\Entidades\Inscricao;

class InscricaoController extends Controller
{
    public function index()
    {
        $inscricaoDAO = new InscricaoDAO();
        self::setViewParam('inscricoes', $inscricaoDAO->listarCompleto());
        $this->render('inscricao/listar');
        Sessao::limpaMensagem();
    }

    public function cadastrar()
    {
        $daoProdutor = new ProdutorRuralDAO();
        $daoProduto = new ProdutoDAO();

        self::setViewParam('produtores', $daoProdutor->listar());
        self::setViewParam('produtos', $daoProduto->listar());

        $this->render('inscricao/cadastrar');
        Sessao::limpaMensagem();
    }

    public function editar($param)
    {
        $numero = $param[0] ?? null;
        $inscricaoDAO = new InscricaoDAO();
        $inscricao = $inscricaoDAO->buscar($numero);

        if (!$inscricao) {
            Sessao::gravaMensagem('<div class="alert alert-danger">Inscrição não encontrada.</div>');
            $this->redirect('/inscricao/index');
        }

        $daoProdutor = new ProdutorRuralDAO();
        $daoProduto = new ProdutoDAO();

        self::setViewParam('inscricao', $inscricao);
        self::setViewParam('produtores', $daoProdutor->listar());
        self::setViewParam('produtos', $daoProduto->listar());
        $this->render('inscricao/editar');
        Sessao::limpaMensagem();
    }

    public function salvar($param)
    {
        $cmd = $param[0] ?? 'novo';
        $dados = Util::sanitizar($_POST);

        $inscricao = new Inscricao();
        $inscricao->setNumeroInscricao($dados['numero_inscricao'] ?? null);
        $inscricao->setIdProdutor($dados['id_produtor']);
        $inscricao->setIdProduto($dados['id_produto']);
        $inscricao->setTipoProduto($dados['tipo_produto']);
        $inscricao->setIdUsuario(Sessao::retornaValor('id_usuario'));

        if (empty($dados['id_produtor']) || empty($dados['id_produto']) || empty($dados['tipo_produto'])) {
            Sessao::gravaMensagem('<div class="alert alert-danger">Preencha todos os campos obrigatórios.</div>');
            $daoProdutor = new ProdutorRuralDAO();
            $daoProduto = new ProdutoDAO();
            self::setViewParam('inscricao', $inscricao);
            self::setViewParam('produtores', $daoProdutor->listar());
            self::setViewParam('produtos', $daoProduto->listar());
            $this->render($cmd == 'editar' ? 'inscricao/editar' : 'inscricao/cadastrar');
            return;
        }

        $dao = new InscricaoDAO();

        if ($cmd == 'editar') {
            $dao->atualizar($inscricao);
            Sessao::gravaMensagem('<div class="alert alert-success">Inscrição atualizada com sucesso.</div>');
            $this->redirect('/inscricao/index');
        } else {
            $dao->salvar($inscricao);
            Sessao::gravaMensagem('<div class="alert alert-success">Ficha de inscrição gerada com sucesso.</div>');
            $this->redirect('/inscricao/index');
        }
    }

    public function excluir()
    {
        $numero = Util::sanitizar($_POST['numero_inscricao']);
        $dao = new InscricaoDAO();

        try {
            if ($dao->excluir($numero)) {
                Sessao::gravaMensagem('<div class="alert alert-success">Inscrição excluída com sucesso.</div>');
            } else {
                Sessao::gravaMensagem('<div class="alert alert-danger">Erro ao excluir a inscrição.</div>');
            }
        } catch (\Exception $e) {
            Sessao::gravaMensagem('<div class="alert alert-danger">Não é possível excluir: inscrição possui julgamentos vinculados.</div>');
        }

        $this->redirect('/inscricao/index');
    }
}
