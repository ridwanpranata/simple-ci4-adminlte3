<?php

namespace App\Controllers;
use CodeIgniter\Shield\Validation\ValidationRules;
use CodeIgniter\Shield\Entities\User;

use App\Controllers\BaseController;
use App\Models\UserModel;


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
        $user = $this->getUserProvider()->find($user_id);
        $user->email = $user->getEmail();
        
        $data = [
            'title' => 'User Management',
            'page_title' => 'Edit User',
            'user' => $user
        ];
        return view('user/edit', $data);
    }

    public function update()
    {
        $users = $this->getUserProvider();

        $user_id = $this->request->getPost('user_id');
        $username = $this->request->getPost('username');
        $email = $this->request->getPost('email');

        $user = $this->getUserProvider()->find($user_id);
        $updated_user_data = [
            'username' => $username,
            'email' => $email,
        ];

        $user->fill($updated_user_data);
        $users->save($user);

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
