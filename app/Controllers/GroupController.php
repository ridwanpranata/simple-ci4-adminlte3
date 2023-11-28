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
            dd($this->AuthGroupModel->errors());
            
            return redirect()->back()->with('errors', $this->AuthGroupModel->errors());
        }
        
        return redirect()->route('group');
    }
    
    public function delete($group_id)
    {
        $this->AuthGroupModel->delete($group_id);
        return redirect()->to('group');
    }
}
