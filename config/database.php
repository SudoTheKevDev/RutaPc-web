<?php
// ============================================================
// RutaPc – Configuración de base de datos
// Archivo: config/database.php
//
// Función:
// - Definir las credenciales de conexión a MySQL.
// - Detectar automáticamente la ruta y URL del proyecto.
// - Crear y devolver una conexión PDO reutilizable.
// ============================================================


// ============================================================
// CONFIGURACIÓN DE LA BASE DE DATOS
//
// Datos necesarios para conectarse al servidor MySQL.
// ============================================================

// Servidor donde se encuentra MySQL.
define('DB_HOST',    'localhost');

// Nombre de la base de datos.
define('DB_NAME',    'rutapc_ej');

// Usuario de MySQL.
define('DB_USER',    'root');

// Contraseña de MySQL.
// Cambiar si el usuario tiene contraseña.
define('DB_PASS',    '');           

// Codificación utilizada por la base de datos.
define('DB_CHARSET', 'utf8mb4');

// ── Detecta automáticamente la carpeta raíz del proyecto ────
// Funciona sin importar cómo se llame la carpeta en htdocs
if (!defined('APP_ROOT')) {
    define('APP_ROOT', dirname(__DIR__));           // ruta absoluta en disco
}
if (!defined('APP_URL')) {
    // Detecta la URL base automáticamente: http://localhost/micarpeta
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    $host     = $_SERVER['HTTP_HOST'] ?? 'localhost';
    $folder   = basename(APP_ROOT);                // nombre real de la carpeta
    define('APP_URL', $protocol . '://' . $host . '/' . $folder);
}

/**
 * Devuelve una conexión PDO singleton.
 */
function getDB(): PDO
{
    //Declara pdo como static para mantener la misma conexión en cada llamada a la función
    static $pdo = null;

    // Compara que PDO exista y tenga un valor, por eso lleva 3 === y no 2 ==
    if ($pdo === null) {
        $dsn = sprintf(
            'mysql:host=%s;dbname=%s;charset=%s',
            DB_HOST, DB_NAME, DB_CHARSET
        );

        // ----------------------------------------------------
        // Opciones de configuración para PDO.
        // ----------------------------------------------------
        $options = [

            // Lanzar excepciones cuando ocurra un error.
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,

            // Devolver resultados como arreglos asociativos.
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,

            // Utilizar consultas preparadas reales de MySQL.
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

       try {

            // ------------------------------------------------
            // Crear conexión con MySQL.
            // ------------------------------------------------
            $pdo = new PDO(
                $dsn,
                DB_USER,
                DB_PASS,
                $options
            );

        } catch (PDOException $e) {

            // ------------------------------------------------
            // Registrar el error en el log del servidor.
            //
            // El usuario no verá detalles técnicos.
            // ------------------------------------------------
            error_log(
                'Error de conexión BD: ' .
                $e->getMessage()
            );

            // ------------------------------------------------
            // Mostrar mensaje genérico al usuario.
            //
            // Evita exponer información sensible
            // de la base de datos.
            // ------------------------------------------------
 
            die('<p style="color:red;font-family:sans-serif;padding:20px;">
                  Error al conectar con la base de datos. Contacta al administrador.
                 </p>');
        }
    }

    return $pdo;
}
