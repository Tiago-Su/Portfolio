-- Enable FK enforcement
PRAGMA foreign_keys = ON;

-- Insert the single image
INSERT INTO Image (id, imageName)
VALUES 
(1, '1.png'),
(2, '2.png'),
(3, '3.png'),
(4, '4.png'),
(5, '5.png'),
(6, '6.png');

-- Insert 4 projects using the same imageId = 1
INSERT INTO Project (id, projectName, description, github, imageId, favorite)
VALUES
(1, 'Portfolio Website', 'A website to store my collection of projects with some VIM functionalities to quick search through my projects. This project was made with HTML, CSS and Javascript (with AJAX).', 'https://github.com/Tiago-Su/Portfolio', 6, 0),
(2, 'LCOM Project', 'A tower defense game in which the player needs to collect fruits, dropped by enemies or spawned randomly, in order to create towers and upgrade them to protect against incoming waves of enemies. The game has 3 available levels, an easy level as tutorial, a medium level with a boss encounter and an infinite level. This project was developed in C using a variation of the MINIX 3 OS. In this project, we build our own drivers in order to display images and gather inputs from the user.', 'https://github.com/Tiago-Su/LCOM-project/tree/main', 2, 1),
(3, 'LDTS Project', 'A recreation of the game Celeste version Pico 8, a game in which you control Madeline who is trying to climb the mountain Celeste. This game is a precise platformer in which you can move left and right, jump and dash. Besides basic controllers, this recreation has implmented input buffers and coyote time for better user experience. This project was developed in java using the framework Lanterna.', 'https://github.com/Tiago-Su/projectLDTS', 3, 1),
(4, 'DA Project 1', 'This project was made for the subject "Desenho de Algoritmos" and the objective of this program is the following:
Given a set of articles with domains and a set of reviewers with expertise in certain domains, the goal is to find the best or one of the best distributions, knowing that reviewers can only review a maximum amount of articles and an article needs at least a minimum amount of reviewers. If not all articles can be assigned reviewers, the program prints the unassigned articles. Besides the main algorithm, there is a feature to find critical reviewers, that is: the reviewers that, if failing to do their assignment, will cause a failure.', 'https://github.com/Tiago-Su/DA-s-project-1', 4, 0),
(5, 'DA Project 2', 'This project was made for the subject "Desenho de Algoritmos" and the objective of this program is the following:
Given a set of live ranges and a number of registers, the goal is to find the best way to allocate variables to registers.
In addition to the basic algorithm, we can spill and split webs depending on the configuration. We also defined an alternative algorithm to solve some graphs that the basic algorithm cannot solve optimally.', 'https://github.com/Tiago-Su/DA-s-project-2', 5, 0);

