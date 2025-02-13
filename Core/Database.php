<?php

namespace Core;

use PDO;

class Database
{
    
    public $connection;
    
    public $statement;
    
    /**
     * Constructor de la clase Database.
     *
     * Establece una conexión a la base de datos utilizando los parámetros
     * proporcionados en el arreglo de configuración.
     *
     * @param  array  $config  Arreglo asociativo que contiene las claves:
     *                      'host', 'dbname', 'charset', 'username', 'password'.
     *
     * @throws \PDOException Si ocurre un error al intentar establecer la conexión.
     */
    public function __construct($config)
    {
        //$dsn = "mysql:host=" . $config['host'] . ";dbname=" . $config['dbname'] . ";charset=" . $config['charset'];
        $dsn = 'mysql:' . http_build_query($config, '', ';');
        
        try {
            $this->connection = new PDO(
                $dsn,
                $config['username'],
                $config['password'],
                [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC],
            );
        } catch (\PDOException $e) {
            abort(500, $e->getMessage());
        }
    }
    
    /**
     * Ejecuta una consulta SQL preparada con parámetros opcionales, asegurando protección contra inyecciones SQL.
     *
     * Esta función prepara la consulta SQL proporcionada, enlaza los parámetros dados a la consulta
     * y la ejecuta de manera segura. El uso de sentencias preparadas evita ataques de inyección SQL
     * al asegurarse de que los parámetros se procesen como datos y no como parte del código SQL.
     *
     * Ejemplo de una consulta segura:
     * ```php
     * $db->query("SELECT * FROM usuarios WHERE id = :id", ['id' => 1]);
     * ```
     *
     * Ejemplo de una consulta maliciosa (no segura):
     * ```php
     * $db->query("SELECT * FROM usuarios WHERE id = {$id}");
     * ```
     *
     * @param  string  $query  La cadena de consulta SQL a ejecutar. Utiliza marcadores con nombre para enlazar
     *     parámetros (e.g., `:param`).
     * @param  array  $params  Opcional. Un arreglo asociativo con los parámetros a enlazar en la consulta (e.g.,
     *     `[':param' => 'valor']`).
     *
     * @return self Retorna la instancia actual para permitir el encadenamiento de métodos.
     */
    
    public function query($query, $params = [])
    {
        $this->statement = $this->connection->prepare($query);
        $this->statement->execute($params);
        
        return $this;
    }
    
    /**
     * Obtiene todos los resultados de la última consulta SQL ejecutada.
     *
     * Esta función utiliza el méto do `fetchAll()` para recuperar todos los registros
     * resultantes de la consulta SQL previamente preparada y ejecutada.
     * Los resultados se devuelven como un arreglo asociativo, según la configuración
     * predeterminada de `PDO::FETCH_ASSOC` establecida en el constructor.
     *
     * Ejemplo de uso:
     * ```php
     * $usuarios = $db->query("SELECT * FROM usuarios WHERE activo = 1")->get();
     * ```
     *
     * @return array Retorna un arreglo asociativo con todos los registros obtenidos de la consulta.
     *               Si no hay resultados, devuelve un arreglo vacío.
     */
    
    public function get()
    {
        return $this->statement->fetchAll();
    }
    
    /**
     * Obtiene un único registro de la última consulta SQL ejecutada o aborta si no se encuentra.
     *
     * Esta función utiliza `find()` para intentar recuperar el primer registro de la consulta.
     * Si no se encuentra ningún registro, se llama a la función `abort()` para detener la ejecución.
     * El resultado se devuelve como un arreglo asociativo.
     *
     * Ejemplo de uso:
     * ```php
     * $usuario = $db->query("SELECT * FROM usuarios WHERE id = :id", ['id' => 1])->findOrFail();
     * ```
     *
     * @return array Retorna un arreglo asociativo con el registro obtenido.
     * @throws \Exception Lanza una excepción o detiene la ejecución si no se encuentra ningún resultado.
     */
    public function findOrFail()
    {
        $result = $this->find();
        
        if (!$result) {
            abort();
        }
        
        return $result;
    }
    
    /**
     * Obtiene un único registro de la última consulta SQL ejecutada.
     *
     * Esta función utiliza el método `fetch()` para recuperar el primer registro
     * de la consulta SQL previamente preparada y ejecutada. El resultado se devuelve
     * como un arreglo asociativo, según la configuración predeterminada de `PDO::FETCH_ASSOC`.
     *
     * Ejemplo de uso:
     * ```php
     * $usuario = $db->query("SELECT * FROM usuarios WHERE id = :id", ['id' => 1])->find();
     * ```
     *
     * @return array|null Retorna un arreglo asociativo con el registro obtenido o `null`
     *                    si no se encontró ningún resultado.
     */
    
    public function find()
    {
        return $this->statement->fetch();
    }
    
    public function findOrTrowError()
    {
        $result = $this->find();
        
        return $result;
    }
    
}
