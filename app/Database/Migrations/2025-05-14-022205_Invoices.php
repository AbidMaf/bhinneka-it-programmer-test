<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Invoices extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'invoice_number' => [
                'type' => 'VARCHAR',
                'constraint' => 36,
                'null' => false,
                'unique' => true
            ],
            'admin_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => false
            ],
            'company_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => false
            ],
            'created_place' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ],
            'is_deleted' => [
                'type' => 'TINYINT',
                'null' => false,
                'default' => 0
            ],
            'created_at' => [
                'type' => 'DATE',
                'null' => false,
                'default' => date('Y-m-d')
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
                'default' => null
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('company_id', 'm_company', 'id', 'CASCADE', 'NO_ACTION', 't_invoice_company_id_foreign');
        $this->forge->addForeignKey('admin_id', 'users', 'id', 'CASCADE', 'NO_ACTION', 't_invoice_admin_id_foreign');
        $this->forge->createTable('t_invoice', true);
    }

    public function down()
    {
        $this->forge->dropForeignKey('t_invoice', 't_invoice_company_id_foreign');
        $this->forge->dropForeignKey('t_invoice', 't_invoice_admin_id_foreign');
        $this->forge->dropTable('t_invoice');
    }
}
