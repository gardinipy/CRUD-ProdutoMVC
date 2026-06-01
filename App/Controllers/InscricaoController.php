<?php
namespace App\Controllers;
use App\Models\DAO\ProdutorRuralDAO;
use App\Models\DAO\ProdutoAgricolaDAO;
use App\Models\DAO\InscricaoDAO;
use App\Lib\Sessao;

class InscricaoController extends Controller {
    public function cadastrar() {
        $daoProdutor = new ProdutorRuralDAO();
        $daoProduto = new ProdutoAgricolaDAO();
        
        self::setViewParam('produtores', $daoProdutor->listar());
        self::setViewParam('produtos', $daoProduto->listar());
        
        $this->render('inscricao/cadastrar');
    }

    public function salvar() {
        $dao = new InscricaoDAO();
        $id_usuario = Sessao::retorna('id_usuario');
        $dao->salvar($_POST['id_produtor'], $_POST['id_produto'], $_POST['tipo_produto'], $id_usuario);
        $this->redirect('/inscricao/cadastrar');
    }
}sss