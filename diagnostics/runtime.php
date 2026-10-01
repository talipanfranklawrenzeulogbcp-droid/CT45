<?php
declare(strict_types=1);

/*
 * Safe deployment diagnostic.
 * Returns JSON and never exposes secrets.
 * Set DIAGNOSTICS_ENABLED=true in the environment to enable it.
 */
header('Content-Type: application/json; charset=utf-8');

$enabled = filter_var(getenv('DIAGNOSTICS_ENABLED') ?: 'false', FILTER_VALIDATE_BOOLEAN);
if (!$enabled) {
    http_response_code(404);
    echo json_encode(['ok' => false, 'error' => 'Not found']);
    exit;
}

$result = [
    'ok' => true,
    'php_version' => PHP_VERSION,
    'sapi' => PHP_SAPI,
    'server_time_utc' => gmdate('c'),
    'document_root_exists' => is_dir($_SERVER['DOCUMENT_ROOT'] ?? ''),
];

$db = [
    'configured' => false,
    'reachable' => false,
    'error' => null,
];

$required = ['DB_HOST', 'DB_PORT', 'DB_NAME', 'DB_USER'];
foreach ($required as $name) {
    if (trim((string)getenv($name)) !== '') {
        $db['configured'] = true;
    } else {
        $db['configured'] = false;
        $db['error'] = "Missing {$name}";
        break;
    }
}

if ($db['configured'] && class_exists('PDO')) {
    try {
        $host = (string)getenv('DB_HOST');
        $port = (string)(getenv('DB_PORT') ?: '3306');
        $name = (string)getenv('DB_NAME');
        $user = (string)getenv('DB_USER');
        $pass = (string)(getenv('DB_PASS') ?: '');
        $pdo = new PDO(
            "mysql:host={$host};port={$port};dbname={$name};charset=utf8mb4",
            $user,
            $pass,
            [PDO::ATTR_TIMEOUT => 3, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
        $pdo->query('SELECT 1');
        $db['reachable'] = true;
    } catch (Throwable $e) {
        $db['error'] = 'Database connection failed';
    }
}

$result['database'] = $db;
$result['ok'] = $db['configured'] && $db['reachable'];

http_response_code($result['ok'] ? 200 : 503);
echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
