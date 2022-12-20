var xhttp = new XMLHttpRequest();

function signupSubmit(e){
    var data = $("#signupForm").serialize();
    var url = "../src/php/signup_action.php";
    var urlData = url + "?" + data;
    xhttp.open("POST", urlData, true);
    xhttp.send();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var res = JSON.parse(this.responseText);
            if (res["status"] == 200) {
                window.location.replace("../public/index.php");
            } else {
                alert(res["There was an error in signing up!"]);
            }
        }
    };
    e.preventDefault();
}

function signinSubmit(e){
    var data = $("#signinForm").serialize();
    var url = "../src/php/signin_action.php";
    var urlData = url + "?" + data;
    xhttp.open("POST", urlData, true);
    xhttp.send();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var res = JSON.parse(this.responseText);
            if (res["status"] == 200) {
                window.location.replace("../public/home.php");
            } else {
                alert(res["There was an error in signing up!"]);
            }
        }
    };
    e.preventDefault();
}

function signoutClick(e){
    var url = "../src/php/signout_action.php";
	xhttp.open("POST",url, true);
	xhttp.send();
	xhttp.onreadystatechange = function(){
		var res = JSON.parse(this.responseText);
		if(res["status"] == 200){
		    window.location.replace("../public/index.php");
		} else {
			alert(res["There was an error in signing out!"]);
		}	      
	}
    e.preventDefault();
}