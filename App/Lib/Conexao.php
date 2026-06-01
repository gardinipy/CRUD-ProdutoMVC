<?php
namespace App\Lib;

use PDO;
use PDOException;
use Exception;

class Conexao
{
    private static $conexao;

    private function __construct() {}

    public static function getConnection()
    {
        $pdoConfig  = "mysql:host=localhost;";
        $pdoConfig .= "dbname=expoAgricola;";
        $pdoConfig .= "charset=utf8mb4";

        try {
            if (!isset(self::$conexao)) {
                // Utilizando o utilizador e palavra-passe definidos no script SQL
                self::$conexao = new PDO($pdoConfig, 'feira', 'RimoBp@#2026');
                self::$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            return self::$conexao;
        } catch (PDOException $e) {
            throw new Exception("Erro de ligação com a base de dados: " . $e->getMessage());
        }
    }
}