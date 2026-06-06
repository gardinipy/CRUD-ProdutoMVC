<?php
namespace App\Models\Entidades;

class Juiz
{
    private $id_juiz;
    private $nome_juiz;
    private $email;
    private $senha;

    public function getIdJuiz() { return $this->id_juiz; }
    public function setIdJuiz($id_juiz) { $this->id_juiz = $id_juiz; }

    public function getNomeJuiz() { return $this->nome_juiz; }
    public function setNomeJuiz($nome_juiz) { $this->nome_juiz = $nome_juiz; }

    public function getEmail() { return $this->email; }
    public function setEmail($email) { $this->email = $email; }

    public function getSenha() { return $this->senha; }
    public function setSenha($senha) { $this->senha = $senha; }

    public function setJuiz($dados)
    {
        $this->id_juiz = $dados['id_juiz'] ?? null;
        $this->nome_juiz = $dados['nome_juiz'] ?? null;
        $this->email = $dados['email'] ?? null;
        $this->senha = $dados['senha'] ?? null;
    }
}
