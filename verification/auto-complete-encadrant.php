<?php
require('constant.php');
require('databaseEncadrant.php');

if (!isset($_GET['keyword'])) {
	die("");
}

$keyword = $_GET['keyword'];
$data = serachForKeyword($keyword);
echo json_encode($data, JSON_HEX_APOS);