<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthPermissionCategoryModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'auth_permissions_categories';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['name', 'description'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    
    // Validation
    protected $validationRules      = [
        'id'   => 'max_length[19]',
        'name' => 'required|is_unique[auth_permissions_categories.name,id,{id}]',
    ];
    protected $validationMessages   = [
        'name' => [
            'is_unique' => 'This permission category is already registered!',
        ],
    ];
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

}