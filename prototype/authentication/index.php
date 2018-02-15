<?php
session_start();

require_once("../_class/Account.class.php");
require_once("../_system/config.php");

$account = new Account();

if($account->isLoggedIn()) header("Location: ../");
?>
<!Doctype html>
<html>
  <head>
    <title>Authenticate - <?php echo $site_title ?></title>
    <?php
      require_once("../_system/styles.php");  
    ?>
  </head>
  <body>
    <h1>
      Hello World
    </h1>
  </body>
</html>