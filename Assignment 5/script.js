function ajax(endpoint, returnFunction) {
	let xhr = new XMLHttpRequest();
	xhr.open("GET", endpoint);
	xhr.send();

	xhr.onreadystatechange = function() {
		
		if(xhr.readyState == this.DONE) {
			if(xhr.status == 200) {
				returnFunction(xhr.responseText);
			}
			else {
				alert("AJAX error!");
				console.log(xhr.status);
			}
		}
	}
}

//display movie results from server
function displayResults(resultObject) {
	// Convert JSON into JS objects
	resultObject = JSON.parse(resultObject);
	console.log(resultObject);
	// Create a bunch of HTML elements so we can show the results on the browser in a nicely formatted way
	let movieElement = document.querySelector("#movies");

	// Clear previous results
	while( movieElement.hasChildNodes() ) {
		movieElement.removeChild(movieElement.lastChild);
	}

	document.querySelector("#num-results").innerHTML = resultObject.total_results;
	
	//0 results
	if(resultObject.total_results == 0){
		movieElement.innerHTML = "No matching movies."
		movieElement.appendChild(movieElement.innerHTML);
	}

	document.querySelector("#num-matches").innerHTML = resultObject.total_results;
	if( resultObject.total_results > 20 ) {
		document.querySelector("#num-matches").innerHTML = 20;
	}

	// Run through the results and create a <tr> element for each result
	for( let i = 0; i < resultObject.results.length; i++ ) {
		let container = document.createElement("div");
		let cellCover = document.createElement("div");
		cellCover.classList.add("imgs");
		let movieCover = document.createElement("img");

		let overlay = document.createElement("div");
		overlay.classList.add("overlay");

		
		console.log(cellCover);

		if (resultObject.results[i].poster_path != null) {
			movieCover.src = "https://image.tmdb.org/t/p/w500/" + resultObject.results[i].poster_path;
		}
		else {
			movieCover.src = "not_found.jpg";				
		}
		cellCover.appendChild(movieCover);
		
		let rating = resultObject.results[i].vote_average;
		let num_vote = resultObject.results[i].vote_count;
		let synopsis = resultObject.results[i].overview;

		if (synopsis.length > 200) {
			synopsis = synopsis.substring(0, 200) + "...";
		}
		
		overlay.innerHTML = "Rating:" + " " + rating + "<br>" + "Number of voters:" + " " + num_vote + "<br>" + synopsis;

		cellCover.appendChild(overlay);
		container.appendChild(cellCover);


		let movieTitle = document.createElement("div");
		movieTitle.classList.add("title");
		let release = document.createElement("div");
		release.classList.add("release");
		movieTitle.innerHTML = resultObject.results[i].title;
		
		release.innerHTML = resultObject.results[i].release_date;

		container.classList.add("col-sm-6");
		container.classList.add("col-md-4");
		container.classList.add("col-lg-3");

		container.appendChild(movieTitle);
		container.appendChild(release);
		movieElement.appendChild(container);
	}	
}	


document.querySelector("#search-form").onsubmit = function(event) {
	event.preventDefault();
	let searchInput = document.querySelector("#search-id").value.trim();
	console.log(searchInput);
	// Call the AJAX function
	let endpoint = "https://api.themoviedb.org/3/search/movie?api_key=c39a46bfbfdf3c8b32f06ffe2daa5c66&query=" + searchInput;
	ajax(endpoint, displayResults);
	console.log("at the end of onsubmit");
}


//default
let endpoint = "https://api.themoviedb.org/3/movie/now_playing?api_key=c39a46bfbfdf3c8b32f06ffe2daa5c66&language=en-US&page=1"
//call the AJAX function
ajax(endpoint, displayResults);




