const favoriteSection = document.querySelector("#best-projects");

if (favoriteSection) {
	favoriteSection.querySelector(".project").classList.toggle("invisible");
}

async function fetchImageURL(resource) {
	const response = await fetch(resource);
	const blob = await response.blob();
	const url = URL.createObjectURL(blob);

	return url;
}


async function fetchData(resource, data, method) {
	const options = {
		method,
		headers: {
			"Content-Type": "application/json"
		}
	}

	if (data && method !== "GET") options.body = JSON.stringify(data);
	const response = await fetch(resource, options);


	if (!response.ok) throw new Error('HTTP error: ' + response.status);
	return await response.json();
}

function getData(resource) {
	return fetchData(resource, null, "GET");
}

function postData(resource, data) {
	return fetchData(resource, data, "POST");
}
