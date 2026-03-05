<?php
/*****************************************************
 * TAREA 1
 * 
 * Incluye bloque de documentación del archivo. 
 * 
 * FIN TAREA
*/

/*****************************************************
 * TAREA 2
 * 
 * Documenta cada una de las propiedades y métodos de la clase. 
 * 
 * FIN TAREA
*/
namespace App\Models;


abstract class DBAbstractModel
{
    
    private static $db_host;
    private static $db_user;
    private static $db_pass;
    private static $db_name;
    private static $db_port;
    private static $connection = null;
    protected $mensaje = '';
    protected $query;
    protected $parametros = [];
    protected $rows = [];
    protected $affected_rows = 0;
    abstract protected function get($id = '');
    abstract protected function set();
    abstract protected function edit();
    abstract protected function delete($id = '');
    
    public function __construct()
    {
   
        if (self::$db_host === null) {
            self::$db_host = $_ENV['DBHOST'] ?? 'localhost';
            self::$db_user = $_ENV['DBUSER'] ?? 'root';
            self::$db_pass = $_ENV['DBPASS'] ?? '';
            self::$db_name = $_ENV['DBNAME'] ?? '';
        }
    }


    protected function getConnection()
    {
        if (self::$connection === null) {
            self::$connection = $this->open_connection();
        }
        return self::$connection;
    }


    private function open_connection()
    {
        $dsn = sprintf(
            'mysql:host=%s;dbname=%s;port=%s;charset=utf8mb4',
            self::$db_host,
            self::$db_name,
            self::$db_port
        );

        $options = [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES => false,
            
        ];

        try {
            $pdo = new \PDO($dsn, self::$db_user, self::$db_pass, $options);
            return $pdo;
        } catch (\PDOException $e) {
            throw new DatabaseException("Error de conexión: " . $e->getMessage());
        }
    }

    public function getLastInsertId()
    {
        return $this->getConnection()->lastInsertId();
    }


    protected function execute_single_query()
    {
       
        try {
            $conn = $this->getConnection();
            $stmt = $conn->prepare($this->query);
            
            $result = $stmt->execute($this->parametros);
            $this->affected_rows = $stmt->rowCount();
          
            return $result;
            
        } catch (\PDOException $e) {
            throw new DatabaseException("Error en consulta: " . $e->getMessage());
        }
    }

    protected function get_results_from_query()
    {
     
        try {
            $conn = $this->getConnection();
           
            $stmt = $conn->prepare($this->query);
            
            $stmt->execute($this->parametros);
            
            $this->rows = $stmt->fetchAll();
            
            
            $this->affected_rows = $stmt->rowCount();
            
            return $this->rows;
            
        } catch (\PDOException $e) {
            throw new DatabaseException("Error en consulta: " . $e->getMessage());
        }
    }


    protected function get_single_result()
    {
        $this->get_results_from_query();
        return $this->rows[0] ?? null;
    }


    public function beginTransaction()
    {
        return $this->getConnection()->beginTransaction();
    }


    public function commit()
    {
        return $this->getConnection()->commit();
    }


    public function rollBack()
    {
        return $this->getConnection()->rollBack();
    }

    public function getRows()
    { 
        return $this->rows; 
    }


    public function getAffectedRows()
    { 
        return $this->affected_rows; 
    }

    public function getMensaje()
    { 
        return $this->mensaje; 
    }

    protected function clearParameters()
    {
        $this->parametros = [];
        $this->query = '';
        $this->rows = [];
        $this->affected_rows = 0;
    }


    public static function closeConnection()
    {
        self::$connection = null;
    }
}
?>