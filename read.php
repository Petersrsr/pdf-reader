<?php
// read.php?file=xxx.pdf

$limit = 10; // 每个 IP 每分钟最大请求次数
$window = 60; // 时间窗口（秒）

$ip = $_SERVER['REMOTE_ADDR'];
$file = basename($_GET['file']);
$filepath = __DIR__ . "/pdfs/" . $file;

$log_file = __DIR__ . "/access_log.json";

// 初始化访问记录
if (!file_exists($log_file)) file_put_contents($log_file, '{}');
$log_data = json_decode(file_get_contents($log_file), true);

// 清理过期记录
foreach ($log_data as $ip_key => &$timestamps) {
    $timestamps = array_filter($timestamps, function ($ts) use ($window) {
        return $ts > time() - $window;
    });
    if (empty($timestamps)) unset($log_data[$ip_key]);
}

// 检查访问次数
$log_data[$ip] = $log_data[$ip] ?? [];
if (count($log_data[$ip]) >= $limit) {
    http_response_code(429); // Too Many Requests
    die("访问频率过高，请稍后再试！");
}

// 记录此次访问
$log_data[$ip][] = time();
file_put_contents($log_file, json_encode($log_data));

// 检查文件并输出
if (file_exists($filepath)) {
    header("Content-Type: application/pdf");
    header("Content-Disposition: inline; filename=\"$file\"");
    readfile($filepath);
} else {
    http_response_code(404);
    echo "文件不存在";
}
