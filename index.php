<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<?php
// Mostrar errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 1. leer qué controlador y acción nos piden por la URL
$controllerName = isset($_GET['controller']) ? $_GET['controller'] : 'pagina';
$action         = isset($_GET['action']) ? $_GET['action'] : 'home';


// 2. montar el nombre de la clase y el archivo
$controllerClass = ucfirst($controllerName) . 'Controller'; // 'producto' -> 'ProductoController'
$controllerFile  = __DIR__ . '/controller/' . $controllerClass . '.php';

// 3. comprobar que existe el archivo del controlador
if (!file_exists($controllerFile)) {
    die("Controlador '$controllerClass' no encontrado.");
}

require_once $controllerFile;

// 4. comprobar que existe la clase
if (!class_exists($controllerClass)) {
    die("Clase del controlador '$controllerClass' no encontrada.");
}

// 5. crear objeto controlador
$controller = new $controllerClass();

// 6. comprobar que la acción existe
if (!method_exists($controller, $action)) {
    die("Acción '$action' no encontrada en el controlador '$controllerClass'.");
}

// 7. ejecutar la acción
$controller->$action();
?>
