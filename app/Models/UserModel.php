<?php

declare(strict_types=1);

namespace App\Models;

use CodeIgniter\Shield\Models\UserModel as ShieldUserModel;
use CodeIgniter\Shield\Entities\User;

use App\Models\AuthGroupModel;

class UserModel extends ShieldUserModel
{
    protected function initialize(): void
    {
        parent::initialize();

        $this->allowedFields = [
            ...$this->allowedFields,

            // 'first_name',
        ];

        $this->authGroupsTable = (new AuthGroupModel())->table;
    }

    public function getUserGroupsTitle(User $user): array
    {
        $data = $this->select(sprintf('%1$s.title',$this->authGroupsTable))
        ->join($this->tables['groups_users'], sprintf('%1$s.user_id = %2$s.id', $this->tables['groups_users'], $this->tables['users']))
        ->join($this->authGroupsTable, sprintf('%1$s.name = %2$s.group', $this->authGroupsTable, $this->tables['groups_users']))
        ->findAll($user->id);

        $return = array();
        if($data){
            foreach ($data as $key => $group) {
                $return[] = $group->title;
            }
        }
        return $return;
    }
}
