<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductModel;
use App\Models\CompanyModel;
use App\Models\InvoiceModel;
use App\Models\InvoiceItemModel;
use CodeIgniter\HTTP\ResponseInterface;

class DashboardController extends BaseController
{

    public function __construct() {
        helper('roman');
    }

    public function index()
    {
        $invoiceModel = new InvoiceModel();
        $invoiceItemModel = new InvoiceItemModel();

        $totalInvoices = $invoiceModel->countAll();
        $totalRevenue = $invoiceItemModel->selectSum('total_price')->first();
        $totalCompanies = $invoiceModel->selectCount('company_id')->groupBy('company_id')->countAllResults();
        $salesData = $invoiceModel->getSalesDataLastSixMonths();

        return view('admin/dashboard/index', [
            'totalInvoices' => $totalInvoices,
            'totalRevenue' => $totalRevenue['total_price'] ?? 0,
            'totalCompanies' => $totalCompanies,
            'salesData' => $salesData
        ]);
    }

    public function productsIndex() {
        $productModel = new ProductModel();
        $products = $productModel->findAll();

        // Get last product code and increment it
        $lastProduct = $productModel->orderBy('code', 'DESC')->first();
        $lastCode = $lastProduct ? $lastProduct['code'] : 'PR00';
        $lastCode = substr($lastCode, 2);
        $lastCode = (int)$lastCode + 1;
        $lastCode = 'PR' . str_pad($lastCode, strlen($lastCode) <= 2 ? 2 : strlen($lastCode), '0', STR_PAD_LEFT);

        $data = [
            'products' => $products,
            'lastCode' => $lastCode,
        ];
        return view('admin/dashboard/products', ["data" => $data]);
    }

    public function companiesIndex() {
        $companyModel = new CompanyModel();
        $companies = $companyModel->findAll();
        $data = [
            'companies' => $companies,
        ];
        return view('admin/dashboard/companies', ["data" => $data]);
    }

    public function invoicesIndex() {
        $invoiceModel = new InvoiceModel();
        $companyModel = new CompanyModel();
        $productModel = new ProductModel();

        $invoices = $invoiceModel->getAllInvoice();

        // Get last invoice number and increment it
        $lastInvoice = $invoiceModel->orderBy('invoice_number', 'DESC')->first();
        $lastInvoiceNumber = $lastInvoice ? $lastInvoice['invoice_number'] : '000/TD/XI/2024';
        $lastInvoiceNumber = substr($lastInvoiceNumber, 0, 3);
        $currentYear = date('Y');
        $currentMonthInRoman = intToRomanNumeral(date('n'));
        $lastInvoiceNumber = (int)$lastInvoiceNumber + 1;
        $lastInvoiceNumber = str_pad($lastInvoiceNumber, 3, '0', STR_PAD_LEFT) . '/TD/' . $currentMonthInRoman . '/' . $currentYear;

        $companies = $companyModel->findAll();
        $products = $productModel->findAll();
        $data = [
            'invoices' => $invoices,
            'companies' => $companies,
            'products' => $products,
            'lastInvoiceNumber' => $lastInvoiceNumber
        ];
        return view('admin/dashboard/invoices', ["data" => $data]);
    }

    public function invoiceDetail($id)
    {
        $invoiceModel = new InvoiceModel();
        $itemModel = new InvoiceItemModel();

        $invoice = $invoiceModel
            ->select('t_invoice.*, m_company.name as company_name')
            ->join('m_company', 'm_company.id = t_invoice.company_id')
            ->where('t_invoice.id', $id)
            ->first();

        $items = $itemModel->getInvoiceDetails($id);

        return view('admin/dashboard/components/detail_modal',  [
            'invoice' => $invoice,
            'invoiceDetails' => $items
        ]);
    }
}
