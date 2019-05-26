$(document).ready(function () {
	    $("#recommenduser").click(function () {
			recommenduseruser();
    });
		$("#predict").click(function () {
			predictscore();
		});	    
	
	document.getElementById("resultuser").style.display="none";
	document.getElementById("prediction").style.display="none";
});

function recommenduseruser() {
	var result = document.getElementById("resultuser");
	var selecteduser = document.getElementById("selectuser").value;
	var number = document.getElementById("number").value;
	var threshold = document.getElementById("threshold").value;
	console.log("Calculating...");
	result.innerHTML = "Calculando ranking";
	result.style.display = "block";
	$.post(
		'ranking2.php',
		{ 'userid': selecteduser, 'umbral': threshold, 'limite': number},
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
	var selecteduser = document.getElementById("selectuser2").value;
	var selectedmovie = document.getElementById("selectmovie").value;
	var threshold = document.getElementById("threshold2").value;
	console.log("Predicting...");
	result.innerHTML = ("Prediciendo");
	result.style.display = "block";
	$.post(
		'prediction2.php',
		{ 'userid': selecteduser, 'movieid': selectedmovie, 'umbral': threshold},
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