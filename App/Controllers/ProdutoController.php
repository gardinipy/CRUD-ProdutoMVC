<?php
namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\ProdutoDAO;
use App\Models\Entidades\Produto;
use App\Lib\Util;

class ProdutoController extends Controller {

    public function __construct() {
        if (!Sessao::existe('usuario_logado')) {
            $this->redirect('/login');
        }
    }

    public function listar() {
        $produtoDAO = new ProdutoDAO();
        self::setViewParam('listaProdutos', $produtoDAO->listar());
        $this->render('/produto/listar');
        Sessao::limpaMensagem();
    }
    
    public function cadastrar() {
        $this->render('/produto/cadastrar');
        Sessao::limpaMensagem();
        Sessao::limpaErro();
    }

    public function salvar($param) {
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
            if ($cmd == 'editar'){ 
                $this->render('/produto/editar');
            } elseif ($cmd == 'novo'){ 
                $this->render('/produto/cadastrar');
            }
            die();
        }
          
        $produtoDAO = new ProdutoDAO(); 
        
        if ($cmd == 'editar'){ 
            $produtoDAO->atualizar($objproduto);
            Sessao::gravaMensagem('<div class="alert alert-success">Produto atualizado com sucesso.</div>');
        } elseif ($cmd == 'novo'){ 
            $produtoDAO->salvar($objproduto);
            Sessao::gravaMensagem('<div class="alert alert-success">Novo Produto gravado com sucesso.</div>');
        }
        
        Sessao::limpaErro();
        $this->redirect('/produto/listar');      
    }

    public function excluir($param) {
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