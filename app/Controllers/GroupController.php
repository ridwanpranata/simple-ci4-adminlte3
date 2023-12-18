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
        $permission_categories = $this->AuthPermissionCategoryModel->findAll();
        $permission_by_categories = [];
        foreach ($permission_categories as $key => $category) {
            $permissions = $this->AuthPermissionModel->where('permission_category_id',$category->id)->findAll();
            foreach ($permissions as $key_permission => $permission) {
                $is_group_permission = $this->AuthGroupHasPermissionModel->isGroupHasPermission($group_id, $permission->id);
                $permission->is_group_has_permisssion = $is_group_permission;
                
            }
            $permission_by_categories[$category->name] = $permissions;
        }

        $data = [
            'title' => 'Manage Permissions',
            'permission_by_categories' => $permission_by_categories,
        ];
        // dd($data);
        
        return view('group/manage-permission', $data);
    }
}
