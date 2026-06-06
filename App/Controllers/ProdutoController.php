<?php
namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\ProdutoDAO;
use App\Models\Entidades\Produto;
use App\Lib\Util;

class ProdutoController extends Controller
{
    public function listar()
    {
        $produtoDAO = new ProdutoDAO();
        self::setViewParam('listaProdutos', $produtoDAO->listar());
        $this->render('produto/listar');
        Sessao::limpaMensagem();
    }

    public function cadastrar()
    {
        $this->render('produto/cadastrar');
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function editar($param)
    {
        $id = $param[0] ?? null;
        $produtoDAO = new ProdutoDAO();
        $produto = $produtoDAO->listar($id);

        if (!$produto) {
            Sessao::gravaMensagem('<div class="alert alert-danger">Produto não encontrado.</div>');
            $this->redirect('/produto/listar');
        }

        self::setViewParam('produto', $produto);
        $this->render('produto/editar');
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function salvar($param)
    {
        $cmd = $param[0];
        $dadosform = Util::sanitizar($_POST);

        $objproduto = new Produto();
        $objproduto->setProduto($dadosform);

        $errovalidacao = false;

        if (empty($dadosform['nome_produto'])) {
            Sessao::gravaMensagem('<div class="alert alert-danger">Verifique os campos obrigatórios.</div>');
            Sessao::gravaErro('erronome', 'Este campo deve ser preenchido');
            $errovalidacao = true;
        }

        if ($errovalidacao) {
            self::setViewParam('produto', $objproduto);
            if ($cmd == 'editar') {
                $this->render('produto/editar');
            } else {
                $this->render('produto/cadastrar');
            }
            return;
        }

        $produtoDAO = new ProdutoDAO();

        if ($cmd == 'editar') {
            $produtoDAO->atualizar($objproduto);
            Sessao::gravaMensagem('<div class="alert alert-success">Produto atualizado com sucesso.</div>');
        } else {
            $produtoDAO->salvar($objproduto);
            Sessao::gravaMensagem('<div class="alert alert-success">Novo produto gravado com sucesso.</div>');
        }

        Sessao::limpaErro();
        $this->redirect('/produto/listar');
    }

    public function excluir()
    {
        $id = Util::sanitizar($_POST['id_produto']);
        $produtoDAO = new ProdutoDAO();

        if (!$produtoDAO->excluir($id)) {
            Sessao::gravaMensagem('<div class="alert alert-danger">Erro ao excluir o produto.</div>');
        } else {
            Sessao::gravaMensagem('<div class="alert alert-success">Produto excluído com sucesso!</div>');
        }
        $this->redirect('/produto/listar');
    }
}
