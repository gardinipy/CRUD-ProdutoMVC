<?php
namespace App\Models\DAO;

use App\Models\Entidades\ProdutorRural;

class ProdutorRuralDAO extends BaseDAO
{
    public function salvar(ProdutorRural $produtor)
    {
        try {
            $nome = $produtor->getNomeProdutor();
            $municipio = $produtor->getMunicipio();
            $bairro = $produtor->getBairro();
            $telefone = $produtor->getTelefone();

            return $this->insert(
                'produtores_rurais',
                "nome_produtor, municipio, bairro, telefone",
                [
                    ':nome_produtor' => $nome,
                    ':municipio' => $municipio,
                    ':bairro' => $bairro,
                    ':telefone' => $telefone
                ]
            );
        } catch (\Exception $e) {
            throw new \Exception("Erro ao gravar produtor.", 500);
        }
    }

    public function listar()
    {
        return $this->select("SELECT * FROM produtores_rurais");
    }
    // Implementar atualizar() e excluir()
}