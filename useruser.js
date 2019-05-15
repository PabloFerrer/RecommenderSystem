$(document).ready(function () {
	    $("#recommenduser").click(function () {
			recommenduseruser();
    });
	
	document.getElementById("resultuser").style.display="none";
});

function recommenduseruser() {
	var result = document.getElementById("resultuser");
	var selecteduser = document.getElementById("selectuser").value;
	var number = document.getElementById("number").value;
	var threshold = document.getElementById("threshold").value;
	console.log("Calculating...");
	$.post(
		'ranking.php',
		{ 'userid': selecteduser, 'umbral': threshold, 'limite': number},
		function(data, status){
			if (status === "success") {
				
				result.innerHTML = data;
				result.style.display ="block";
            } else {
                console.log("Error");
            }
		});

}
