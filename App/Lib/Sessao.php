<?php

namespace App\Lib;

class Sessao
{
    public static function gravaMensagem($mensagem){
        $_SESSION['mensagem'] = $mensagem;
    }

    public static function limpaMensagem(){
        if (isset($_SESSION['mensagem'])){
            unset($_SESSION['mensagem']);
        }
    }

    public static function retornaMensagem(){
        return (isset($_SESSION['mensagem'])) ? $_SESSION['mensagem'] : "";
    }

    public static function gravaFormulario($form){
        $_SESSION['form'] = $form;
    }

    public static function limpaFormulario(){
        if (isset($_SESSION['form'])){
            unset($_SESSION['form']);
        }
    }

    public static function retornaValorFormulario($key){
        return (isset($_SESSION['form'][$key])) ? $_SESSION['form'][$key] : "";
    }

    public static function existeFormulario(){
        return (isset($_SESSION['form'])) ? $_SESSION['form'] : "";
    }

    public static function gravaErro($key,$msg) {
        $_SESSION['erro'][$key] = $msg; 
    }
    
    public static function retornaErro($key) {
        return (isset($_SESSION['erro'][$key])) ? $_SESSION['erro'][$key] : "";
    }

    public static function limpaErro(){
        if (isset($_SESSION['erro'])){
            unset($_SESSION['erro']);
        }
    }

    // =======================================================
    // MÉTODOS GENÉRICOS ADICIONADOS PARA O LOGIN E SESSÃO
    // =======================================================
    
    public static function gravar($chave, $valor) {
        $_SESSION[$chave] = $valor;
    }

    public static function existe($chave) {
        return isset($_SESSION[$chave]);
    }

    public static function retornaValor($chave) {
        return (isset($_SESSION[$chave])) ? $_SESSION[$chave] : "";
    }

    public static function limpar($chave) {
        if (isset($_SESSION[$chave])) {
            unset($_SESSION[$chave]);
        }
    }
}