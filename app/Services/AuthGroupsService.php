<?php
// app/Services/AuthGroupsService.php

namespace App\Services;

use App\Models\AuthGroupModel;

class AuthGroupsService
{
    protected $authGroupModel;

    public function __construct(AuthGroupModel $authGroupModel)
    {
        $this->authGroupModel = $authGroupModel;
    }

    public function getGroups()
    {
        // get auth groups from database using model
        return $this->authGroupModel->findAll();
    }

}
