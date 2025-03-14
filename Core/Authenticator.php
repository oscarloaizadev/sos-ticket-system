<?php

namespace Core;

use Core\Database;
use Core\Session;

class Authenticator
{
    
    public function authorize($condition, $status = 403)
    {
        if (!$condition) {
            abort($status);
        }
        
        return true;
    }
    
    public function attempt($identifier, $password)
    {
        $query = 'SELECT id, name, username, email, password, role, company_id, session_token
                  FROM users
                  WHERE email = :email OR username = :username';
        
        $user = App::resolve(Database::class)
            ->query($query, [
                'email'    => $identifier,
                'username' => $identifier,
            ])->find();
        
        if ($user && password_verify($password, $user['password'])) {
            $query = 'SELECT * FROM companies WHERE id = :company_id';
            $company = App::resolve(Database::class)
                ->query($query, ['company_id' => $user['company_id']])
                ->find();
            
            $this->login([
                             'id'           => $user['id'],
                             'name'         => $user['name'],
                             'username'     => $user['username'],
                             'email'        => $user['email'],
                             'role'         => $user['role'],
                             'company_id'   => $user['company_id'],
                             'company_name' => $company['name'],
                             'token'        => $user['session_token'],
                         ]);
            
            return true;
        }
        
        return false;
    }
    
    public function login($user)
    {
        $token = bin2hex(random_bytes(32));
        
        App::resolve(Database::class)->query(
            "UPDATE users SET session_token = :token WHERE id = :id",
            ['token' => $token, 'id' => $user['id']],
        );
        
        session_start();
        session_regenerate_id(true);
        
        $_SESSION['user'] = [
            'id'         => $user['id'],
            'name'       => $user['name'],
            'username'   => $user['username'],
            'email'      => $user['email'],
            'role'       => $user['role'],
            'company_id' => $user['company_id'],
            'company'    => $user['company_name'],
            'token'      => $token,
        ];
    }
    
    public function logout()
    {
        if (isset($_SESSION['user']['id'])) {
            App::resolve(Database::class)->query(
                "UPDATE users SET session_token = NULL WHERE id = :id",
                ['id' => $_SESSION['user']['id']],
            );
        }
        
        Session::destroy();
    }
    
}