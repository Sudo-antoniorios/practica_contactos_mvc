<?php

declare(strict_types=1);

namespace App\Models;

class ContactoModel extends DBAbstractModel
{
    private ?int $id = null;
    private string $nombre = '';
    private ?string $telefono = null;
    private ?string $email = null;
    private ?string $created_at = null;
    private ?string $updated_at = null;

    public function setId(?int $id): void { $this->id = $id; }
    public function setNombre(string $nombre): void { $this->nombre = $nombre; }
    public function setTelefono(?string $telefono): void { $this->telefono = $telefono; }
    public function setEmail(?string $email): void { $this->email = $email; }

    public function getId(): ?int { return $this->id; }
    public function getNombre(): string { return $this->nombre; }
    public function getTelefono(): ?string { return $this->telefono; }
    public function getEmail(): ?string { return $this->email; }
    public function getCreatedAt(): ?string { return $this->created_at; }
    public function getUpdatedAt(): ?string { return $this->updated_at; }

    public function get($id = ''): ?array
    {
        try {
            $this->query = 'SELECT * FROM contactos WHERE id = :id LIMIT 1';
            $this->parametros = ['id' => (int) $id];
            $row = $this->get_single_result();

            if (!$row) {
                $this->mensaje = 'Contacto no encontrado';
                return null;
            }

            $this->setId((int) $row['id']);
            $this->setNombre((string) $row['nombre']);
            $this->setTelefono($row['telefono'] ?? null);
            $this->setEmail($row['email'] ?? null);
            $this->created_at = $row['created_at'] ?? null;
            $this->updated_at = $row['updated_at'] ?? null;

            $this->mensaje = 'Contacto encontrado';
            return $row;
        } catch (DatabaseException $e) {
            $e->logError();
            throw $e;
        }
    }

    public function set(): bool
    {
        try {
            $this->query = 'INSERT INTO contactos (nombre, telefono, email) VALUES (:nombre, :telefono, :email)';
            $this->parametros = [
                'nombre' => $this->nombre,
                'telefono' => $this->telefono,
                'email' => $this->email,
            ];

            $this->execute_single_query();
            $this->mensaje = 'Contacto insertado correctamente';
            return true;
        } catch (DatabaseException $e) {
            $e->logError();
            throw $e;
        }
    }

    public function edit(): bool
    {
        try {
            $this->query = 'UPDATE contactos SET nombre = :nombre, telefono = :telefono, email = :email WHERE id = :id';
            $this->parametros = [
                'id' => $this->id,
                'nombre' => $this->nombre,
                'telefono' => $this->telefono,
                'email' => $this->email,
            ];

            $this->execute_single_query();
            $this->mensaje = 'Contacto actualizado correctamente';
            return true;
        } catch (DatabaseException $e) {
            $e->logError();
            throw $e;
        }
    }

    public function delete($id = ''): bool
    {
        try {
            $this->query = 'DELETE FROM contactos WHERE id = :id';
            $this->parametros = ['id' => (int) $id];
            $this->execute_single_query();
            $this->mensaje = 'Contacto eliminado correctamente';
            return true;
        } catch (DatabaseException $e) {
            $e->logError();
            throw $e;
        }
    }

    public function getAll(): array
    {
        try {
            $this->query = 'SELECT * FROM contactos ORDER BY id DESC';
            $this->parametros = [];
            return $this->get_results_from_query();
        } catch (DatabaseException $e) {
            $e->logError();
            throw $e;
        }
    }

    public function getByFilter(string $filter): array
    {
        try {
            $this->query = 'SELECT * FROM contactos WHERE nombre LIKE :nombre OR email LIKE :email ORDER BY id DESC';
            $like = '%' . $filter . '%';
            $this->parametros = ['nombre' => $like, 'email' => $like];
            return $this->get_results_from_query();
        } catch (DatabaseException $e) {
            $e->logError();
            throw $e;
        }
    }

    public function countAll(): int
    {
        try {
            $this->query = 'SELECT COUNT(*) AS total FROM contactos';
            $this->parametros = [];
            $row = $this->get_single_result();
            return (int) ($row['total'] ?? 0);
        } catch (DatabaseException $e) {
            $e->logError();
            throw $e;
        }
    }

    public function getLatest(int $limite): array
    {
        try {
            $this->query = 'SELECT * FROM contactos ORDER BY id DESC LIMIT :limite';
            $this->parametros = ['limite' => max(1, $limite)];
            return $this->get_results_from_query();
        } catch (DatabaseException $e) {
            $e->logError();
            throw $e;
        }
    }
}
