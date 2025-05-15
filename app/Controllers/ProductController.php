<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductModel;
use CodeIgniter\HTTP\ResponseInterface;

class ProductController extends BaseController
{
    public function create()
    {
        $productModel = new ProductModel();
        $data =[
            'code' => $this->request->getPost('code'),
            'name' => $this->request->getPost('name'),
            'price' => $this->request->getPost('price'),
            'unit' => $this->request->getPost('unit'),
        ];

        $productModel->insert($data);
        return redirect()->to('/admin/products')->with('success', 'Product created successfully');
    }

    public function delete($id) {
        $productModel = new ProductModel();
        $product = $productModel->find($id);
        if(!$product) {
            return redirect()->to('/admin/products')->with('error', 'Product not found');
        }
        $productModel->delete($id);
        return redirect()->to('/admin/products')->with('success', 'Product deleted successfully');
    }

    public function update() {
        $productModel = new ProductModel();
        $data = [
            'id' => $this->request->getPost('id'),
            'code' => $this->request->getPost('code'),
            'name' => $this->request->getPost('name'),
            'price' => $this->request->getPost('price'),
            'unit' => $this->request->getPost('unit'),
        ];
        if(!$productModel->find($data['id'])) {
            return redirect()->to('/admin/products')->with('error', 'Product not found');
        }

        if ($productModel->update($data['id'], $data)) {
            return redirect()->to('/admin/products')->with('success', 'Product updated successfully');
        } else {
            return redirect()->to('/admin/products')->with('error', 'Failed to update product');
        }
    }
}
