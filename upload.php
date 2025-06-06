<?php
header('Content-Type: application/json');

$uploadDir = __DIR__ . '/pdfs/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_FILES['pdffile'])) {
        echo json_encode(['success' => false, 'message' => '没有上传文件']);
        exit;
    }

    $file = $_FILES['pdffile'];
    if ($file['error'] !== UPLOAD_ERR_OK) {
        echo json_encode(['success' => false, 'message' => '上传错误']);
        exit;
    }

    // 检查文件类型
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mimeType = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);

    if ($mimeType !== 'application/pdf') {
        echo json_encode(['success' => false, 'message' => '只允许上传 PDF 文件']);
        exit;
    }

// 直接用上传的原始文件名，但要过滤危险字符
$originalName = basename($_FILES['pdffile']['name']);

// 过滤文件名中的非法字符，比如只保留中文、字母、数字、下划线、点、减号
$originalName = preg_replace('/[^\w\.\-\x{4e00}-\x{9fa5}]/u', '_', $originalName);

$dest = $uploadDir . $originalName;

    if (move_uploaded_file($file['tmp_name'], $dest)) {
        echo json_encode(['success' => true, 'message' => '上传成功']);
    } else {
        echo json_encode(['success' => false, 'message' => '保存文件失败']);
    }
    exit;
}

echo json_encode(['success' => false, 'message' => '非法请求']);
