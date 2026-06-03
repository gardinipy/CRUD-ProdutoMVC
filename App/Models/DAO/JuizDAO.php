<?php
namespace App\Models\DAO;

use App\Models\Entidades\Juiz;
use App\Lib\Conexao;

class JuizDAO extends BaseDAO {
    
    public function listar() {
        // Liga diretamente à base de dados para evitar erros
        $conexao = Conexao::getConnection();
        
        $sql = "SELECT * FROM juizes";
        $stmt = $conexao->query($sql);
        $juizes = [];
        
        if ($stmt) {
            while ($dado = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                $juiz = new Juiz();
                $juiz->setIdJuiz($dado['id_juiz']);
                $juiz->setNomeJuiz($dado['nome_juiz']);
                $juizes[] = $juiz;
            }
        }
        return $juizes;
    }
}