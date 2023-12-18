<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthGroupHasPermissionModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'auth_groups_has_permissions';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['group_id', 'permission_id'];

    // Dates
    protected $useTimestamps = true;
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


    public function isGroupHasPermission($group_id, $permission_id)
    {
        $result = $this->where('group_id', $group_id)
                       ->where('permission_id', $permission_id)
                       ->countAllResults();

        return ($result > 0) ? true : false;
    }
}