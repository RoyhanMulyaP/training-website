<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateListfilm extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'slug' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'judul' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'sutradara' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'synopsis' => [
                'type'       => 'VARCHAR',
                'constraint' => 1000,
            ],
            'cover' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('listfilm');
    }

    public function down()
    {
        $this->forge->dropTable('listfilm');
    }
}
