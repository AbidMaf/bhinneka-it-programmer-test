<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\CompanyModel;

class CompaniesSeeder extends Seeder
{
    public function run()
    {
        $companyModel = new CompanyModel();
        $data = [
            [
                'name' => 'PT. Sentosa',
                'owner' => 'Robert',
                'address' => 'Jl. Bypass Cirebon'
            ]
        ];

        foreach($data as $company) {
            $companyModel->insert($company);
        }
    }
}
