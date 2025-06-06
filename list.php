<?php
$dir = __DIR__ . '/pdfs';
$files = array_filter(scandir($dir), function($file) use ($dir) {
    return pathinfo($file, PATHINFO_EXTENSION) === 'pdf';
});
echo json_encode(array_values($files));
?>
