<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AuthPermissionModel;
use App\Models\AuthPermissionCategoryModel;


class PermissionController extends BaseController
{
    protected $AuthPermissionModel;
    protected $AuthPermissionCategoryModel;

    public function __construct()
    {
        $this->AuthPermissionModel = new AuthPermissionModel();
        $this->AuthPermissionCategoryModel = new AuthPermissionCategoryModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Permission Management',
            'page_title' => 'Permission List',
            'permissions' => $this->AuthPermissionModel->getPermissions(),
        ];
        return view('permission/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Permission Management',
            'page_title' => 'Create Permission',
            'permission_categories' => $this->AuthPermissionCategoryModel->findAll(),
        ];
        return view('permission/create', $data);
    }

    public function store()
    {
        $name = $this->request->getPost('name');
        $title = $this->request->getPost('title');
        $description = $this->request->getPost('description');
        $permission_category = $this->request->getPost('permission_category');
        
        $new_data = [
            'name' => $name,
            'title' => $title,
            'description' => $description,
            'permission_category_id' => $permission_category,
        ];

        if(!$this->AuthPermissionModel->save($new_data)){
            return redirect()->back()->with('errors', $this->AuthPermissionModel->errors());
        }
        return redirect()->to('permission');
    }

    public function edit($permission_id)
    {
        $data = [
            'title' => 'Permission Management',
            'page_title' => 'Edit Permission',
            'permission' => $this->AuthPermissionModel->find($permission_id),
            'permission_categories' => $this->AuthPermissionCategoryModel->findAll(),
        ];
        return view('permission/edit', $data);
    }

    public function update()
    {
        $permission_id = $this->request->getPost('permission_id');
        $name = $this->request->getPost('name');
        $title = $this->request->getPost('title');
        $description = $this->request->getPost('description');
        $permission_category = $this->request->getPost('permission_category');
        
        $edit_permission = [
            'id' => $permission_id,
            'name' => $name,
            'title' => $title,
            'description' => $description,
            'permission_category_id' => $permission_category,
        ];

        if(!$this->AuthPermissionModel->update($permission_id, $edit_permission)){
            return redirect()->back()->with('errors', $this->AuthPermissionModel->errors());
        }
        
        return redirect()->route('permission');
    }
    
    public function delete($permission_id)
    {
        $this->AuthPermissionModel->delete($permission_id);
        return redirect()->to('permission');
    }
}
