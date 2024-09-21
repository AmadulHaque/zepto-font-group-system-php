<?php

use App\Core\Migration;

return new class extends Migration {
    public $table = 'users';
    public $status = 'create';

    public function up() {
        $sql = "CREATE TABLE $this->table (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(100),
            email VARCHAR(100),
            phone CHAR(15),
            password VARCHAR(20),
            is_admin ENUM('1', '0') DEFAULT '0',
            address VARCHAR(200) NULL,
            status ENUM('1', '0') DEFAULT '1',
            avatar VARCHAR(250) NULL,
            title VARCHAR(250) NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
        $this->pdo->exec($sql);
    }

    public function down() {
        $sql = "DROP TABLE IF EXISTS $this->table";
        $this->pdo->exec($sql);
    }
};
