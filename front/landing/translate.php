<?php
declare(strict_types=1);

// Inicia la sesión solo si no está ya iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

const LANG_DIR        = __DIR__ . '/lang';
const DEFAULT_LANG    = 'es';
const SUPPORTED_LANGS = ['es', 'en'];

/**
 * Cambia el idioma actual en la sesión, validando contra los soportados.
 */
function setLanguage(string $lang): void {
    $_SESSION['lang'] = in_array($lang, SUPPORTED_LANGS, true)
        ? $lang
        : DEFAULT_LANG;
}

/**
 * Devuelve el idioma actual (o el por defecto si no hay ninguno en sesión).
 */
function getLanguage(): string {
    return $_SESSION['lang'] ?? DEFAULT_LANG;
}

/**
 * Carga y cachea las traducciones de un idioma dado.
 */
function loadTranslations(string $lang): array {
    static $cache = [];

    // Si ya lo cargamos, lo devolvemos
    if (isset($cache[$lang])) {
        return $cache[$lang];
    }

    $file = sprintf('%s/%s.php', LANG_DIR, $lang);
    if (! file_exists($file)) {
        // Fallback al idioma por defecto
        $file = sprintf('%s/%s.php', LANG_DIR, DEFAULT_LANG);
    }

    // Incluimos el archivo y almacenamos el array resultante
    $cache[$lang] = include $file;
    return $cache[$lang];
}

/**
 * Recupera la cadena traducida para la clave dada.
 * Si no existe, devuelve la misma clave para facilitar debugging.
 */
function __(string $key): string {
    $lang    = getLanguage();
    $strings = loadTranslations($lang);
    return $strings[$key] ?? $key;
}
