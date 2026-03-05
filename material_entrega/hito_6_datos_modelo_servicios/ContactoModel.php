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


class ContactoModel extends DBAbstractModel 
{

    private $id;
    private $nombre;
    private $telefono;
    private $email;
    private $created_at;  
    private $updated_at;

    public function setId($id) { $this->id = $id; }
    public function setNombre($nombre) { $this->nombre = $nombre; }
    public function setTelefono($telefono) { $this->telefono = $telefono; }
    public function setEmail($email) { $this->email = $email; }
   

    public function getId() { return $this->id; }
    public function getNombre() { return $this->nombre; }
    public function getTelefono() { return $this->telefono; }
    public function getEmail() { return $this->email; }
    public function getCreatedAt() { return $this->created_at; }
    public function getUpdatedAt() { return $this->updated_at; }

    /* MÉTODOS CRUD */

    /**
     * Obtener un contacto por ID y cargar el objeto.
     */
    public function get($id = '') 
    {
        try {
            $this->query = "SELECT * FROM contactos WHERE id = :id";
            $this->parametros['id'] = $id;
            $this->get_results_from_query();
            
            if (count($this->rows) === 1) {
                $row = $this->rows[0];
                // Sustituimos la magia por Setters explícitos para mayor claridad
                $this->setId($row['id']);
                $this->setNombre($row['nombre']);
                $this->setTelefono($row['telefono']);
                $this->setEmail($row['email']);
                $this->created_at = $row['created_at'] ?? null;
                $this->updated_at = $row['updated_at'] ?? null;
                
                $this->mensaje = 'Contacto encontrado';
                return $row;
            } 
            
            $this->mensaje = 'Contacto no encontrado';
            return null;
            
        } catch (\Exception $e) {
            // Usamos nuestra clase de excepción para registrar el fallo
            $error = new DatabaseException("Error en BD: " . $e->getMessage());
            $error->logError();
            //Pasamos el error al servicio que lo pasa el controlador para manejarlo correctamente
            throw $error;
        }
    }

    /**
     * Insertar un nuevo contacto.
     */
    public function set() 
    {
        try {
            $this->query = "INSERT INTO contactos (nombre, telefono, email) VALUES (:nombre, :telefono, :email)";
            $this->parametros = [
                'nombre' => $this->nombre,
                'telefono' => $this->telefono,
                'email' => $this->email
            ];
            
            $this->execute_single_query();
            $this->mensaje = 'Contacto insertado correctamente';
            return true;
            
        } catch (\Exception $e) {
            // Usamos nuestra clase de excepción para registrar el fallo
            $error = new DatabaseException("Error en BD: " . $e->getMessage());
            $error->logError();
            //Pasamos el error al servicio que lo pasa el controlador para manejarlo correctamente
            throw $error;
        }
    }
 
   
    public function edit() 
    {
    /*****************************************************
     * TAREA 3
     * 
     * Implementa el método
     * 
     * FIN TAREA
    */
    }

    
    public function delete($id = '') 
    {
    /*****************************************************
     * TAREA 3
     * 
     * Implementa el método
     * 
     * FIN TAREA
    */
    }

   
    public function getAll() 
    {
        try {
            $this->query = "SELECT * FROM contactos";
            $this->get_results_from_query();
            return $this->rows;
            
        } catch (\Exception $e) {
                 $error = new DatabaseException("Error en BD: " . $e->getMessage());
            $error->logError();
        
            throw $error;
        }
    }
    
    
    public function getByFilter($filter) 
    {
        try {
            $this->query = "SELECT * FROM contactos WHERE nombre";
            $this->parametros['nombre'] = "%$filter%";
            $this->get_results_from_query();
            return $this->rows;
            
        } catch (\Exception $e) {
            $error = new DatabaseException("Error en BD: " . $e->getMessage());
            $error->logError();
            throw $error;
        }
    }

 
    public function countAll() 
    {
        try {
            $this->query = "SELECT COUNT(*) as total FROM contacto";
            $this->parametros = []; 
            $this->get_results_from_query();
            return (int) ($this->rows[0]['total'] ?? 0);
            
        } catch (\Exception $e) {
            $error = new DatabaseException("Error en BD: " . $e->getMessage());
            $error->logError();
            throw $error;
        }
    }

    public function getLatest($limite) 
    {
        try {
            $this->query = "SELECT * FROM contactos ORDER BY id DESC LIMIT :limite";
            $this->parametros['limite'] = (int) $limite;
            $this->get_results_from_query();
            return $this->rows;
            
        } catch (\Exception $e) {
            $error = new DatabaseException("Error en BD: " . $e->getMessage());
            $error->logError();
            throw $error;
        }
    }
}