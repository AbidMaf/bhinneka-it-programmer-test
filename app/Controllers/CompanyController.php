<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CompanyModel;
use CodeIgniter\HTTP\ResponseInterface;

class CompanyController extends BaseController
{
    public function create()
    {
        $companyModel = new CompanyModel();
        $data = [
            'name' => $this->request->getPost('name'),
            'owner' => $this->request->getPost('owner'),
            'address' => $this->request->getPost('address'),
        ];
        $companyModel->insert($data);
        return redirect()->to('/admin/companies')->with('success', 'Company created successfully');
    }

    public function delete($id)
    {
        $companyModel = new CompanyModel();
        $company = $companyModel->find($id);
        if (!$company) {
            return redirect()->to('/admin/companies')->with('error', 'Company not found');
        }
        $companyModel->delete($id);
        return redirect()->to('/admin/companies')->with('success', 'Company deleted successfully');
    }
    
    public function update()
    {
        $companyModel = new CompanyModel();
        $data = [
            'id' => $this->request->getPost('id'),
            'name' => $this->request->getPost('name'),
            'owner' => $this->request->getPost('owner'),
            'address' => $this->request->getPost('address'),
        ];
        if (!$companyModel->find($data['id'])) {
            return redirect()->to('/admin/companies')->with('error', 'Company not found');
        }

        if ($companyModel->update($data['id'], $data)) {
            return redirect()->to('/admin/companies')->with('success', 'Company updated successfully');
        } else {
            return redirect()->to('/admin/companies')->with('error', 'Failed to update company');
        }
    }
}
