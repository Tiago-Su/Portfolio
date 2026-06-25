PRAGMA foreign_keys = ON;

CREATE TABLE Image (
	id INTEGER NOT NULL,
	imagePath TEXT NOT NULL,

	CONSTRAINT pk_image PRIMARY KEY(id)
);

CREATE TABLE Project (
	id INTEGER NOT NULL,
	projectName TEXT NOT NULL,
	description TEXT,
	github TEXT NOT NULL,

	imageId INTEGER NOT NULL,
	favorite INTEGER DEFAULT 0,

	CONSTRAINT pk_project PRIMARY KEY(id),
	CONSTRAINT fk_project_image FOREIGN KEY(imageId) REFERENCES Image(id) ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT ck_favorite_value CHECK (favorite in (0, 1))
);
