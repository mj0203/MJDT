<?php
// 数据
$studentsAll = [
    [
        'id' => 1,
        'nickname' => '张三',
        'age' => 10,
        'sex' => 1,
        'description' => '张三是一个好学生，好好学习天天向上...',
        'created_at' => date('Y-m-d H:i:s')
    ],
    [
        'id' => 2,
        'nickname' => '李四',
        'age' => 11,
        'sex' => 2,
        'description' => '李四是一个好学生，好好学习天天向上...',
        'created_at' => date('Y-m-d H:i:s')
    ],
    [
        'id' => 3,
        'nickname' => '王五',
        'age' => 12,
        'sex' => 0,
        'description' => '王五是一个好学生，好好学习天天向上...',
        'created_at' => date('Y-m-d H:i:s')
    ]
];
// 分页
$page = isset($_REQUEST['page']) ? intval($_REQUEST['page']) - 1 : 0;
$pageSize = $_REQUEST['page_size'] ?? 20;
$totalPage = ceil(count($studentsAll) / $pageSize);
$pageData = [
    'current_page' => $page + 1,
    'total_page' => $totalPage,
    'page_size' => $pageSize
];
// 排序
$orderColumn = [
    'id' => 'desc'
];
header("Content-type: application/json");
// API结构
$result = [
    'code' => 0,
    'message' => 'success',
    'data' => [
        'data' => array_slice($studentsAll, $page*$pageSize, $pageSize),
        'pageData' => $pageData,
        'orderColumn' => $orderColumn
    ]
];
echo json_encode($result, JSON_UNESCAPED_UNICODE);