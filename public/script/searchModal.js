const searchModal = document.querySelector("#search-modal");
const searchProjectButton = document.querySelector("#see-projects");
const searchBar = searchModal.querySelector("#search-bar > input");
const overlay = document.querySelector("#overlay");

const projectUl = searchModal.querySelector("div > ul");
const article = searchModal.querySelector("div > article");

const Mode = {
	NORMAL: 0,
	INSERT: 1,
	CLOSED: 2,
};

let lastKey = null;
let selectedProject = 0;
let currentMode = Mode.CLOSED;

async function drawProjectPreview(id) {
	try {
		const project = await getData("/api/project.php?id=" + id);
		const imageURL = await fetchImageURL("/api/image.php?id=" + project["imageId"]);

		const h3 = article.querySelector("header > h3");
		const p = article.querySelector("p");
		const img = article.querySelector("img");

		h3.textContent = project["projectName"];
		p.textContent = project["description"];
		img.src = imageURL;

	} catch {
		h3.innerHTML = "";
		p.textContent = "";
		img.src = "";
	}
}

function createProjectLi(projectId, projectName) {
	const li = document.createElement("li");
	li.textContent = projectName;
	li.id = "project-id:" + projectId;

	return li;
}

async function drawProjectList() {
	try {
		const projects = await getData("/api/project.php?search=" + searchBar.value);
		const max = projects.length > 19 ? 19 : projects.length;
		projectUl.innerHTML = "";

		for (let i = 0; i < max; i++) {
			projectUl.appendChild(createProjectLi(projects[i]["id"], projects[i]["projectName"]));
		}

		projectUl.querySelector("li:first-child").classList.toggle("selected");

	} catch {
		projectUl.innerHTML = "";
	}

	selectedProject = 0;
}

function moveUp() {
	if (selectedProject - 1 < 0) return;
	const projectList = projectUl.children;

	projectList[selectedProject].classList.toggle("selected");
	projectList[--selectedProject].classList.toggle("selected");
	drawProjectPreview(projectList[selectedProject].id.split(":")[1]);
}

function moveDown() {
	if (selectedProject + 1 >= projectUl.childElementCount) return;
	const projectList = projectUl.children;

	projectList[selectedProject].classList.toggle("selected");
	projectList[++selectedProject].classList.toggle("selected");
	drawProjectPreview(projectList[selectedProject].id.split(":")[1]);
}

function goToProject() {
	const projectList = projectUl.children;
	window.location.hash = "#"
	window.location.hash = "project" + projectList[selectedProject].id.split(":")[1];
	closeSearchModal();
}

function normalModeCmd(e) {
	if (e.key === "Escape") {
		closeSearchModal();
	}

	if (e.key === "i") {
		searchBar.focus();
		currentMode = Mode.INSERT;
		e.preventDefault();
	}

	if (e.key === "k" || e.key === "ArrowUp") {
		e.preventDefault();
		moveUp();
	}

	if (e.key === "j" || e.key === "ArrowDown") {
		e.preventDefault();
		moveDown();
	}

	if (e.key === "Enter") {
		e.preventDefault();
		goToProject();
	}

	if (e.key === "x") {
		searchBar.value = searchBar.value.slice(0, -1);
		reloadSearchModal();
	}

	if ((e.key === "d" || e.key === "w") && lastKey === "d") {
		searchBar.value = "";
		reloadSearchModal();
	}
}

function insertModeCmd(e) {
	if (e.key === "Escape") {
		e.preventDefault();
		searchBar.blur();
		currentMode = Mode.NORMAL;
		reloadSearchModal();
	}

	if (e.key === "Enter") {
		e.preventDefault();
		goToProject();
	}
}

function openSearchModal() {
	searchModal.showModal();
	searchBar.focus();
	currentMode = Mode.INSERT;
	overlay.classList.remove("invisible");

	selectedProject = 0;
	reloadSearchModal();
}

function closeSearchModal() {
	searchModal.close();
	currentMode = Mode.CLOSED;
	searchBar.value = "";
	overlay.classList.add("invisible");

	projectUl.children[selectedProject].classList.remove("selected");
	selectedProject = 0;
}

function closeModeCmd(e) {
	if (e.key === " ") {
		e.preventDefault();
		if (lastKey === " ") openSearchModal();
	}
}


function handleKeyMaps(e) {
	switch (currentMode) {
		case Mode.NORMAL:
			normalModeCmd(e);
			break;
		case Mode.INSERT:
			insertModeCmd(e);
			break;
		case Mode.CLOSED:
			closeModeCmd(e);
			break;
	}
}

searchProjectButton.addEventListener("click", (e) => {
	openSearchModal();
	e.stopPropagation();
});

document.addEventListener("click", (e) => {
	const rect = searchModal.getBoundingClientRect();
	const inside = e.clientX >= rect.left && e.clientX <= rect.right && e.clientY >= rect.top && e.clientY <= rect.bottom;

	if (searchModal.open && !inside) {
		closeSearchModal();
	}
});

document.addEventListener("keydown", (e) => {
	handleKeyMaps(e);
	lastKey = e.key;
});

function debounce(fn, delay = 300) {
	let timeout;

	return (...args) => {
		clearTimeout(timeout);
		timeout = setTimeout(() => fn(...args), delay);
	};
}

function reloadSearchModal() {
	drawProjectList();
	if (projectUl.childElementCount < selectedProject) drawProjectPreview(projectUl.children[selectedProject].id.split(":")[1]);
}

searchBar.addEventListener("keydown", debounce((e) => {
	if (e.key === "Escape") return;

	selectedProject = 0;
	reloadSearchModal();
}));

async function start() {
	await drawProjectPreview(1);
	await drawProjectList();
}

start();
