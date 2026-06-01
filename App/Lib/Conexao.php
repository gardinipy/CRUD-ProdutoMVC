<?php
namespace App\Lib;
use PDO;
use PDOException;
use Exception;

class Conexao {
    private static $conexao;
    private function __construct() {}

    public static function getConnection() {
        $pdoConfig  = "mysql:host=localhost;dbname=expoAgricola;charset=utf8mb4";
        try {
            if (!isset(self::$conexao)) {
                // Credenciais conforme o script SQL
                self::$conexao = new PDO($pdoConfig, 'feira', 'RimoBp@#2026');
                self::$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$conexao->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            }
            return self::$conexao;
        } catch (PDOException $e) {
            throw new Exception("Erro de conexão: " . $e->getMessage());
        }
    }
}