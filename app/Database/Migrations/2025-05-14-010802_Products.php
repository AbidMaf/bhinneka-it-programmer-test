<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Products extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'code' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
                'null' => false,
                'unique' => true
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 128,
                'null' => false
            ],
            'unit' => [
                'type' => 'VARCHAR',
                'constraint' => 16,
                'null' => false,
            ],
            'price' => [
                'type' => 'DECIMAL',
                'null' => false,
                'constraint' => '12,2'
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('m_product', true);
    }

    public function down()
    {
        $this->forge->dropTable('m_product');
    }
}
