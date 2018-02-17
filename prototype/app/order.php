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
        nav{
            padding-top: 10px;
            padding-right: 5%;
        }
        .materialize-textarea{
            color:white;
            font-size: 22pt !important;
        }
    </style>
</head>
<body class="blue darken-2">

    <nav class="transparent z-depth-0">
        <a href="/app" class="right">
            <i class="material-icons">close</i>
        </a>
    </nav>

    <div class="activity col s12" id="locationLoader">
        <div class="container">
            <h3 class="white-text">
                <i class="material-icons large">location_on</i><br><br>
                <b>Please Wait</b><br>
                We're Still<br>
                Getting Your Location
            </h3>
        </div>
    </div>

    <div class="activity col s12" id="location">
        <div class="container">
            <div id="locResult"></div>
            <br><br>
            <a id="acceptLocation" href="#" class="btn btn-large waves-effect waves-light blue darken-4 btn-block">Yes! Deliver my Order Here</a><br>
            <br>
            <a id="wrongLocation" href="#" class="btn btn-large waves-effect waves-light blue darken-3  btn-block">Nope, Not there I'll type it instead</a><br><br><br><br>
        </div>
    </div>

    <div class="activity col s12" id="askLocation">
        <div class="container">
            <h3 class="white-text">Where do you want your water to be delivered?</h3>
            <br>
            <div class="input-field">
                <textarea id="manualAddress" class="materialize-textarea"></textarea>
            </div><br>
            <br>
            <button id="submitManualLocation" class="btn btn-large btn-block blue darken-4 waves-effect waves-light">Ok, Done!</button>
        </div>
    </div>

    <div class="activity col s12" id="itemList">
        <div class="container">
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

$("#wrongLocation").click(()=>{
    $("#location").hide();
    $("#askLocation").fadeIn();
});

function setInitialLocation(){
    var lat = sessionStorage.getItem("latitude");
    var lon = sessionStorage.getItem("longitude");
    var adr = sessionStorage.getItem("formatted_address");
    var exactloc = sessionStorage.getItem("exact_location");
    var cty = sessionStorage.getItem("city");
    var eAdr = encodeURI(adr);
    var showThis = `
        <h3 id="loc" class="white-text">
            Are you at <b>${exactloc}</b> in ${cty}?
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
                    var exactLoc = result['results'][0]['address_components'][0]['long_name'];
                    var city = result['results'][0]['address_components'][1]['long_name'];
                    sessionStorage.setItem("latitude",coo.latitude);
                    sessionStorage.setItem("longitude",coo.longitude);
                    sessionStorage.setItem("formatted_address",ad);
                    sessionStorage.setItem("exact_location",exactLoc);
                    sessionStorage.setItem("city",city);

                    console.log(result['results']);

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