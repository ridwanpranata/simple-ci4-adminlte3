<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AuthPermissionCategoryModel;


class PermissionCategoryController extends BaseController
{
    protected $AuthPermissionCategoryModel;

    public function __construct()
    {
        $this->AuthPermissionCategoryModel = new AuthPermissionCategoryModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Permission Category Management',
            'page_title' => 'Permission Category List',
            'permission_categories' => $this->AuthPermissionCategoryModel->findAll()
        ];

        return view('permission-category/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Permission Category Management',
            'page_title' => 'Create Permission Category',
        ];

        return view('permission-category/create', $data);
    }

    public function store()
    {
        $name = $this->request->getPost('name');
        $title = $this->request->getPost('title');
        $description = $this->request->getPost('description');
        $category = $this->request->getPost('category');
        
        $new_data = [
            'name' => $name,
            'title' => $title,
            'description' => $description,
        ];

        if(!$this->AuthPermissionCategoryModel->save($new_data)){
            return redirect()->back()->with('errors', $this->AuthPermissionCategoryModel->errors());
        }
        
        return redirect()->route('permission-category');
    }

    public function edit($permission_category_id)
    {
        $data = [
            'title' => 'Permission Category Management',
            'page_title' => 'Edit Permission Category',
            'permission_category' => $this->AuthPermissionCategoryModel->find($permission_category_id)
        ];
        return view('permission-category/edit', $data);
    }

    public function update()
    {
        $permission_category_id = $this->request->getPost('permission_category_id');
        $name = $this->request->getPost('name');
        $description = $this->request->getPost('description');
        
        $edit_permission = [
            'id' => $permission_category_id,
            'name' => $name,
            'description' => $description,
        ];

        if(!$this->AuthPermissionCategoryModel->update($permission_category_id, $edit_permission)){
            return redirect()->back()->with('errors', $this->AuthPermissionCategoryModel->errors());
        }
        
        return redirect()->route('permission-category');
    }
    
    public function delete($permission_category_id)
    {
        try {
            $this->AuthPermissionCategoryModel->transException(true)->transStart();
            $this->AuthPermissionCategoryModel->delete($permission_category_id);
            $this->AuthPermissionCategoryModel->transComplete();
            return redirect()->route('permission-category');
        } catch (\Throwable $th) {
            return redirect()->back()->with('errors', $th->getMessage());
        }
    }
}
