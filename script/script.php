<?php
header('Content-Type: application/json');
require_once '../includes/function.php';

$pageNos = isset($_GET['page_nos']) ? $_GET['page_nos'] : [];

if (!is_array($pageNos) || empty($pageNos)) {
    echo json_encode(["status" => "error", "message" => "No pages requested"]);
    exit;
}

$pageList = implode(',', array_map('intval', $pageNos));
$data = sql_arr("SELECT * FROM book_pages WHERE page_no IN ($pageList) AND active = 1 ORDER BY page_no");

echo json_encode(["status" => "success", "data" => $data]);

