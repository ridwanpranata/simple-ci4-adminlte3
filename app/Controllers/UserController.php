<?php

namespace App\Controllers;
use CodeIgniter\Shield\Validation\ValidationRules;
use CodeIgniter\Shield\Entities\User;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\AuthGroupModel;


class UserController extends BaseController
{
    protected $UserModel;
    protected $AuthGroupModel;

    public function __construct()
    {
        $this->UserModel = new UserModel();
        $this->AuthGroupModel = new AuthGroupModel();
    }

    public function index()
    {
        $users = $this->getUserProvider()->findAll();

        foreach ($users as $key => $user) {
            $user_groups = $user->getGroups();
            $user->user_groups = implode(' | ', $user_groups);
        }

        $data = [
            'title' => 'User Management',
            'page_title' => 'User List',
            'users' => $users,
        ];

        return view('user/index', $data);
    }

    public function create()
    {
        $groups = $this->AuthGroupModel->findAll();

        $data = [
            'title' => 'User Management',
            'page_title' => 'Create User',
            'groups' => $groups,
        ];

        return view('user/create', $data);
    }

    public function store()
    {
        $users = $this->getUserProvider();
        $rules = $this->getValidationRules();

        // ## menggunakan rules bawaan shield. namun pakai rule key yang diperlukan saja
        $filteredRules = array_filter(
            $rules,
            function ($key) {
                return in_array($key, ['username', 'email']);
            },
            ARRAY_FILTER_USE_KEY
        );

        if (! $this->validateData($this->request->getPost(), $filteredRules, [], config('Auth')->DBGroup)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $user_data = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password' => env('app.defaultUserPassword'),
        ];

        $created_user = $this->getUserEntity();
        $created_user->fill($user_data);

        try {
            $users->save($created_user);
            
            // To get the complete user object with ID, we need to get from the database
            $created_user = $users->findById($users->getInsertID());
    
            // Add group
            $group = $this->request->getPost('group');
            if($group) {
                $created_user->syncGroups($group);
            } else {
                $users->addToDefaultGroup($created_user);
            }

        } catch (ValidationException $e) {
            return redirect()->back()->withInput()->with('errors', $users->errors());
        }

        return redirect()->to('user');
    }

    public function edit($user_id)
    {
        $groups = $this->AuthGroupModel->findAll();

        $user = $this->getUserProvider()->find($user_id);
        $user->email = $user->getEmail();

        $user_groups = $user->getGroups();
        $user->user_groups = implode(' | ', $user_groups);
        
        $data = [
            'title' => 'User Management',
            'page_title' => 'Edit User',
            'user' => $user,
            'groups' => $groups
        ];
        return view('user/edit', $data);
    }

    public function update()
    {
        $users = $this->getUserProvider();

        $user_id = $this->request->getPost('user_id');
        $username = $this->request->getPost('username');
        $email = $this->request->getPost('email');

        $updated_user = $this->getUserProvider()->find($user_id);
        $updated_user_data = [
            'username' => $username,
            'email' => $email,
        ];

        $updated_user->fill($updated_user_data);

        try {
            $users->save($updated_user);

            // Add group
            $group = $this->request->getPost('group');
            if($group) {
                $updated_user->syncGroups($group);
            } else {
                $updated_user->syncGroups(config('AuthGroups')->defaultGroup);
            }

        } catch (ValidationException $e) {
            return redirect()->back()->withInput()->with('errors', $users->errors());
        }
        
        return redirect()->to('user');
    }
    
    public function delete($user_id)
    {
        $this->getUserProvider()->delete($user_id);
        return redirect()->to('user');
    }

    protected function getUserProvider(): UserModel
    {
        $provider = model(setting('Auth.userProvider'));

        assert($provider instanceof UserModel, 'Config Auth.userProvider is not a valid UserProvider.');

        return $provider;
    }

    protected function getValidationRules(): array
    {
        $rules = new ValidationRules();

        return $rules->getRegistrationRules();
    }

    protected function getUserEntity(): User
    {
        return new User();
    }
}
