<?php

namespace App\Database\Seeds;

use App\Models\ProductModel;
use CodeIgniter\Database\Seeder;

class ProductsSeeder extends Seeder
{
    public function run()
    {
        $products = [
            [
                'code' => 'PR01',
                'name' => 'Ban Luar',
                'unit' => 'Pcs',
                'price' => 2300000
            ],
            [
                'code' => 'PR02',
                'name' => 'Baut Ukuran 18',
                'unit' => 'Dus',
                'price' => 100000
            ],
            [
                'code' => 'PR03',
                'name' => 'Oli Mesin',
                'unit' => 'Liter',
                'price' => 125000
            ]
        ];
        $model = new ProductModel();
        foreach($products as $product) {
            $model->insert($product);
        }
    }
}
