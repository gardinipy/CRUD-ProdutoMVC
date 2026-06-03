<?php
namespace App\Controllers;

use App\Models\DAO\InscricaoDAO;
use App\Models\DAO\JulgamentoDAO;
use App\Models\Entidades\Inscricao;
use App\Lib\Sessao;

// Para o preenchimento das combos
use App\Models\DAO\ProdutorRuralDAO; 
use App\Models\DAO\ProdutoDAO;
use App\Models\DAO\JuizDAO; 

class JulgamentoController extends Controller {

    public function __construct() {
        if (!Sessao::existe('usuario_logado')) {
            $this->redirect('/login');
        }
    }

    // --- RECPÇÃO E INSCRIÇÃO ---
    public function inscricao() {
        $produtorDAO = new ProdutorRuralDAO();
        $produtoDAO = new ProdutoDAO();
        
        self::setViewParam('produtores', $produtorDAO->listar()); // Certifique-se que o ProdutorRuralDAO lista da tabela produtores_rurais
        self::setViewParam('produtos', $produtoDAO->listar());    // Certifique-se que o ProdutoDAO lista da tabela produtos_agricolas
        
        $this->render('julgamento/inscricao');
    }

    public function salvarInscricao() {
        $inscricao = new Inscricao();
        $inscricao->setIdProdutor($_POST['id_produtor']);
        $inscricao->setIdProduto($_POST['id_produto']);
        $inscricao->setTipoProduto($_POST['tipo_produto']); // organico, convencional, nao_convencional
        $inscricao->setIdUsuario(Sessao::retornaValor('id_usuario')); // O usuário logado que cadastrou
        
        $dao = new InscricaoDAO();
        if ($dao->salvar($inscricao)) {
            Sessao::gravar('mensagemSucesso', 'Ficha de inscrição gerada com sucesso!');
        } else {
            Sessao::gravar('mensagemErro', 'Falha ao inscrever o produto.');
        }
        $this->redirect('/julgamento/inscricao');
    }

    // --- JULGAMENTO ---
    public function avaliar() {
        $inscricaoDAO = new InscricaoDAO();
        $juizDAO = new JuizDAO(); // Certifique-se que este DAO lista da tabela juizes
        
        self::setViewParam('fichas', $inscricaoDAO->listarCompleto());
        self::setViewParam('juizes', $juizDAO->listar());
        
        $this->render('julgamento/avaliar');
    }

    public function salvarAvaliacao() {
        $id_inscricao = $_POST['id_inscricao'];
        $id_juiz = $_POST['id_juiz'];
        
        // Mapear os 6 critérios para o formato [id_criterio => nota]
        $notas = [];
        for ($i = 1; $i <= 6; $i++) {
            $notas[$i] = $this->validarNota($_POST["nota{$i}"]);
        }
        
        $dao = new JulgamentoDAO();
        if ($dao->salvarNotas($id_inscricao, $id_juiz, $notas)) {
            Sessao::gravar('mensagemSucesso', 'Julgamento registrado com sucesso!');
        } else {
            Sessao::gravar('mensagemErro', 'Erro ao salvar notas.');
        }
        
        $this->redirect('/julgamento/avaliar');
    }

    private function validarNota($nota) {
        $n = (float) str_replace(',', '.', $nota);
        if ($n < 0) return 0;
        if ($n > 10) return 10;
        return $n;
    }
}