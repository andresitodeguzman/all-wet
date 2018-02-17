<?php
session_start();

require_once("../_class/Account.class.php");
require_once("../_system/config.php");

$account = new Account();

if($account->isLoggedIn() == False) header("Location:../authenticate");

$subscriber_number = $_SESSION['globe_subscriber_number'];
if($subscriber_number[0] == 9) $subscriber_number = "0$subscriber_number";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?=$site_title?></title>
    <?php
    require_once("../_system/styles.php");
    ?>
    <style>
        html{
            height:100%;
        }
        body{
            height:100%;
        }
        .btn-block {
            width:100%;
        }
    </style>
</head>
<body class="blue darken-2">

    <div class="activity col s12" id="locationLoader">
        <div class="container">
            <br><br><br>
            <h3 class="white-text">Wait! We're Still<br>Getting Your Location</h3>
        </div>
    </div>

    <div class="activity col s12 blue darken-2" id="location">
        <div class="container">
            <br><br><br>
            <div id="locResult"></div>
            <br><br>
            <a id="acceptLocation" href="#" class="btn btn-large waves-effect waves-light green darken-2 btn-block">Yes! Certainly</a><br>
            <br>
            <a href="#" class="btn btn-large waves-effect waves-light red  btn-block">No, I'll just enter it instead</a><br><br><br><br>
        </div>
    </div>

    <div class="activity col s12 blue darken-2" id="itemList">
        <div class="container">
            <br><br>
            <h3 class="white-text">What do you want to order?</h3>
        </div>
    </div>

</body>
</html>
<script>
$(document).ready(()=>{
    $(".activity").hide();
    $("#locationLoader").show();
    init();
});

$("#acceptLocation").click(()=>{
    $("#location").hide();
    $("#itemList").fadeIn();
});

function setInitialLocation(){
    var lat = sessionStorage.getItem("latitude");
    var lon = sessionStorage.getItem("longitude");
    var adr = sessionStorage.getItem("formatted_address");
    var eAdr = encodeURI(adr);
    var showThis = `
        <h3 id="loc" class="white-text">
            Are you at ${adr}?
        </h3>
        <img src="https://maps.googleapis.com/maps/api/staticmap?center=${lat},${lon}&zoom=20&size=800x300&markers=color:blue%7C${lat},${lon}&key=AIzaSyCuNfQSkwl85bk38k4de_QR-DwBGL-069o" width="100%"><br><br>

    `;
    $("#locResult").html(showThis);
    $("#locationLoader").hide();
    $("#location").fadeIn();
}

function init(){
    if("geolocation" in navigator){
        navigator.geolocation.getCurrentPosition(pos=>{
            var coo = pos.coords;
            var ltlo = `${coo.latitude},${coo.longitude}`;

            $.ajax({
                type:'GET',
                url: 'https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyBDOL-nNs8SKrlnkr97ByrLwJZ6PHLXeas',
                data: {
                    latlng: ltlo
                },
                success: (result)=>{
                    var ad = result['results'][0]['formatted_address'];
                    sessionStorage.setItem("latitude",coo.latitude);
                    sessionStorage.setItem("longitude",coo.longitude);
                    sessionStorage.setItem("formatted_address",ad);

                    setInitialLocation();
                }        
            }).fail(()=>{
                console.log('err');
            });
            
        }, err=>{
            error = err.code;
            if(error == 1){
                Materialize.toast("Location Access Permission has been denied",3000);
            }
            if(error == 2){
                Materialize.toast("Unable to determine your current location",3000);
            }
            if(error == 3){
                Materialize.toast("Unable to determine your current location", 3000);
            }
        });
    }
}
</script>