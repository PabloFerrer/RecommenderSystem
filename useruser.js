$(document).ready(function () {
	    $("#recommenduser").click(function () {
			recommenduseruser();
    });
	
	document.getElementById("resultuser").style.display="none";
});

function recommenduseruser() {
	var result = document.getElementById("resultuser");
	var selecteduser = document.getElementById("selectuser").value;
	var sim = <?php usersimilitude(selecteduser);?>
	result.innerHTML = sim;
	result.style.display = "block";

}
