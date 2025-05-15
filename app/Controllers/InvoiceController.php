<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\InvoiceModel;
use App\Models\InvoiceItemModel;
use App\Models\ProductModel;
use CodeIgniter\HTTP\ResponseInterface;

class InvoiceController extends BaseController
{
    public function create()
    {
        $invoiceModel = new InvoiceModel();
        $itemModel = new InvoiceItemModel();
        $productModel = new ProductModel();

        $companyId = $this->request->getPost('company_id');
        $place = $this->request->getPost('place');
        $products = $this->request->getPost('products');
        $quantities = $this->request->getPost('quantities');
        $invoiceNumber = $this->request->getPost('invoice_number');

        $invoiceData = [
            'company_id' => $companyId,
            'place' => $place,
            'admin_id' => user_id(),
            'invoice_number' => $invoiceNumber
        ];

        $invoiceModel->insert($invoiceData);
        $invoiceId = $invoiceModel->getInsertID();

        foreach ($products as $index => $productId) {
            $qty = $quantities[$index];
            $product = $productModel->find($productId);
            if (!$product) continue;

            $itemModel->insert([
                'invoice_id' => $invoiceId,
                'product_id' => $productId,
                'quantity' => $qty,
                'total_price' => $qty * $product['price'],
            ]);
        }

        return redirect()->to('/admin/invoices')->with('success', 'Invoice created!');
    }

    public function getById($id) {
        $invoiceModel = new InvoiceModel();
        $itemModel = new InvoiceItemModel();

        $invoice = $invoiceModel->getInvoiceById($id);

        $items = $itemModel->getInvoiceDetails($id);

        return view('admin/dashboard/components/detail_modal', [
            'invoice' => $invoice,
            'invoiceItems' => $items
        ]);
    }

    public function delete($id) {
        $invoiceModel = new InvoiceModel();

        if(!$invoiceModel->find($id)) {
            return redirect()->to('/admin/invoices')->with('error', 'Invoice not found!');
        }

        if($invoiceModel->softDelete($id)) {
            return redirect()->to('/admin/invoices')->with('success', 'Invoice deleted!');
        }
        return redirect()->to('/admin/invoices')->with('error', 'Failed to delete invoice!');
    }
}
