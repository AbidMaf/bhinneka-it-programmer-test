<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call('CompaniesSeeder');
        $this->call('ProductsSeeder');
        $this->call('AdminUserSeeder');
        $this->call('InvoiceSeeder');
    }
}
