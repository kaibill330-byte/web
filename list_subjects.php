<?php
header('Content-Type: application/json');
$wpConfigPath = '/home3/tccacin/public_html/wp-config.php';
$wpPass = null; $wpUser = null; $wpDbName = null;
if (file_exists($wpConfigPath)) {
    $content = file_get_contents($wpConfigPath);
    if (preg_match('/define\s*\(\s*[\'"]DB_PASSWORD[\'"]\s*,\s*[\'"](.*?)[\'"]\s*\)/i', $content, $matches)) $wpPass = $matches[1];
    if (preg_match('/define\s*\(\s*[\'"]DB_USER[\'"]\s*,\s*[\'"](.*?)[\'"]\s*\)/i', $content, $matches)) $wpUser = $matches[1];
    if (preg_match('/define\s*\(\s*[\'"]DB_NAME[\'"]\s*,\s*[\'"](.*?)[\'"]\s*\)/i', $content, $matches)) $wpDbName = $matches[1];
}
try {
    $dsn = "mysql:host=localhost;dbname=$wpDbName;port=3306;charset=utf8mb4";
    $pdo = new PDO($dsn, $wpUser, $wpPass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
    $stmt = $pdo->query("SELECT * FROM subjects");
    $subjects = $stmt->fetchAll();
    
    $stmt2 = $pdo->query("SELECT DISTINCT program FROM subjects");
    $programs = $stmt2->fetchAll(PDO::FETCH_COLUMN);
    
    echo json_encode(['subjects' => $subjects, 'distinct_programs' => $programs]);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
