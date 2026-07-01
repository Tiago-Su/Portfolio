# Portfolio
This is a simple website developed with HTML, CSS, Javascript (with AJAX) and PHP in order to store a collection of all my projects developed so far.
The website is divided in two main parts:
1. Projects marked as favorites 
2. List of all projects

For each project, you have a access to a description and a link to the public repository.
For better usability, I implemented a small module to help search and nagivate the site.

## Favorite projects section
In this section, you can see all projects marked as favorite.
![./misc/1.png]

## All projects section
Here, you can access all my projects
![./misc/2.png]

## Search Menu
Pressing the 'Search button' under the favorite projects section or pressing <Space><Space> will display the search menu. Upon entering the menu, you can search for specific projects with the search bar and navigate with the arrow keys through the projects. <Enter> allows to locate the project in 'All project' section and pressing <g> will open in a separate window, the GitHub page.

This section has some support for VIM keys. You initially are in INSERT mode and you can write anything in the search bar; in order to exit INSERT MODE, you can press <Escape> to enter NORMAL mode in which you can use <j> and <k> to move through the projects list. Pressing <d><w> and <d><d> in NORMAL mode will delete the entire search value in the search bar and x will pop the last character of the search bar. Pressing <Escape> in NORMAL mode will close the search menu.
![./misc/3.png]

## Database
I used sqlite3 as database because of the simplicity and the schema has 2 classes, one for the project and the other for the images.
![./misc/4.png]

## API
You can use the API to fetch data with the get method. There is the API/project.php and API/image.php.
1. API/project.php: it returns JSON
    - Without any get value, it will return all projects
    - With id value, it will fetch the correspondent project
    - With search value, it will search with a start like operation for projects

2. API/image.php: it return png
    - Without any valid input, it will return the error 404
    - With id value, it will return the original image
    - There is integer type to specify which size to request (provisory)
