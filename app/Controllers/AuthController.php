<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

use CodeIgniter\Shield\Models\UserModel;
use CodeIgniter\Shield\Entities\User;

class AuthController extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        //
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        //
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        //
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        //
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        //
    }

    // Post
    public function register()
    {
        $rules = [
            "username" => "required|is_unique[users.username]",
            "email" => "required|valid_email|is_unique[auth_identities.secret]",
            "password" => "required"
        ];

        if (!$this->validate($rules)) {

            $response = [
                "status" => false,
                "message" => $this->validator->getErrors(),
                "data" => []
            ];
        } else {

            // User Model
            $userObject = new UserModel();

            // User Entity
            $userEntityObject = new User([
                "username" => $this->request->getVar("username"),
                "email" => $this->request->getVar("email"),
                "password" => $this->request->getVar("password")
            ]);

            $userObject->save($userEntityObject);

            $response = [
                "status" => true,
                "message" => "User saved successfully",
                "data" => []
            ];
        }

        return $this->respondCreated($response);
    }

    // Post
    public function login()
    {

        if(auth()->loggedIn()){
            auth()->logout();
        }

        $rules = [
            "email" => "required|valid_email",
            "password" => "required"
        ];

        if (!$this->validate($rules)) {

            $response = [
                "status" => false,
                "message" => $this->validator->getErrors(),
                "data" => []
            ];
        } else {

            // success
            $credentials = [
                "email" => $this->request->getVar("email"),
                "password" => $this->request->getVar("password")
            ];

            $loginAttempt = auth()->attempt($credentials);

            if (!$loginAttempt->isOK()) {

                $response = [
                    "status" => false,
                    "message" => "Invalid login details",
                    "data" => []
                ];
            } else {

                // We have a valid data set
                $userObject = new UserModel();

                $userData = $userObject->findById(auth()->id());

                $token = $userData->generateAccessToken("thisismysecretkey");

                $auth_token = $token->raw_token;

                $response = [
                    "status" => true,
                    "message" => "User logged in successfully",
                    "data" => [
                        "token" => $auth_token
                    ]
                ];
            }
        }

        return $this->respondCreated($response);
    }

    // Get
    public function profile()
    {
        $userId = auth()->id();

        $userObject = new UserModel();

        $userData = $userObject->findById($userId);

        return $this->respondCreated([
            "status" => true,
            "message" => "Profile information of logged in user",
            "data" => [
                "user" => $userData,
            ]
        ]);
    }

    // Get
    public function logout()
    {
        auth()->logout();

        auth()->user()->revokeAllAccessTokens();

        return $this->respondCreated([
            "status" => true,
            "message" => "User logged out successfully",
            "data" => []
        ]);
    }

    public function accessDenied()
    {
        return $this->respondCreated([
            "status" => false,
            "message" => "Invalid access",
            "data" => []
        ]);
    }
}
