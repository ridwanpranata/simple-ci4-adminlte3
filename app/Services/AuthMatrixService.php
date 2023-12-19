<?php

namespace App\Services;

use App\Models\AuthGroupHasPermissionModel;
use App\Models\AuthGroupModel;

class AuthMatrixService
{
    protected $authGroupHasPermissionModel;

    public function __construct()
    {
        $this->AuthGroupHasPermissionModel = new AuthGroupHasPermissionModel();
        $this->AuthGroupModel = new AuthGroupModel();
    }

    public function getMatrix()
    {
        $matrix = [];
        $groups = $this->AuthGroupModel->findAll();
        foreach ($groups as $key => $group) {
            $permissions = $this->AuthGroupHasPermissionModel
                            ->join('auth_permissions','auth_permissions.id = auth_groups_has_permissions.permission_id')
                            ->where('auth_groups_has_permissions.group_id', $group->id)
                            ->get()->getResult();
            
            $matrix_data = (object) [
                'group_name' => $group->name,
                'permissions' => array_column($permissions,'name'),
            ];
            $matrix[] = $matrix_data;
        }
        return $matrix;
    }

}
