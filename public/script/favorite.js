const bestProjectSection = document.querySelector("#best-projects");
const contentSection = bestProjectSection.querySelector("#best-projects-content");
const favoriteProjects = contentSection.querySelectorAll("article");

let currentFavoriteProjet = 0;

const leftArrow = contentSection.querySelector(".left-arrow");
const rightArrow = contentSection.querySelector(".right-arrow");

leftArrow.addEventListener("click", e => {
	favoriteProjects[currentFavoriteProjet].classList.toggle("invisible");

	currentFavoriteProjet--;
	if (currentFavoriteProjet < 0) currentFavoriteProjet = 0;

	favoriteProjects[currentFavoriteProjet].classList.toggle("invisible");
});

rightArrow.addEventListener("click", e => {
	favoriteProjects[currentFavoriteProjet].classList.toggle("invisible");

	currentFavoriteProjet++;
	if (currentFavoriteProjet >= favoriteProjects.length) currentFavoriteProjet = favoriteProjects.length - 1;

	favoriteProjects[currentFavoriteProjet].classList.toggle("invisible");
});

