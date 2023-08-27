<?php

namespace App\Helper;

// use App\Models\Mobile_users;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

    class UserService {
        public $first_name, $last_name, $user_name, $email, $password;

        public function __construct($first_name, $last_name, $user_name, $email, $password){
            $this->first_name = $first_name;
            $this->last_name = $last_name;
            $this->user_name = $user_name;
            $this->email = $email;
            $this->password = $password;
        }

        public function validateInput(){
            $validator = Validator::make([
                'first_name' => $this->first_name, 
                'last_name' => $this->last_name, 
                'user_name' => $this->user_name, 
                'email'=> $this->email, 
                'password' => $this-> password],
            [
                'first_name' => ['required'],
                'last_name' => ['required'],
                'user_name' => ['required'],
                'email' => ['required', 'email:rfc,dns', 'unique:users'],
                'password' => ['required', 'string', Password::min(8)]
            ]);

            if ($validator->fails()) {
                return [
                    'status' => false,
                    'message' =>  $validator -> messages()];
            }
            else{
                return ['status' => true];
            }
        }

        public function register($deviceName){
            $validate = $this->validateInput();

            if ($validate['status'] == false) {
                return $validate;
            } else {
                $user = Customer::create([
                    'first_name' => $this->first_name,
                    'last_name' => $this->last_name,
                    'user_name' => $this->user_name,
                    'email' => $this->email,
                    'password' => Hash::make($this->password),
                ]);
                $token = $user -> createToken($deviceName)->plainTextToken; 
                
                return [
                    'status' => true,
                    'token' => $token,
                    'user' => $user,
                ];
            }
            
        }
    }
?>