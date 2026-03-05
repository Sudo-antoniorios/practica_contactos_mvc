<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\DatabaseException;
use App\Services\ContactoService;

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
            $totalContactos = $this->contactoService->getTotalContactos();
            $contactosRecientes = $this->contactoService->getUltimosContactos(RECENT_CONTACTS_LIMIT);

            $this->renderHTML(VIEWS_DIR . '/index/index_view.php', [
                'titulo' => 'Inicio | Agenda Pro',
                'total' => $totalContactos,
                'ultimos' => $contactosRecientes,
            ]);
        } catch (DatabaseException $e) {
            $this->mostrarErrorDB($e->getMessage());
        } catch (\Exception $e) {
            $this->mostrarError('No se pudo cargar el panel de control: ' . $e->getMessage(), 500);
        }
    }
}
