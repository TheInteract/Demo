<?php

require(__DIR__ . '/vendor/autoload.php');

use Interact\Client;

$client = new Client("demo-private-key", "");
?> 

<html>
  <head>
    <title>example - collector</title>
    <?php
        if ( $client->getFeature("DemoFeature2")->isA() ) {
    ?>
    <link rel="stylesheet" href="/styles/style.css">
    <?php
        }
        elseif ( $client->getFeature("DemoFeature2")->isB() ) {
    ?>
    <link rel="stylesheet" href="/styles/style-bad.css">
    <?php
        }
    ?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  </head>
  <body>
    <div class="container">
        <div class="nav">
            <div class="nav-logo" interact-click="logo">
                <i class="fa fa-twitter" aria-hidden="true"></i>
            </div>
        </div>
        <?php
            if ( $client->getFeature("DemoFeature2")->isA() ) {
                include('./src/good-template.php');
            }
            elseif ( $client->getFeature("DemoFeature2")->isB() ) {
                include('./src/bad-template.php');
            }
            else {
        ?>
                Feature is Closed
        <?php
            }
        ?>
    </div>
    <script>
        <?php echo $client->getInitCode() ?>
    </script>
  </body>
</html>
