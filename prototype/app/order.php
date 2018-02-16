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
    </style>
</head>
<body class="blue darken-2">

    <div class="activity col s12" id="locationLoader">
        <div class="container">
            <br><br><br>
            <h4 class="white-text">Still Loading Your Location</h4>
        </div>
    </div>

    <div class="activity col s12 blue darken-2" id="location">
        <div class="container">
            <br><br><br>
            <h3 id="loc" class="white-text"></h3>
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

function setInitialLocation(){
    var lat = sessionStorage.getItem("latitude");
    var lon = sessionStorage.getItem("longitude");
    var adr = sessionStorage.getItem("formatted_address");
    var showThis = `
        Are you at ${adr}?
    `;
    $("#loc").html(showThis);
    $("#locationLoader").hide();
    $("#location").show();
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