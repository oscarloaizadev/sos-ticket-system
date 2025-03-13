<?php

namespace Core;

use Symfony\Component\Yaml\Yaml;

class Helper
{
    
    private static $config = [];
    
    public static function getClass($type, $key)
    {
        $config = self::loadConfig('classes');
        
        return $config[$type][$key] ?? 'bg-default';
    }
    
    private static function loadConfig($file)
    {
        if (!isset(self::$config[$file])) {
            $path = BASE_PATH . 'config/yaml/' . $file . '.yaml';
            if (!file_exists($path)) {
                throw new \RuntimeException("Archivo de configuración no encontrado: {$path}");
            }
            self::$config[$file] = Yaml::parseFile($path);
        }
        
        return self::$config[$file];
    }
    
    public static function getText($type, $key)
    {
        $config = self::loadConfig('translations');
        
        return $config[$type][$key] ?? 'Desconocido';
    }
    
    public static function getArray($file, $type)
    {
        $config = self::loadConfig($file)[$type];
        
        return $config ?? 'Desconocido';
    }
    
    public static function getIcon($type, $key)
    {
        $config = self::loadConfig('icons');
        
        return $config[$type][$key] ?? 'help';
    }
    
}