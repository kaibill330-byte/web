<?php
header('Content-Type: application/json');
require_once __DIR__ . '/db.php';

try {
    $code = '656515';
    
    // Get session
    $stmt = $pdo->prepare("SELECT * FROM attendance_sessions WHERE code = ? ORDER BY created_at DESC LIMIT 1");
    $stmt->execute([$code]);
    $session = $stmt->fetch(PDO::FETCH_ASSOC);
    
    $records = [];
    if ($session) {
        // Get records
        $stmt = $pdo->prepare("SELECT * FROM attendance_records WHERE session_id = ?");
        $stmt->execute([$session['id']]);
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    echo json_encode([
        'success' => true,
        'session' => $session,
        'records' => $records
    ], JSON_PRETTY_PRINT);
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ], JSON_PRETTY_PRINT);
}
