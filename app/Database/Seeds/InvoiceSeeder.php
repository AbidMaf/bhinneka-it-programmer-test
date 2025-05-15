<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\InvoiceModel;
use App\Models\InvoiceItemModel;

class InvoiceSeeder extends Seeder
{
    public function run()
    {
        $invoiceModel = new InvoiceModel();
        $invoiceItemModel = new InvoiceItemModel();

        $invoice = [
            'invoice_number' => '034/TD/XI/2024',
            'admin_id' => 1,
            'company_id' => 1,
            'created_place' => 'Cirebon'
        ];

        $invoiceItems = [
            [
                'product_id' => 1,
                'quantity' => 10,
                'total_price' => 23000000
            ],
            [
                'product_id' => 2,
                'quantity' => 5,
                'total_price' => 550000
            ],
            [
                'product_id' => 3,
                'quantity' => 19,
                'total_price' => 2375000
            ],
        ];

        $invoiceModel->insert($invoice);
        $invoiceId = $invoiceModel->insertID();
        foreach ($invoiceItems as $item) {
            $item['invoice_id'] = $invoiceId; // Set the invoice_id to the newly created invoice ID
            $invoiceItemModel->insert($item);
        }
    }
}
