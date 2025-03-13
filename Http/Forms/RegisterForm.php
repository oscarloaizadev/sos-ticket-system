<?php

namespace Http\Forms;

use Core\ValidationException;
use Core\Validator;

class RegisterForm
{
    
    public array $attributes;
    
    protected $errors = [];
    
    /*
        Disponible solamente desde PHP >= 8.0
        public function __construct(public array $attributes)
    */
    public function __construct(array $attributes)
    {
        /*
          Necesario para PHP < 8.0
        */
        $this->attributes = $attributes;
        /*
        if (!Validator::email($attributes['email'])) {
            $this->errors['email'] = 'Please provide a valid email address.';
        }
        */
        
        if (!Validator::string($attributes['username'], 6, 255)) {
            $this->errors['username'] = 'El usuario de red debe ser mayor a 6 caracteres.';
        }
        
        if (!Validator::string($attributes['email'], 6, 255)) {
            $this->errors['email'] = 'El correo electrónico debe ser mayor a 6 caracteres.';
        }
        
        if (!Validator::string($attributes['password'], 7, 255)) {
            $this->errors['password'] = 'La contraseña debe tener al menos 7 caracteres.';
        }
        
        if (!Validator::validatePasswords($attributes['password'], $attributes['confirmPassword'])) {
            $this->errors['confirmPassword'] = 'Las contraseñas no coinciden.';
        }
        
        if (Validator::trutty($attributes['userInDb'])) {
            $this->errors['userInDb']
                = 'El usuario o correo electrónico ya están registrados.';
        }
    }
    
    public static function validate($attributes)
    {
        $instance = new static($attributes);
        
        return $instance->failed() ? $instance->throw() : $instance;
    }
    
    public function failed()
    {
        return count($this->errors);
    }
    
    public function throw()
    {
        ValidationException::throw($this->errors(), $this->attributes);
    }
    
    public function errors()
    {
        return $this->errors;
    }
    
    public function error($field, $message)
    {
        $this->errors[$field] = $message;
        
        return $this;
    }
    
}