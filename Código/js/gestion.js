$(document).ready(function () {
	
	    $("#ratemovie").click(function () {
			rate();
		});
	
	    $("#recommenduser").click(function () {
			recommenduseruser();
		});
		$("#predict").click(function () {
			predictscore();
		});
	document.getElementById("rated").style.display="none";
	document.getElementById("resultuser").style.display="none";
	document.getElementById("prediction").style.display="none";
});

function rate(){
	var rated = document.getElementById("rated");
	var selectedmovie = document.getElementById("selectmovie").value;
	var score = document.getElementById("score").value;
	
	$.post(
		'rate.php',
		{ 'movieid': selectedmovie, 'rating': score},
		function(data, status){
			if(status === "success"){
				rated.innerHTML = data;
				rated.style.display = "block";
			}else{
				console.log("Error");
			}
		});
	
}

function recommenduseruser() {
	var result = document.getElementById("resultuser");
	var number = document.getElementById("number").value;
	var threshold = document.getElementById("threshold").value;
	console.log("Calculating...");
	result.innerHTML = "Calculando ranking";
	result.style.display = "block";
	$.post(
		'ranking.php',
		{ 'userid': "0", 'umbral': threshold, 'limite': number},
		function(data, status){
			if (status === "success") {
				console.log("Calculated");
				result.innerHTML = data;
				result.style.display ="block";
            } else {
                console.log("Error");
            }
		});

}


function predictscore() {
	var result = document.getElementById("prediction");
	var selectedmovie = document.getElementById("selectmovie2").value;
	var threshold = document.getElementById("threshold2").value;
	console.log("Predicting...");
	result.innerHTML = ("Prediciendo");
	result.style.display = "block";
	$.post(
		'prediction.php',
		{ 'userid': "0", 'movieid': selectedmovie, 'umbral': threshold},
		function(data,status){
			if(status === "success"){
				console.log("Predicted");
				result.innerHTML = data;
				result.style.display ="block";
			}else{
				console.log("Error");
			}
		});
	
}