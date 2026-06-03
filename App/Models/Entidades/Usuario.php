<?php
namespace App\Models\Entidades;

class Usuario {
    private $id_usuario;
    private $nome;
    private $email;
    private $senha;
    private $papel;

    // Crie os getters e setters padrão aqui
    public function getIdUsuario() { return $this->id_usuario; }
    public function setIdUsuario($id) { $this->id_usuario = $id; }
    public function getPapel() { return $this->papel; }
    public function setPapel($papel) { $this->papel = $papel; }
}