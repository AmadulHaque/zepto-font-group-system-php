<?php
namespace App\Core;

use PDO;
use PDOException;

class Database {
    private $host;
    private $db;
    private $user;
    private $pass;
    private $charset;
    private $pdo;

    public function __construct() {
        $config = require __DIR__ . '/../../config/database.php';
        $mysqlConfig = $config['connections']['mysql'];

        $this->host = $mysqlConfig['host'];
        $this->db = $mysqlConfig['database'];
        $this->user = $mysqlConfig['username'];
        $this->pass = $mysqlConfig['password'];
        $this->charset = $mysqlConfig['charset'];

        $dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            $this->pdo = new PDO($dsn, $this->user, $this->pass, $options);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public function getConnection() {
        return $this->pdo;
    }

    public function query($sql, $params = [])
    {
        $stmt = $this->pdo->prepare($sql);
        
        // Execute the statement with the provided parameters
        $stmt->execute($params);
        
        // Return the number of affected rows for insertions
        if (strpos($sql, 'INSERT') !== false) {
            return $stmt->rowCount(); // Return number of rows affected
        }
        
        // Fetch results for select queries
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getLastInsertId()
    {
        return $this->pdo->lastInsertId();
    }

}
