<?php

namespace App\Models;

use CodeIgniter\Model;

class InvoiceModel extends Model
{
    protected $table            = 't_invoice';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['invoice_number', 'admin_id', 'company_id', 'created_place', 'is_deleted', 'updated_at'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getAllInvoice() {
        return $this->select('t_invoice.*, m_company.name as company_name, m_company.owner as company_owner, users.first_name, users.last_name')
            ->join('m_company', 't_invoice.company_id = m_company.id')
            ->join('users', 't_invoice.admin_id = users.id')
            ->orderBy('t_invoice.created_at', 'DESC')
            ->where('t_invoice.is_deleted', 0)
            ->findAll();
    }

    public function getInvoiceById($id) {
        return $this->select('t_invoice.*, m_company.name as company_name, m_company.owner as company_owner, users.first_name, users.last_name')
            ->join('m_company', 't_invoice.company_id = m_company.id')
            ->join('users', 't_invoice.admin_id = users.id')
            ->where('t_invoice.id', $id)
            ->where('t_invoice.is_deleted', 0)
            ->first();
    }

    public function softDelete($id) {
        return $this->update($id, [
            'is_deleted' => 1,
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }

    public function getSalesDataLastSixMonths() {
        $sixMonthsAgo = [];
        
        for($i = 0; $i < 6; $i++)
        {
            array_push($sixMonthsAgo, date('F', mktime(0, 0, 0, date('n') - $i, 10)));
        }

        $data = $this->select('COUNT(*) as total_sales, DATE_FORMAT(created_at, "%M") as month')
            ->groupBy('month')
            ->orderBy('created_at', 'DESC')
            ->where('is_deleted',0)
            ->findAll(6);

        // append missing months with 0 sales
        foreach ($sixMonthsAgo as $month) {
            $found = false;
            foreach ($data as $row) {
                if ($row['month'] == $month) {
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                $data[] = [
                    'total_sales' => 0,
                    'month' => $month
                ];
            }
        }

        return $data;
    }
}
