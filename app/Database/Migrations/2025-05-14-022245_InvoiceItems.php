<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class InvoiceItems extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true
            ],
            'invoice_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => false
            ],
            'product_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => false
            ],
            'quantity' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => false
            ],
            'total_price' => [
                'type' => 'DECIMAL',
                'constraint' => '12,2',
                'null' => false
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('invoice_id', 't_invoice', 'id', 'CASCADE', 'CASCADE', 't_invoice_invoice_id_foreign');
        $this->forge->addForeignKey('product_id', 'm_product', 'id', 'CASCADE', 'CASCADE', 'm_product_product_id_foreign');
        $this->forge->createTable('t_invoice_item', true);
    }

    public function down()
    {
        $this->forge->dropForeignKey('t_invoice_item', 't_invoice_invoice_id_foreign');
        $this->forge->dropForeignKey('t_invoice_item', 'm_product_product_id_foreign');
        $this->forge->dropTable('t_invoice_item');
    }
}
