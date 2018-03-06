<?php
/**
 * All Wet
 * 2018
 * 
 * App
 * Index
 */

require_once("../_system/config.php");

?>
<!DOCTYPE html>
<html>
<head>
	<title>All Wet</title>
	<?php require_once("../_system/head.php"); ?>
	<script type="text/javascript" src="/app/_app.js"></script>
	<style>
        .nav-wrapper{
            padding-left:1%;
            padding-right: 3%;
        }
        .title {
            padding-left: 1%;
            font-size: 18pt;
        }
    </style>
</head>
<body class="grey lighten-4">
	<div class="navbar-fixed">
        <nav class="blue darken-3">
            <div class="nav-wrapper">
            <a href="#" data-target="snav" class="show-on-large sidenav-trigger"><i class="material-icons">menu</i></a>
                <a class="title" href="#"><b>All Wet</b></a>
            </div>
        </nav>
    </div>

	<ul class="sidenav" id="snav">
        <li>
            <div class="user-view">
                <div class="background blue darken-2">
                    <!--img src="/assets/imgs/sidenavbg.jpg"-->
                </div>
                <a href="app/profile.php">
                    <span class="white-text name">
                        <b>All Wet Customer</b>
                    </span>
                </a>
                <a href="/app">
                    <span class="white-text email">
                        <?=$subscriber_number?>
                    </span>
                </a>
            </div>
        </li>
		<div id="app">

		<sidebar-entry
			loc="/"
			icon="add"
			title="Hello World!"></sidebar-entry>

		</div>
	    <li><a href="/app/order.php"><i class="material-icons">add</i> Order</a></li>
        <li><a href="/app"><i class="material-icons">list</i> My Order</a></li>
        <li><a href="/authentication/logout.php"><i class="material-icons">person</i> Log-out</a></li>
    </ul>

</div>
</body>
</html>
<script>
new Vue({
    el:"#app"
});

Vue.component('sidebar-entry',{
    props:['loc','icon','title'],
    template:`
        <li>
            <a href='{{loc}}'><i class='material-icons'>{{icon}}</i> {{title}}</a>
        </li>
    `
});	
</script>