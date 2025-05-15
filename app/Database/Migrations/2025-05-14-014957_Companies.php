<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Companies extends Migration
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
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 128,
                'null' => false
            ],
            'owner' => [
                'type' => 'VARCHAR',
                'constraint' => 128,
                'null' => false
            ],
            'address' => [
                'type' => 'TEXT',
                'null' => false
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('m_company', true);
    }

    public function down()
    {
        $this->forge->dropTable('m_company');
    }
}
