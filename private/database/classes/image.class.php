<?php
declare(strict_types=1);

class Image {
	private int $id;
	private string $imageName;

	public function __construct(int $id, string $imageName) {
		$this->id = $id;
		$this->imageName = $imageName;
	}

	public static function getAllImages(PDO $db) : array {
		$stmt = $db->prepare("SELECT * FROM Image");
		$stmt->execute();

		$imagesData = $stmt->fetchAll();
		$images = array();

		for ($i = 0; $i < count($imagesData); $i++) {
			$image = $imagesData[$i];
			$id = $image["id"];
			$imageName = $image["imageName"];

			$images[] = new Image($id, $imageName);
		}

		return $images;
	}

	public static function getImageById(PDO $db, int $id) : ?Image {
		$stmt = $db->prepare("SELECT * FROM Image WHERE id = ?");
		$stmt->execute(array($id));

		$imageData = $stmt->fetch();
		if (!$imageData) return null;
	
		$id = $imageData["id"];
		$imageName = $imageData["imageName"];
		return new Image($id, $imageName);
	}

	// Getters
	public function getId() : int {
		return $this->id;
	}

	public function getImageName() : string {
		return $this->imageName;
	}

	// Setters
	public function setId(int $id) : void {
		$this->id = $id;
	}

	public function setImageName(string $imageName) : void {
		$this->imageName = $imageName;
	}
};

?>
