<?php

require_once __DIR__ . "./../../private/database/connection.php";
require_once __DIR__ . "./../../private/database/classes/project.class.php";

$db = getDatabaseConnection();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	$id = $_GET['id'] ?? null;
	$search = $_GET['search'] ?? null;

	if ($id !== '' && $id !== null) {
		$data = Project::getProjectById($db, (int)$id);
	} else if ($search !== '' && $search !== null) {
		$data = Project::getProjectsLike($db, $search);
	} else {
		$data = Project::getAllProjects($db);
	}
} else if ($_SERVER['REQUEST_METHOD'] === 'PATCH') {
		
	
} else {
	http_response_code(405);
	exit;
}

header('Content-Type: application/json');
echo json_encode($data);

?>
