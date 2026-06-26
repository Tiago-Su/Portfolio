-- Enable FK enforcement
PRAGMA foreign_keys = ON;

-- Insert the single image
INSERT INTO Image (id, imageName)
VALUES (1, '1.png');

-- Insert 4 projects using the same imageId = 1
INSERT INTO Project (id, projectName, description, github, imageId, favorite)
VALUES
(1, 'Portfolio Website', 'Personal portfolio built with HTML, CSS and JS', 'https://github.com/Tiago-Su', 1, 1),

(2, 'Task Manager App', 'Simple task manager with CRUD features', 'https://github.com/Tiago-Su', 1, 0),

(3, 'Weather Dashboard', 'Shows weather using an external API', 'https://github.com/Tiago-Su', 1, 0),

(4, 'Blog Platform', 'Basic blogging platform with authentication', 'https://github.com/Tiago-Su', 1, 1);
