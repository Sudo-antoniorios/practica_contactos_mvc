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
 * Documenta cada una de los métodos de la clase. 
 * 
 * FIN TAREA
*/

/*****************************************************
 * TAREA 3
 * 
 * Inclye espacio de nombres y uso de las clases necesarias. 
 * 
 * FIN TAREA
*/

class IndexController extends BaseController
{
    private ContactoService $contactoService;

    public function __construct()
    {
        parent::__construct();
        $this->contactoService = new ContactoService();
    }

    public function indexAction(): void
    {
        try {
            /*****************************************************
             * TAREA 4
             * 
             * Obtenemos $totalContactos. 
             * 
             * FIN TAREA
            */
         
            $contactosRecientes = $this->contactoService->getUltimosContactos(RECENT_CONTACTS_LIMIT);
    
            $this->renderHTML(VIEWS_DIR . '/index/index_view.php', [
                'titulo'  => 'Inicio | Agenda Pro',
                'total'   => $totalContactos,
                'ultimos' => $contactosRecientes
            ]);
    
        } catch (DataBaseException $e) {
           
            $this->mostrarErrorDB($e->getMessage());

        } catch (\Exception $e) {

            $this->mostrarError("No se pudo cargar el panel de control: " . $e->getMessage(), 500);
        }
    }
}