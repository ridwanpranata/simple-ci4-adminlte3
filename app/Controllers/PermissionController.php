<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AuthPermissionModel;


class PermissionController extends BaseController
{
    protected $AuthPermissionModel;

    public function __construct()
    {
        $this->AuthPermissionModel = new AuthPermissionModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Permission Management',
            'page_title' => 'Permission List',
            'permissions' => $this->AuthPermissionModel->findAll()
        ];
        
        return view('permission/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Permission Management',
            'page_title' => 'Create Permission',
        ];

        return view('permission/create', $data);
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
            'permission' => $this->AuthPermissionModel->find($permission_id)
        ];
        return view('permission/edit', $data);
    }

    public function update()
    {
        $permission_id = $this->request->getPost('permission_id');
        $name = $this->request->getPost('name');
        $title = $this->request->getPost('title');
        $description = $this->request->getPost('description');
        
        $edit_permission = [
            'id' => $permission_id,
            'name' => $name,
            'title' => $title,
            'description' => $description,
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
