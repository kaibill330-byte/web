<?php
header('Content-Type: application/json');

$wpConfigPath = '/home3/tccacin/public_html/wp-config.php';
$prefix = null;

if (file_exists($wpConfigPath)) {
    $content = file_get_contents($wpConfigPath);
    if (preg_match('/\$table_prefix\s*=\s*[\'"](.*?)[\'"]\s*;/i', $content, $matches)) {
        $prefix = $matches[1];
    }
}

echo json_encode(['table_prefix' => $prefix]);
