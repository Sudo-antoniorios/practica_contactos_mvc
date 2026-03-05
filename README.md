### [📚 Agenda de Contactos. MVC](https://github.com/fjagui/practica_contactos_mvc) {target=blank}
Esta práctica consiste en el desarrollo de una aplicación básica de gestión de contactos utilizando una arquitectura Modelo-Vista-Controlador (MVC) profesional en PHP. A lo largo de varios hitos, construiremos desde la infraestructura base hasta un sistema completo con validación, servicios y persistencia en base de datos.

Descarga el repositorio y copia los archivos necesarios para el desarrollo de cada hito.
La entrega y documentación se realizará a través del repositorio de GitHub.


### 🚩 Hito 0: Infraestructura y servidor.

### **Objetivo.**
Establecer la arquitectura física del proyecto y configurar el entorno de ejecución.

### Tareas.

1. **Creación de la estructura de directorios:** Presta atención al uso de las mayúscula sengún el [estándar PSR para *namespaces*](https://www.php-fig.org/psr/psr-4/){target=blank}:
```text
.
├── app
│   ├── config
│   ├── Controllers
│   ├── Core
│   ├── Forms
│   ├── helpers
│   ├── Middleware
│   ├── Models
│   └── Services
├── cache
├── logs
├── public
│   ├── assets
│   │   ├── css
│   │   ├── img
│   │   └── js
│   ├── test
│   └── uploads
│       └── contactos
├── tests
└── views
    ├── contactos
    │   └── partials
    ├── errors
    ├── helpers
    ├── includes
    ├── index
    └── layouts

```
2. **Configuración de un virtual host para el proyecto**.
      - Crea un archivo de configuración de un virtual host para la aplicación. 
3. **Implementación de .htaccess:**  
      - Copia el archivo entregado `.htaccess` dentro de la carpeta `/public`.
      - Completa los comentarios del archivo.
4. **Control de Versiones:**
      - Inicia el repositorio.
      - Crea el archivo .gitignore.
      - Realiza el primer commit: `Hito 0: Estructura de carpetas y configuración del servidor.`
      - Actualiza repositorio remoto.

### 🤔 Incluye en la documentación. 

* **Seguridad:** ¿Por qué configuramos el `DocumentRoot` en `/public` y no en la raíz del proyecto donde están las carpetas `app` o `config`?
* **Git:** ¿Por qué es una mala práctica subir la carpeta `vendor/` o el archivo `.env` al repositorio de GitHub?
* **Organización:** ¿Qué diferencia esperas encontrar entre los archivos guardados en `app/Controllers` y los guardados en `views/`?

### 🚩 Hito 1: Dependencias y variables de entorno.

### Objetivo.

Configurar el gestor de dependencias **Composer**, estableciendo el sistema de autocargado de clases bajo el estándar **PSR-4** y prepararando el entorno para manejar datos sensibles de forma segura, mediante variables de entorno y herramientas de depuración profesional.

### Tareas.

1. **Autocarga de clases**
      - Copia el archivo `composer.json` descargado en el directorio raiz del proyecto.
2. **Instalación de librerías.** Utiliza composer para instalar: 
      - [`vlucas/phpdotenv`](https://packagist.org/packages/vlucas/phpdotenv?query=whoops){target=blanck} para la gestión de las variables de entorno.
      - [`filp/whoops`](https://packagist.org/packages/filp/whoops){target=blank} para la gestión de errores. 
3. **Gestión de variables de entorno y seguridad:**
      - **Crear `.env`:** Crea este archivo en la raíz del proyecto con la definición de las variables de acceso a la base de datos(`DB_HOST`, `DB_NAME`, `DB_USER`, `DB_PASS`).
       - **Crear `.env.example`:** Crea una copia llamada `.env.example` pero **vacía de valores reales**. Este archivo servirá de plantilla para otros desarrolladores.
4. **Git**
      - Realiza el commit del hito.
      - Actualiza el repositorio remoto.
      - Verifica el repositorio remoto.
       
### 🤔 Incluye en la documentación.

* **Seguridad:** Hemos creado un `.env` y un `.env.example`. ¿Por qué es necesario que el `.env.example` **sí** esté en Git y el `.env` **no**?
* **Verificación:** Si al ejecutar `git status` ves el archivo `.env` en la lista de archivos para agregar, ¿qué significa y qué desastre podrías causar si haces `git push`?
* **Autoloading:** Gracias al PSR-4, ¿qué ventaja tenemos ahora a la hora de crear nuevas clases en `app/Controllers` respecto al uso tradicional de `require_once`?
* **Dependencias:** ¿Para qué sirve el archivo `composer.lock` que se ha generado automáticamente? ¿Debería estar incluido en nuestro `.gitignore`?

### 🚩 Hito 2: El arranque. Bootstrap y configuración.

### **Objetivo.**

Configurar la lógica de arranque y la configuración de los datos necesarios para el funcionamiento de la aplicación.

### **Tareas.**

1. **Configuración.** 
      - Copia en el directorio de configuración el archivo descargado. 
2. **El arranque**.
      - Copia en el proyecto el fichero bootstrap.php.
      - Realiza las tareas incluidas como comentarios en el archivo bootstrap.php.
      - Diseña una pequeña prueba para ver el funcionamiento de la librería de depuración. Cambia entre los modos de desarrollo para ver el resultado.
3. **Git**
      - Realiza el commit del hito.
      - Actualiza el repositorio remoto.
      - Verifica el repositorio remoto.
  
### 🤔 Incluye en la documentación.**

- **Separación de responsabilidades:** ¿Por qué crees que es mejor que las rutas como `VIEWS_DIR` estén en un archivo `config.php` en lugar de estar mezcladas con la lógica de inicialización del `bootstrap.php`?
- **Entorno de errores:** ¿Qué peligro tendría dejar la librería **Whoops** activada cuando el `APP_ENV` sea igual a `production`?
- **Automatización:** El bootstrap crea carpetas automáticamente. ¿Cómo ayuda esto a otro desarrollador que descargue tu proyecto por primera vez desde GitHub?
- **Variables Críticas:** En el bloque `try-catch` del `Dotenv`, se usa el método `required()`. ¿Qué ocurre si borras la variable `DBNAME` de tu archivo `.env` e intentas arrancar la app?

### 🚩 Hito 3: El Front Controller y el enrutamiento.

### Objetivo.

Implementar el **punto de entrada único** de la aplicación y definir el sistema de rutas. El Front Controller intercepta la URL, la compara con las rutas permitidas y delega la ejecución al controlador correspondiente mediante el componente `Dispatcher`.

### **Tareas.**

1. **Implementación del archivo:**
      - Copia el `front controller`  en su correspondiente directorio en el proyecto.
      - Revisa el código entragado y realiza las tareas comentadas en el fichero.
   
2. **Análisis de las Rutas:**
      - Observa el bloque de "Definición de Rutas".
      - Identifica qué métodos HTTP (`GET` o `POST`) se están utilizando y a qué método de qué controlador apunta la ruta `/contactos/crear`.

3. **Prueba de error (Whoops en acción):**
      - Intenta acceder a una ruta que **no esté definida** en el archivo.
      - Comprueba que el sistema falla controladamente. Gracias a que en el Hito 2 configuraste **Whoops**, deberías ver una traza detallada del error indicando que el Router no encontró la ruta o que el Dispatcher no pudo ejecutarla.

4. **Git**
      - Realiza el commit del hito.
      - Actualiza el repositorio remoto.
      - Verifica el repositorio remoto.

### 🚩 Hito 4: El Núcleo. Router y Dispatcher.

### Objetivo.

Implementar la lógica interna que permite reconocer una URL y ejecutar el código correspondiente. 

### Tareas.

1. **Lógica del Enrutador:**
      - Implementa el algoritmo de búsqueda dentro del método `match`. La tarea está comentada en el archivo.
2. **Lógica de Ejecución** .
      - Elabora un diagrama de flujo o secuencia que represente el camino de una petición a través de los distintos componentes software.
3. **Verificación con Whoops:**
      - Utiliza Whoops para depurar los errores de los ficheros del núcleo.
4. **Git**
      - Realiza el commit del hito.
      - Actualiza el repositorio remoto.
      - Verifica el repositorio remoto.

### 🤔 Incluir en la documentación.**

* **Responsabilidades:** ¿Por qué dividimos el trabajo en dos clases? ¿Qué pasaría si el `Router` también se encargara de instanciar los controladores?
* **Dinamicidad:** El `Dispatcher` usa variables para crear objetos (`new $controller()`). ¿Qué ventaja tiene esto frente a usar un `switch` gigante con todos los controladores del proyecto?
* **Limpieza de URL:** Si el usuario entra en `/contactos/crear?origen=web`, ¿por qué es vital que el Router ignore la parte de `?origen=web` para encontrar la ruta?


### 🚩 Hito 5: Controladores renderizado de vistas.

### Objetivo.

Implementar la lógica de control de la aplicación, gestionando las peticiones de usuario y utilizando los servicios de datos para devolver una respuesta visual procesando plantillas HTML.

### Tareas.

1. **Archivos**
      - Copiar al proyecto los archivos necesarios.
2. **El Motor de Vistas (`BaseController.php`):**
      - Completar las tareas incluidas en los comentarios de los archivos.
      - Estudia con detenimiento em método `renderHTML` para entender el proceso de renderizado y la necesidad de uso de los buffers de salida.
3. **Controladores de la aplicación**
      - Completa el controlador de inicio.
      - Completa el contralador responsable de los contactos.
4. **Git**
      - Realiza el commit del hito.
      - Actualiza el repositorio remoto.
      - Verifica el repositorio remoto.

### 🤔 Incluir en la documentación.

* **Herencia:** ¿Por qué es útil que todos los controladores hereden de `BaseController`? ¿Qué código nos estamos ahorrando repetir en `IndexController` y `ContactoController`?
* **Buffers de salida:** ¿Para qué sirve `ob_start()`? ¿Qué pasaría si hiciéramos un `include` de la vista directamente sin usar el buffer?
* **Seguridad en POST:** ¿Por qué en métodos como `storeAction` o `updateAction` comprobamos obligatoriamente que el método de la petición sea `POST`?
* **Limpieza de datos:** El controlador usa un método llamado `sanitizeForOutput`. ¿Por qué no debemos mostrar directamente en el HTML lo que el usuario escribió en un formulario?

### 🚩 Hito 6: Modelo de datos y servicios.

### Objetivo.

Implementar el acceso a datos mediante el patrón de **Modelos** y centralizar la lógica de negocio en **Servicios**. 

### Tareas.

1. **Abstracción de Base de Datos**
      - Revisa la implementación del patrón **Singleton** para asegurar que solo exista una conexión activa.
      - Actualiza el archivo con las tareas comentadas.
2. **Excepciones personalisadas.**
      - Revisa y completa la excepción personalizada para los errores de bases de datos.
    
3. **Modelo contactos.**
      - Completa las tareas comentadas en el archivo.
      - Corrige los errores detectados.
      - Fuerza la generación de errores para ver el funcionamiento del sistema de logs.

4. **Servicios.**
      - Completa las tareas comentadas en el archivo.
      - Corrige los errores detectados.
      - Fuerza la generación de errores para ver el funcionamiento del sistema de logs.
  
5. **Git**
      - Realiza el commit del hito.
      - Actualiza el repositorio remoto.
      - Verifica el repositorio remoto.


### 🤔 Incluir en la documentación.**

* **Seguridad (PDO):** ¿Por qué debemos usar `$stmt->prepare()` y pasar los parámetros en un array en lugar de concatenar las variables directamente en el string de la consulta?
* **Excepciones:** En `ContactoModel`, cuando ocurre un error, llamamos a `$error->logError()`. ¿Dónde podemos consulta ese log para saber qué ha fallado exactamente?
* **Mapeo:** ¿Qué ventaja tiene que el `ContactoService` limpie y formatee los datos antes de enviarlos al controlador?
* **Patrón Singleton:** ¿Qué pasaría con los recursos del servidor si cada vez que un modelo necesita una consulta creara una nueva conexión `new PDO()`?

### 🚩 Hito 7: Validación y sanitización de formularios.

### Objetivo.

Asegurar la integridad y seguridad de los datos que entran en la aplicación, implementando un sistema de validación que filtre los caracteres no deseados y verifique que los datos (nombre, email y teléfono) cumplen con los requisitos de negocio antes de ser procesados por el servicio.

### Tareas.

1. **Gestor de formularios.**
      - Revisa las clases que componen el gestor de formularios.
      - Completa las tareas comentadas en los archivos.
      - Corrige los errores detectados.

2. **Git**
      - Realiza el commit del hito.
      - Actualiza el repositorio remoto.
      - Verifica el repositorio remoto.

### 🤔 Incluir en la documentación.

* **Sanitización vs Validación:** ¿Cuál es la diferencia? ¿Por qué es necesario limpiar los datos (`Sanitizer`) antes de comprobar si son válidos (`Validator`)?
* **XSS (Cross-Site Scripting):** ¿Qué ocurriría si no usáramos `htmlspecialchars` al mostrar los datos que el usuario escribió mal en el formulario?
* **Experiencia de Usuario:** ¿Por qué es importante devolver los datos originales al formulario cuando hay un error (repoblar el formulario) en lugar de dejar los campos vacíos?
* **Responsabilidad:** ¿Por qué crees que es mejor tener la validación en clases separadas en lugar de escribir todos los `if` directamente dentro del Controlador?

### 🚩 Hito 8: Sistema de vistas, layouts y componentes.

### Objetivo.

Implementar la interfaz de usuario de la aplicación organizando las vistas de forma jerárquica, utilizando un **Layout Base** común y componentes reutilizables (partials) para mantener un diseño consistente y fácil de mantener.

### Tareas.

1. **Vistas:**
      - Utiliza los archivos descargados como base para el diseño de una interfaz personalizada. 
      - Añade algún helper de vista a modo de ejemplo.

2. **Git**
      - Realiza el commit del hito.
      - Actualiza el repositorio remoto.
      - Verifica el repositorio remoto.


### 🤔 Incluir en la documentación**

* **DRY (Don't Repeat Yourself):** ¿Qué ventaja tiene haber separado el `nav_view.php` del resto de las páginas si mañana decidimos cambiar el color de la barra de navegación?
* **Seguridad en la Vista:** En los archivos entregados se usa `htmlspecialchars()`. ¿Por qué es obligatorio usarlo al imprimir variables como el nombre o el email del contacto?
* **Inyección de contenido:** ¿Cómo sabe el archivo `base_view.php` qué contenido debe mostrar en la variable `$content`? (Relaciónalo con el Hito 5 y el Buffer de salida).
* **Interatividad:** Observa cómo se gestionan los mensajes de éxito (`success=created`). ¿Cómo ayudamos al usuario a saber que su acción ha funcionado sin que tenga que revisar la base de datos?
