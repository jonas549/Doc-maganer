<?php
/**
 * Plugin Name: Document Manager
 * Description: Plugin personalizado para gestionar, categorizar, buscar y editar documentos como Excel, Word y PPT desde WordPress.
 * Version: 1.0.0
 * Author: PHP Engineer
 */

defined('ABSPATH') || exit;

// Definir constantes globales del plugin
define('DM_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('DM_PLUGIN_URL', plugin_dir_url(__FILE__));
define('DM_PLUGIN_VERSION', '1.0.0');

// Autoload de Composer (vendor)
if (file_exists(DM_PLUGIN_PATH . 'vendor/autoload.php')) {
    require_once DM_PLUGIN_PATH . 'vendor/autoload.php';
}

// Cargar módulos del plugin
require_once DM_PLUGIN_PATH . 'helpers/Logger.php';
require_once DM_PLUGIN_PATH . 'includes/AdminMenu.php';
require_once DM_PLUGIN_PATH . 'includes/FileUploader.php';
require_once DM_PLUGIN_PATH . 'includes/DocumentManager.php';
require_once DM_PLUGIN_PATH . 'includes/Shortcodes.php';
require_once DM_PLUGIN_PATH . 'includes/LuckysheetEditor.php';
require_once DM_PLUGIN_PATH . 'includes/AjaxHandlers.php';


// Hook que se ejecuta al activar el plugin
register_activation_hook(__FILE__, function () {
    $log_dir = DM_PLUGIN_PATH . 'logs';
    if (!file_exists($log_dir)) {
        mkdir($log_dir, 0755, true);
    }
});

// Hook que se ejecuta al desactivar el plugin
register_deactivation_hook(__FILE__, function () {
    // Limpieza futura si se requiere
});

// Hook que se ejecuta al desinstalar completamente el plugin
register_uninstall_hook(__FILE__, 'dm_uninstall_plugin');

function dm_uninstall_plugin() {
    // Aquí podrías borrar archivos, opciones en la base de datos, etc.
    $log_file = DM_PLUGIN_PATH . 'logs/error.log';
    if (file_exists($log_file)) {
        unlink($log_file);
    }

    $log_dir = DM_PLUGIN_PATH . 'logs';
    if (file_exists($log_dir)) {
        rmdir($log_dir); // solo si está vacía
    }
}
