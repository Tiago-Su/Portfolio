<?php
require_once __DIR__ . "/../../private/database/connection.php";
require_once __DIR__ . "/../../private/database/classes/image.class.php";

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405); 
    exit;
}

$db = getDatabaseConnection();

$id = $_GET['id'] ?? -1;
$image = Image::getImageById($db, (int)$id);
$file = $image ? $image->getImageName() : "";

$type = $_GET['type'] ?? 0;
$path = __DIR__ . '/../../private/images/'; 

if ((int)$type === 1) {
	$path = $path . "150x150/";
} else if ((int)$type === 2) {
	$path = $path . "300x300/";
} else {
	$path = $path . "original/";
}

$path = $path . $file;

if (!file_exists($path)) {
	http_response_code(404);
    exit;
}

header('Content-Type: image/png');
readfile($path);
exit;

?>
