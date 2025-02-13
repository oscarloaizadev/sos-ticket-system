<?php

namespace Core;

class Session
{
    
    public function __construct()
    {
        $this->isValid();
    }
    
    public static function isValid()
    {
        if (self::get('user', 'token') === null) {
            self::destroy();
        } else {
            $dbToken = App::resolve(Database::class)->query(
                "SELECT session_token FROM users
                   WHERE id = :id AND
                   username = :username AND
                   email = :email AND
                   role = :role AND
                   company_id = :company_id",
                [
                    'id'         => $_SESSION['user']['id'],
                    'username'   => $_SESSION['user']['username'],
                    'email'      => $_SESSION['user']['email'],
                    'role'       => $_SESSION['user']['role'],
                    'company_id' => $_SESSION['user']['company_id'],
                ],
            )->findOrTrowError();
            
            return hash_equals($dbToken['session_token'], $_SESSION['user']['token']);
        }
        
        return true;
    }
    
    public static function get($key, $value = '_flash', $default = null)
    {
        return $_SESSION[$value][$key] ?? $_SESSION[$key] ?? $default;
    }
    
    public static function destroy()
    {
        static::flush();
        
        session_unset();
        session_destroy();
        
        $params = session_get_cookie_params();
        setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain'], $params['secure'],
                  $params['httponly']);
    }
    
    public static function flush()
    {
        $_SESSION = [];
    }
    
    public static function has($key)
    {
        return (bool) static::get($key);
    }
    
    public static function getUser()
    {
        return $_SESSION['user'] ?? null;
    }
    
    public static function isUserAdmin()
    {
        return static::getUserRole() === 'admin';
    }
    
    public static function getUserRole()
    {
        return $_SESSION['user']['role'] ?? null;
    }
    
    public static function put($key, $value)
    {
        $_SESSION[$key] = $value;
    }
    
    public static function flash($key, $value)
    {
        $_SESSION['_flash'][$key] = $value;
    }
    
    public static function unflash()
    {
        unset($_SESSION['_flash']);
    }
    
}