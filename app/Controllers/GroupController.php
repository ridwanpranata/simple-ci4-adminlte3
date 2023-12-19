<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AuthGroupModel;
use App\Models\AuthPermissionModel;
use App\Models\AuthGroupHasPermissionModel;
use App\Models\AuthPermissionCategoryModel;


class GroupController extends BaseController
{
    protected $AuthGroupModel;
    protected $AuthPermissionModel;
    protected $AuthGroupHasPermissionModel;
    protected $AuthPermissionCategoryModel;

    public function __construct()
    {
        $this->AuthGroupModel = new AuthGroupModel();
        $this->AuthPermissionModel = new AuthPermissionModel();
        $this->AuthGroupHasPermissionModel = new AuthGroupHasPermissionModel();
        $this->AuthPermissionCategoryModel = new AuthPermissionCategoryModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Group Management',
            'page_title' => 'Group List',
            'groups' => $this->AuthGroupModel->findAll()
        ];
        return view('group/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Group Management',
            'page_title' => 'Create Group',
        ];

        return view('group/create', $data);
    }

    public function store()
    {
        $name = $this->request->getPost('name');
        $title = $this->request->getPost('title');
        $description = $this->request->getPost('description');
        
        $new_data = [
            'name' => $name,
            'title' => $title,
            'description' => $description,
        ];

        if(!$this->AuthGroupModel->save($new_data)){
            return redirect()->back()->with('errors', $this->AuthGroupModel->errors());
        }
        
        return redirect()->to('group');
    }

    public function edit($group_id)
    {
        $data = [
            'title' => 'Group Management',
            'page_title' => 'Edit Group',
            'group' => $this->AuthGroupModel->find($group_id)
        ];
        return view('group/edit', $data);
    }

    public function update()
    {
        $group_id = $this->request->getPost('group_id');
        $name = $this->request->getPost('name');
        $title = $this->request->getPost('title');
        $description = $this->request->getPost('description');
        
        $edit_group = [
            'id' => $group_id,
            'name' => $name,
            'title' => $title,
            'description' => $description,
        ];

        if(!$this->AuthGroupModel->update($group_id, $edit_group)){
            return redirect()->back()->with('errors', $this->AuthGroupModel->errors());
        }
        
        return redirect()->route('group');
    }
    
    public function delete($group_id)
    {
        $this->AuthGroupModel->delete($group_id);
        return redirect()->to('group');
    }

    public function manage_permission($group_id)
    {
        $group = $this->AuthGroupModel->find($group_id);
        $permission_categories = $this->AuthPermissionCategoryModel->findAll();
        $permission_by_categories = [];
        foreach ($permission_categories as $key => $category) {
            $permissions = $this->AuthPermissionModel->where('permission_category_id',$category->id)->findAll();
            $permission_checked_counter = 0;
            foreach ($permissions as $key_permission => $permission) {
                $is_group_permission = $this->AuthGroupHasPermissionModel->isGroupHasPermission($group_id, $permission->id);
                $permission->is_group_has_permisssion = $is_group_permission;
                if($is_group_permission){ $permission_checked_counter++; }
            }

            $is_checked = (count($permissions) == $permission_checked_counter) ? true : false;
            $category_data = (object) [
                'category_name' => $category->name,
                'permissions' => $permissions,
                'is_checked' => $is_checked,
            ];
            $permission_by_categories[] = $category_data;
        }

        $data = [
            'title' => 'Manage Permissions',
            'group' => $group,
            'permission_by_categories' => $permission_by_categories,
        ];
        
        return view('group/manage-permission', $data);
    }

    public function manage_permission_update($group_id)
    {
        $selected_permission = $this->request->getPost('selected_permission');
        try {
            if($selected_permission) {
                $this->AuthGroupHasPermissionModel->transException(true)->transStart();
                $this->AuthGroupHasPermissionModel->where('group_id', $group_id)->delete();
                foreach ($selected_permission as $key => $permission_id) {
                    $this->AuthGroupHasPermissionModel->insert(['group_id' => $group_id, 'permission_id' => $permission_id]);
                }
                $this->AuthGroupHasPermissionModel->transComplete();
            }
            return redirect()->route('group');
        } catch (\Throwable $th) {
            return redirect()->back()->with('errors', $th->getMessage());
        }
    }
}
