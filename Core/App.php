<?php

namespace Core;

/**
 * Clase App
 * Actúa como un punto de acceso global para el contenedor de dependencias.
 */
class App
{
    
    /**
     * @var Container Instancia del contenedor de dependencias.
     */
    protected static $container;
    
    /**
     * Configura la instancia del contenedor de dependencias.
     *
     * @param  Container  $container  La instancia del contenedor.
     *
     * @return void
     */
    public static function setContainer($container)
    {
        static::$container = $container;
    }
    
    /**
     * Registra una dependencia en el contenedor.
     *
     * @param  string  $key  El identificador de la dependencia.
     * @param  callable  $resolver  La función que crea la instancia de la
     *     dependencia.
     *
     * @return void
     */
    public static function bind($key, $resolver)
    {
        static::container()->bind($key, $resolver);
    }
    
    /**
     * Obtiene la instancia del contenedor de dependencias.
     *
     * @return Container La instancia del contenedor.
     */
    public static function container()
    {
        return static::$container;
    }
    
    /**
     * Resuelve una dependencia desde el contenedor.
     *
     * @template T
     * @param  class-string<T>  $key  El identificador de la dependencia.
     *
     * @return T La instancia de la dependencia resuelta.
     * @throws \Exception
     */
    public static function resolve($key)
    {
        return static::container()->resolve($key);
    }
    
}
