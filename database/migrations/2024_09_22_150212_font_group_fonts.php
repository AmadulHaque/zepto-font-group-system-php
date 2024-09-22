<?php

use App\Core\Migration;

return new class extends Migration {
    public $table = 'font_group_fonts';
    public $status = 'create';

    public function up() {
        $sql = "CREATE TABLE $this->table (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255),
            group_id INT,
            font_id INT,
            price INT,
            size INT,
            FOREIGN KEY (group_id) REFERENCES font_groups(id) ON DELETE CASCADE,
            FOREIGN KEY (font_id) REFERENCES fonts(id) ON DELETE CASCADE,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
        $this->pdo->exec($sql);
    }

    public function down() {
        $sql = "DROP TABLE IF EXISTS $this->table";
        $this->pdo->exec($sql);
    }
};
