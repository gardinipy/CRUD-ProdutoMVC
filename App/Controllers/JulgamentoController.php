<?php
namespace App\Controllers;
use App\Models\DAO\InscricaoDAO;
use App\Models\DAO\JulgamentoDAO;

class JulgamentoController extends Controller {
    public function index() {
        $dao = new InscricaoDAO();
        self::setViewParam('inscricoes', $dao->listarInscricoesPendentes());
        $this->render('julgamento/listar');
    }

    public function avaliar() {
        $dao = new JulgamentoDAO();
        self::setViewParam('id_inscricao', $_GET['id']);
        self::setViewParam('criterios', $dao->buscarCriterios());
        self::setViewParam('juizes', $dao->buscarJuizes());
        $this->render('julgamento/avaliar');
    }

    public function salvarNotas() {
        $dao = new JulgamentoDAO();
        $id_inscricao = $_POST['id_inscricao'];
        $id_juiz = $_POST['id_juiz'];
        $notas = $_POST['notas']; // Array de notas vindo do form

        foreach ($notas as $id_criterio => $nota) {
            $dao->salvarNota($id_inscricao, $id_juiz, $id_criterio, $nota);
        }

        $dao->atualizarNotaFinal($id_inscricao);
        $this->redirect('/julgamento');
    }
}