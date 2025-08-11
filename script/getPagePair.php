<?php
header('Content-Type: application/json');
require_once '../includes/function.php';

$rows = sql_arr("SELECT page_no FROM book_pages WHERE active = 1 ORDER BY page_no ASC");

$pageNos = array_column($rows, 'page_no');
$pairs = [];

for ($i = 0; $i < count($pageNos); $i += 2) {
    $pair = [$pageNos[$i]];
    if (isset($pageNos[$i + 1])) {
        $pair[] = $pageNos[$i + 1];
    }
    $pairs[] = $pair;
}

echo json_encode([
    'status' => 'success',
    'pairs' => $pairs
]);
