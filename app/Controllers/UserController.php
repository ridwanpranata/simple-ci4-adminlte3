<?php

namespace App\Controllers;
use CodeIgniter\Shield\Models\UserModel;
use CodeIgniter\Shield\Validation\ValidationRules;
use CodeIgniter\Shield\Entities\User;


use App\Controllers\BaseController;
// use App\Models\UserModel;


class UserController extends BaseController
{
    // protected $UserModel;

    public function __construct()
    {
        // $this->UserModel = new UserModel();
    }

    public function index()
    {
        $users = $this->getUserProvider()->findAll();
        $data = [
            'title' => 'User Management',
            'page_title' => 'User List',
            'users' => $users,
        ];

        return view('user/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'User Management',
            'page_title' => 'Create User',
        ];

        return view('user/create', $data);
    }

    public function store()
    {
        $users = $this->getUserProvider();
        $rules = $this->getValidationRules();

        // ## tidak semual rules bawaan shield yang di pakai
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

        $user = $this->getUserEntity();
        $user->fill($user_data);

        try {
            $users->save($user);
        } catch (ValidationException $e) {
            return redirect()->back()->withInput()->with('errors', $users->errors());
        }

        // To get the complete user object with ID, we need to get from the database
        $user = $users->findById($users->getInsertID());

        // Add to default group
        $users->addToDefaultGroup($user);

        return redirect()->to('user');
    }

    public function edit($user_id)
    {
        $data = [
            'title' => 'User Management',
            'page_title' => 'Edit User',
            'user' => $this->UserModel->find($user_id)
        ];
        return view('user/edit', $data);
    }

    public function update()
    {
        $user_id = $this->request->getPost('user_id');
        $name = $this->request->getPost('name');
        $description = $this->request->getPost('description');
        
        $edit_user = [
            'name' => $name,
            'description' => $description,
        ];

        $update_user = $this->UserModel->update($user_id, $edit_user);
        return redirect()->to('user');
    }
    
    public function delete($user_id)
    {
        $this->UserModel->delete($user_id);
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
