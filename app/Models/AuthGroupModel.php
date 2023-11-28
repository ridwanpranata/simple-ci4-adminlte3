<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthGroupModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'auth_groups';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['name', 'title', 'description'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    
    // Validation
    protected $validationRules      = [
        'id'   => 'max_length[19]',
        'name' => 'required|is_unique[auth_groups.name,id,{id}]|regex_match[/^[a-z_]+$/]',
    ];
    protected $validationMessages   = [
        'name' => [
            'is_unique' => 'This group is already registered!',
            'regex_match' => 'Group name is not valid! Use only lowercase letters and underscores',
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