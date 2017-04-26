<?php

require(__DIR__ . '/vendor/autoload.php');

use Interact\Client;

$client = new Client("F1OSc0H1EV6gF071u57WL27h8sh8Y3PUB", "");
?> 

<html>
  <head>
    <title>example - artemis</title>
    <?php
        if ( $client->getFeature("RegistrationForm")->isB() ) {
    ?>
    <link rel="stylesheet" href="style-bad.css">
    <?php
        }
        else {
    ?>
    <link rel="stylesheet" href="style.css">
    <?php
        }
    ?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  </head>
  <body>
    <div class="container">
        <div class="nav">
            <div class="nav-logo">
                <i class="fa fa-twitter" aria-hidden="true"></i>
            </div>
        </div>
        <?php
            if ( $client->getFeature("RegistrationForm")->isA() ) {
                include('./src/good-template.php');
            }
            elseif ( $client->getFeature("RegistrationForm")->isB() ) {
                include('./src/bad-template.php');
            }
            else {
        ?>
        <div class="content">
            <div class="content-body">
                Feature is Closed
            </div>
        </div>
        <?php
            }
        ?>
    </div>
    <script>
        <?php echo $client->getInitCode() ?>
    </script>
  </body>
</html>
