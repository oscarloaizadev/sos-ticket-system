<?php

namespace Core;

use Exception;

/**
 * Implementa la lógica principal para la inyección de dependencias.
 */
class Container
{
    
    /**
     * @var array Un arreglo asociativo que almacena los resolvers de
     *     dependencias.
     */
    protected $bindings = [];
    
    /**
     * Registra una dependencia en el contenedor.
     *
     * @param  string  $key  El identificador de la dependencia.
     * @param  callable  $resolver  La función que crea la instancia de la
     *     dependencia.
     *
     * @return void
     */
    public function bind($key, $resolver)
    {
        $this->bindings[$key] = $resolver;
    }
    
    /**
     * Resuelve una dependencia desde el contenedor.
     *
     * @param  string  $key  El identificador de la dependencia.
     *
     * @return mixed La instancia de la dependencia resuelta.
     * @throws Exception Si la dependencia no está registrada.
     */
    public function resolve($key)
    {
        if (!array_key_exists($key, $this->bindings)) {
            throw new Exception("No se encontró una vinculación para {$key}");
        }
        
        $resolver = $this->bindings[$key];
        
        return call_user_func($resolver);
    }
    
}
