<?php
namespace App\Controllers;

use App\Models\Entidades\ProdutorRural;
use App\Models\DAO\ProdutorRuralDAO;

class ProdutorController extends Controller
{
    public function index()
    {
        $produtorDAO = new ProdutorRuralDAO();
        self::setViewParam('produtores', $produtorDAO->listar());
        $this->render('produtor/listar');
    }

    public function cadastrar()
    {
        $this->render('produtor/cadastrar');
    }

    public function salvar()
    {
        $produtor = new ProdutorRural();
        $produtor->setNomeProdutor($_POST['nome_produtor']);
        $produtor->setMunicipio($_POST['municipio']);
        $produtor->setBairro($_POST['bairro']);
        $produtor->setTelefone($_POST['telefone']);

        $produtorDAO = new ProdutorRuralDAO();
        $produtorDAO->salvar($produtor);

        $this->redirect('/produtor/index');
    }
}