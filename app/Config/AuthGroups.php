<?php

declare(strict_types=1);

/**
 * This file is part of CodeIgniter Shield.
 *
 * (c) CodeIgniter Foundation <admin@codeigniter.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Config;

use CodeIgniter\Shield\Config\AuthGroups as ShieldAuthGroups;

use App\Services\AuthGroupsService;
use App\Services\AuthPermissionsService;
use App\Services\AuthMatrixService;

class AuthGroups extends ShieldAuthGroups
{
    /**
     * --------------------------------------------------------------------
     * Default Group
     * --------------------------------------------------------------------
     * The group that a newly registered user is added to.
     */
    public string $defaultGroup = 'user';

    /**
     * --------------------------------------------------------------------
     * Groups
     * --------------------------------------------------------------------
     * An associative array of the available groups in the system, where the keys
     * are the group names and the values are arrays of the group info.
     *
     * Whatever value you assign as the key will be used to refer to the group
     * when using functions such as:
     *      $user->addGroup('superadmin');
     *
     * @var array<string, array<string, string>>
     *
     * @see https://codeigniter4.github.io/shield/quick_start_guide/using_authorization/#change-available-groups for more info
     */
    public array $groups = [
        'superadmin' => [
            'title'       => 'Super Admin',
            'description' => 'Complete control of the site.',
        ],
        'admin' => [
            'title'       => 'Admin',
            'description' => 'Day to day administrators of the site.',
        ],
        'developer' => [
            'title'       => 'Developer',
            'description' => 'Site programmers.',
        ],
        'user' => [
            'title'       => 'User',
            'description' => 'General users of the site. Often customers.',
        ],
        'beta' => [
            'title'       => 'Beta User',
            'description' => 'Has access to beta-level features.',
        ],
    ];

    /**
     * --------------------------------------------------------------------
     * Permissions
     * --------------------------------------------------------------------
     * The available permissions in the system.
     *
     * If a permission is not listed here it cannot be used.
     */
    public array $permissions = [
        'admin.access'        => 'Can access the sites admin area',
        'admin.settings'      => 'Can access the main site settings',
        'users.manage-admins' => 'Can manage other admins',
        'users.create'        => 'Can create new non-admin users',
        'users.edit'          => 'Can edit existing non-admin users',
        'users.delete'        => 'Can delete existing non-admin users',
        'beta.access'         => 'Can access beta-level features',
        'book.access'         => 'Can access book features',
        'book.create'         => 'Can create new book',
    ];

    /**
     * --------------------------------------------------------------------
     * Permissions Matrix
     * --------------------------------------------------------------------
     * Maps permissions to groups.
     *
     * This defines group-level permissions.
     */
    public array $matrix = [
        'developer' => [
            'admin.*',
            'users.*',
            'beta.*',
            'book.*',
        ],
        'superadmin' => [
            'admin.*',
            'users.*',
            'beta.*',
        ],
        'admin' => [
            'admin.access',
            'users.create',
            'users.edit',
            'users.delete',
            'beta.access',
            'book.access',
        ],
        'user' => [
            'book.access'
        ],
        'beta' => [
            'beta.access',
        ],
    ];


    public function __construct()
    {
        // Create Instance from service
        $authGroupsService = new AuthGroupsService(new \App\Models\AuthGroupModel());
        $authPermissionsService = new AuthPermissionsService(new \App\Models\AuthPermissionModel());
        $authMatrixService = new AuthMatrixService();


        /*
        * Manipulate Group variable
        * Get Group from service
        */
        $groups = $authGroupsService->getGroups();

        // Fill the Group with data from service
        foreach ($groups as $group) {
            $this->groups[$group->name] = [
                'title'       => $group->title,
                'description' => $group->description,
            ];
        }

        /*
        * Manipulate Permission variable
        * Get Permission from service
        */
        $permissions = $authPermissionsService->getPermissions();

        // Fill the Permission with data from service
        foreach ($permissions as $permission) {
            $this->permissions[$permission->name] = $permission->description;
        }


        /*
        * Manipulate Matrix (Group has Permissions) variable
        * Get Matrix from service
        */
        $matrix = $authMatrixService->getMatrix();

        // Fill the Permission with data from permissions service
        foreach ($matrix as $group) {
            $this->matrix[$group->group_name] = $group->permissions;
        }
        
        // ... (rest of the constructor)
    }
}
