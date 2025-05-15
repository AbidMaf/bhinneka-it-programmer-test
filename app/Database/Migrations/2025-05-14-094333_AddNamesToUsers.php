<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Forge;
use CodeIgniter\Database\Migration;

class AddNamesToUsers extends Migration
{
    private array $tables;

    public function __construct(?Forge $forge = null) {
        parent::__construct($forge);
        $authConfig = config('Auth');
        $this->tables = $authConfig->tables;
    }

    public function up()
    {
        $fields = [
            'first_name' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true
            ],
            'last_name' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true
            ]
        ];
        $this->forge->addColumn($this->tables['users'], $fields);
    }

    public function down()
    {
        $this->forge->dropColumn($this->tables['users'], 'first_name');
        $this->forge->dropColumn($this->tables['users'], 'last_name');
    }
}
