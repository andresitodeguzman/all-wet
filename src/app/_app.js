$(document).ready(()=>{
	$(".sidenav").sidenav();

	clear();
	loginCheck();
	init();
	setMyOrders();

	$("#myorder").fadeIn();

});

var clear = ()=>{
	$(".activity").hide();
}

var init = ()=>{
	var customer_number = 0 + localStorage.getItem('all-wet-customer-number');

	$('#sidenav_customer_number').html(customer_number);
};


var checkLoginStatus = ()=>{
	return localStorage.getItem('all-wet-login');
};

var loginCheck = ()=>{
	let status = checkLoginStatus();
	if(status != "true"){
		window.location.replace("/authenticate");
	}
};

var getCustomerId = ()=>{
	return localStorage.getItem('all-wet-customer-id');
}

var setMyOrders = ()=>{
	var empty = `
	<div class='card'>
		<div class='card-content'>
			<center>No Transactions Yet</center>
		</div>
	</div>
	`;
	var cid = getCustomerId();
	$.ajax({
		type:'GET',
		url:'/api/transaction/get.php',
		cache: 'false',
		data: {
			customer_id: cid
		},
		success: result=>{
			try{
				var res = JSON.parse(result);
				$.each(res, (index,order)=>{
					alert(order);
				});
			}
			catch(e) {
				$("#orderList").html(empty);
			}
		}
	}).fail(()=>{

	});
};