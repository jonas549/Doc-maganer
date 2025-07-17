<?php
/**
 * Este archivo se ejecuta automáticamente cuando el plugin es desinstalado desde el panel de WordPress.
 * Su propósito es limpiar datos persistentes creados por el plugin.
 */

defined('WP_UNINSTALL_PLUGIN') || exit;

// Ruta a la carpeta del plugin
$plugin_dir = plugin_dir_path(__FILE__);

// 1. Eliminar archivos de logs (si existen)
$log_file = $plugin_dir . 'logs/error.log';
if (file_exists($log_file)) {
    unlink($log_file);
}

// 2. Eliminar carpeta de logs
$log_dir = $plugin_dir . 'logs';
if (file_exists($log_dir)) {
    rmdir($log_dir); // Solo funciona si está vacía
}

// 3. Eliminar opciones en la base de datos (si las hubieras creado en el futuro)
// delete_option('dm_plugin_settings');
// delete_option('dm_version');

// 4. Eliminar roles o capacidades creados (si aplicara)

// 5. Eliminar custom post types o taxonomías registradas (si se guardan datos)
