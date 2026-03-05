
<div class="col-md-4 mb-4">
    <div class="card h-100 shadow-sm border-light">
        <div class="card-body d-flex flex-column">
            
            <div class="d-flex align-items-center mb-3 border-bottom pb-2">
                <?= view_contacto_avatar($contacto['nombre'], 45) ?>
                
                <h5 class="card-title text-primary mb-0 ml-3">
                    <?= htmlspecialchars($contacto['nombre']) ?>
                </h5>
            </div>
            
            <div class="card-text flex-grow-1 py-2">
                <p class="mb-2">
                    <i class="fas fa-phone text-secondary mr-2"></i> 
                    <strong class="small text-uppercase">Teléfono:</strong> <br>
                    <span class="text-dark ml-4"><?= htmlspecialchars($contacto['telefono']) ?></span>
                </p>
                <p class="mb-2">
                    <i class="fas fa-envelope text-secondary mr-2"></i> 
                    <strong class="small text-uppercase">Email:</strong> <br>
                    <span class="text-dark ml-4"><?= htmlspecialchars($contacto['email']) ?></span>
                </p>
            </div>
            
            <div class="mt-auto pt-3 border-top">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <a href="<?= BASE_URL ?>/contactos/ver/<?= $contacto['id'] ?>" class="btn btn-sm btn-outline-info" title="Ver detalle">
                            <i class="fas fa-eye"></i>
                        </a>
                        
                        <a href="<?= BASE_URL ?>/contactos/editar/<?= $contacto['id'] ?>" class="btn btn-sm btn-outline-warning" title="Editar">
                            <i class="fas fa-edit"></i>
                        </a>
                    </div>
                    
                    <form action="/contactos/eliminar/<?= $contacto['id'] ?>" 
                          method="POST" 
                          class="d-inline" 
                          onsubmit="return confirm('¿Está seguro de eliminar a <?= htmlspecialchars($contacto['nombre']) ?>?');">
                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Eliminar">
                            <i class="fas fa-trash"></i> Borrar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>