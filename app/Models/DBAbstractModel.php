<?php

declare(strict_types=1);

namespace App\Models;

abstract class DBAbstractModel
{
    private static ?string $db_host = null;
    private static ?string $db_user = null;
    private static ?string $db_pass = null;
    private static ?string $db_name = null;
    private static int $db_port = 3306;
    private static ?\PDO $connection = null;

    protected string $mensaje = '';
    protected string $query = '';
    protected array $parametros = [];
    protected array $rows = [];
    protected int $affected_rows = 0;

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
            self::$db_port = (int) ($_ENV['DBPORT'] ?? 3306);
        }
    }

    protected function getConnection(): \PDO
    {
        if (self::$connection === null) {
            self::$connection = $this->openConnection();
        }

        return self::$connection;
    }

    private function openConnection(): \PDO
    {
        $dsn = sprintf(
            'mysql:host=%s;dbname=%s;port=%d;charset=utf8mb4',
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
            return new \PDO($dsn, self::$db_user, self::$db_pass, $options);
        } catch (\PDOException $e) {
            throw new DatabaseException('Error de conexion: ' . $e->getMessage(), (int) $e->getCode(), $e);
        }
    }

    public function getLastInsertId(): string
    {
        return $this->getConnection()->lastInsertId();
    }

    protected function execute_single_query(): bool
    {
        try {
            $stmt = $this->prepareAndBind($this->query, $this->parametros);
            $result = $stmt->execute();
            $this->affected_rows = $stmt->rowCount();
            return $result;
        } catch (\PDOException $e) {
            throw new DatabaseException('Error en consulta: ' . $e->getMessage(), (int) $e->getCode(), $e);
        }
    }

    protected function get_results_from_query(): array
    {
        try {
            $stmt = $this->prepareAndBind($this->query, $this->parametros);
            $stmt->execute();
            $this->rows = $stmt->fetchAll();
            $this->affected_rows = $stmt->rowCount();
            return $this->rows;
        } catch (\PDOException $e) {
            throw new DatabaseException('Error en consulta: ' . $e->getMessage(), (int) $e->getCode(), $e);
        }
    }

    protected function get_single_result(): ?array
    {
        $this->get_results_from_query();
        return $this->rows[0] ?? null;
    }

    private function prepareAndBind(string $query, array $params): \PDOStatement
    {
        $stmt = $this->getConnection()->prepare($query);

        foreach ($params as $key => $value) {
            $paramName = ':' . ltrim((string) $key, ':');
            $type = \PDO::PARAM_STR;

            if (is_int($value)) {
                $type = \PDO::PARAM_INT;
            } elseif (is_bool($value)) {
                $type = \PDO::PARAM_BOOL;
            } elseif ($value === null) {
                $type = \PDO::PARAM_NULL;
            }

            $stmt->bindValue($paramName, $value, $type);
        }

        return $stmt;
    }

    public function beginTransaction(): bool
    {
        return $this->getConnection()->beginTransaction();
    }

    public function commit(): bool
    {
        return $this->getConnection()->commit();
    }

    public function rollBack(): bool
    {
        return $this->getConnection()->rollBack();
    }

    public function getRows(): array
    {
        return $this->rows;
    }

    public function getAffectedRows(): int
    {
        return $this->affected_rows;
    }

    public function getMensaje(): string
    {
        return $this->mensaje;
    }

    protected function clearParameters(): void
    {
        $this->parametros = [];
        $this->query = '';
        $this->rows = [];
        $this->affected_rows = 0;
    }

    public static function closeConnection(): void
    {
        self::$connection = null;
    }
}
