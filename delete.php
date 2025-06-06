<?php
header('Content-Type: application/json');

$uploadDir = __DIR__ . '/pdfs/';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => '仅支持POST请求']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);
if (!$data || !isset($data['filename'])) {
    echo json_encode(['success' => false, 'message' => '参数错误']);
    exit;
}

$filename = basename($data['filename']);  // 防止路径穿越

$filepath = $uploadDir . $filename;

if (!file_exists($filepath)) {
    echo json_encode(['success' => false, 'message' => '文件不存在']);
    exit;
}

if (unlink($filepath)) {
    echo json_encode(['success' => true, 'message' => '删除成功']);
} else {
    echo json_encode(['success' => false, 'message' => '删除失败']);
}
