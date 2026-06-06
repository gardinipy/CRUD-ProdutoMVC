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
        $pdoConfig = DB_DRIVER . ':host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4';

        try {
            if (!isset(self::$conexao)) {
                self::$conexao = new PDO($pdoConfig, DB_USER, DB_PASSWORD);
                self::$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$conexao->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            }
            return self::$conexao;
        } catch (PDOException $e) {
            throw new Exception("Erro de conexão: " . $e->getMessage());
        }
    }
}
