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

class ContactoService
{
    private ContactoModel $contactoModel;
   
    public function __construct()
    {
        $this->contactoModel = new ContactoModel();
    }


    public function obtenerListado(array $filtros = []): array
    {
        try {
            $q = isset($filtros['q']) && trim($filtros['q']) !== '' ? trim($filtros['q']) : null;
            
            $contactos = ($q !== null) 
                ? $this->contactoModel->getByFilter($q) 
                : $this->contactoModel->getAll();

            return array_map(function (array $row) {
                return $this->mapearContacto($row);
            }, $contactos);

        } catch (DatabaseException $e) { 
            error_log("Error en Service::obtenerListado: " . $e->getMessage());
            throw $e; 
        }
    }


    public function obtenerContacto(int $id): ?array
    {
        try {
            $row = $this->contactoModel->get($id);
            if ($row === null) {
                return null;
            }
            
            return [
                'contacto' => $this->mapearContacto($row)
            ];
            
        } catch (DatabaseException $e) {
            error_log('Error en Service::obtenerContacto: ' . $e->getMessage());
            throw $e;
        }
    }


    public function crearContacto(array $datos): int
    {
        try {
            $this->contactoModel->setNombre($datos['nombre'] ?? '');
            $this->contactoModel->setTelefono($datos['telefono'] ?? null);
            $this->contactoModel->setEmail($datos['email'] ?? null);
            
            $resultado = $this->contactoModel->set();
            
            if (!$resultado) {
                throw new \Exception('El modelo no pudo guardar el contacto.');
            }

            return (int)$this->contactoModel->getLastInsertId();

        } catch (DatabaseException $e) {
            error_log("Error en Service::crearContacto: " . $e->getMessage());
            throw $e;
        }
    }


    public function actualizarContacto(int $id, array $datos): bool
    {
    /*****************************************************
    * TAREA 3
    * 
    * Implementa el método. 
    * 
    * FIN TAREA
    */
    }

    public function eliminarContacto(int $id): bool 
    {
        try {
            return $this->contactoModel->delete($id);
        } catch (DatabaseException $e) {
            error_log("Error en Service::eliminarContacto: " . $e->getMessage());
            throw $e;
        }
    }

    public function getTotalContactos(): int 
    {
        try {
            return $this->contactoModel->All();
        } catch (DatabaseException $e) {
            error_log("Error en Service::getTotalContactos: " . $e->getMessage());
            throw $e;
        }
    }

   
    public function getUltimosContactos(int $limite = 3): array 
    {
        try {
            $rows = $this->contactoModel->getLatest($limite);
            return array_map(function (array $row) {
                return $this->mapearContacto($row);
            }, $rows);
        } catch (DatabaseException $e) {
            error_log("Error en Service::getUltimosContactos: " . $e->getMessage());
            throw $e;
        }
    }

    private function mapearContacto(array $row): array
    {
        return [
            'id'             => isset($row['id']) ? (int)$row['id'] : null,
            'nombre'         => $row['nombre'] ?? 'Sin nombre',
            'telefono'       => $row['telefono'] ?? 'No disponible',
            'email'          => $row['email'] ?? 'No disponible',
            'created_at'     => isset($row['created_at']) ? date('d/m/Y H:i', strtotime($row['created_at'])) : 'No disponible',
            'created_at_raw' => $row['created_at'] ?? null,
            'updated_at'     => isset($row['updated_at']) ? date('d/m/Y H:i', strtotime($row['updated_at'])) : 'Sin cambios'
        ];
    }
}