const favoriteSection = document.querySelector("#best-projects");
if (favoriteSection) {
	favoriteSection.querySelector(".project").classList.toggle("invisible");
}

const searchModal = document.querySelector("#search-modal");
const searchProjectButton = document.querySelector("#see-projects");
const searchBar = searchModal.querySelector("#search-bar > input");

let lastKey = null;

function openSearchModal() {
	searchModal.show();
	searchBar.focus();
}


if (searchModal && searchProjectButton) {
	searchProjectButton.addEventListener("click", (e) => {
		openSearchModal();
		e.stopPropagation();
	});

	document.addEventListener("click", (e) => {
		const rect = searchModal.getBoundingClientRect();
		const inside = e.clientX >= rect.left && e.clientX <= rect.right && e.clientY >= rect.top && e.clientY <= rect.bottom;

		if (!inside) {
			searchModal.close();
		}
	});


	document.addEventListener("keydown", (e) => {
		if (e.key === "Escape") {
			searchModal.close();
		}

		if (lastKey === " " && e.key === " ") {
			openSearchModal();
		}
	})
}

document.addEventListener("keydown", (e) => {
	if (e.key == " " && (e.target.tagName !== "INPUT" || e.target.tagName !== "TEXTAREA")) e.preventDefault();

	lastKey = e.key;
	setTimeout(() => {
		lastKey = null;

	}, 500);
});

