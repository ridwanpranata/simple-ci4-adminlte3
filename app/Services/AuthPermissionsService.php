<?php

namespace App\Services;

use App\Models\AuthPermissionModel;

class AuthPermissionsService
{
    protected $authPermissionModel;

    public function __construct(AuthPermissionModel $authPermissionModel)
    {
        $this->authPermissionModel = $authPermissionModel;
    }

    public function getPermissions()
    {
        // get auth permissions from database using model
        return $this->authPermissionModel->findAll();
    }

}
