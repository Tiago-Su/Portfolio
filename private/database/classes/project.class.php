<?php
declare(strict_types=1);


class Project {
	private int $id;
	private string $projectName;
	private ?string $description;
	private string $github;

	private int $imageId;
	private bool $favorite;

	public function __construct(int $id, string $projectName, ?string $description, string $github, int $imageId, bool $favorite) {
		$this->id = $id;
		$this->projectName = $projectName;
		$this->description = $description;
		$this->github = $github;
		$this->imageId = $imageId;
		$this->favorite = $favorite;
	}

	public static function getAllProjects(PDO $db) : array {
		$stmt = $db->prepare("SELECT * FROM Project");
		$stmt->execute();
		$data = $stmt->fetchAll();

		$projects = array();
		for ($i = 0; $i < count($data); $i++) {
			$p = $data[$i];

			$id = $p["id"];
			$projectName = $p["projectName"];
			$description = $p["description"];
			$github = $p["github"];
			$imageId = $p["imageId"];
			$favorite = $p["favorite"];

			$projects[] = new Project($id, $projectName, $description, $github, $imageId, $favorite);
		}

		return $projects;
	}

	public static function getFavoriteProjects(PDO $db) : array {
		$stmt = $db->prepare("SELECT * FROM Project WHERE favorite = 1");
		$stmt->execute();
		$data = $stmt->fetchAll();

		$projects = array();
		for ($i = 0; $i < count($data); $i++) {
			$p = $data[$i];

			$id = $p["id"];
			$projectName = $p["projectName"];
			$description = $p["description"];
			$github = $p["github"];
			$imageId = $p["imageId"];
			$favorite = (bool) $p["favorite"];

			$projects[] = new Project($id, $projectName, $description, $github, $imageId, $favorite);
		}

		return $projects;
	
	}

	// Getters
	public function getId() : int {
		return $this->id;
	}

	public function getProjectName() : string {
		return $this->projectName;
	}

	public function getDescription() : string {
		return $this->description;
	}

	public function getGithub() : string {
		return $this->github;
	}

	public function getImageId() : int {
		return $this->imageId;
	}

	public function isFavorite() : bool {
		return $this->favorite;
	}

	// Setters
	public function setId(int $id) : void {
		$this->id = $id;
	}

	public function setProjectName(string $projectName) : void {
		$this->projectName = $projectName;
	}

	public function setDescription(?string $description) : void {
		$this->description = $description;
	}

	public function setGithub(string $github) : void {
		$this->github = $github;
	}

	public function setImageId(int $imageId) : void {
		$this->imageId = $imageId;
	}

	public function setFavorite(bool $favorite) : void {
		$this->favorite = $favorite;
	}
};


?>
