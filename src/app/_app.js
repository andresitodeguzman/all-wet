$(document).ready(()=>{
	//loginCheck();

	$(".sidenav").sidenav();
});

var checkLoginStatus = ()=>{
	if(localStorage.getItem("all-wet-login")){
		var login = localStorage.getItem("all-wet-login");
		if(login == true){
			return true;
		} else {
			return false;
		}
	} else {
		localStorage.setItem("all-wet-login",false);
		return false;
	}
};

var loginCheck = ()=>{
	let status = checkLoginStatus();
	if(status != true){
		window.location.replace("/authenticate");
	}
};

