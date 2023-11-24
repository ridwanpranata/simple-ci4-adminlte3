<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AuthGroupModel;


class GroupController extends BaseController
{
    protected $AuthGroupModel;

    public function __construct()
    {
        $this->AuthGroupModel = new AuthGroupModel();
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
        $description = $this->request->getPost('description');
        
        $new_group = [
            'name' => $name,
            'description' => $description,
        ];

        $insert_group = $this->AuthGroupModel->insert($new_group);
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
        $description = $this->request->getPost('description');
        
        $edit_group = [
            'name' => $name,
            'description' => $description,
        ];

        $update_group = $this->AuthGroupModel->update($group_id, $edit_group);
        return redirect()->to('group');
    }
    
    public function delete($group_id)
    {
        $this->AuthGroupModel->delete($group_id);
        return redirect()->to('group');
    }
}
