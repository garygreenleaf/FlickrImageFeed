<?php

$api_key      = "bff39f27613538aeff88aea2c42dbf2d";
$api_secret   = "60c80664ac8703f6";

require_once("phpFlickr.php");

$f = new phpFlickr($api_key, $api_secret);
$now = new DateTime('now', new DateTimeZone('Europe/London'));


if(isset($_GET['search'])){

  $searchterms = $_GET['search'];

} else {

  //$searchterms  = $now->format('ga').", ";
  //$searchterms .= $now->format('H:00').", ";
  $searchterms = $now->format('H:i');

}

//photo search
$photos = $f->photos_search(array("tags"=> $searchterms, "tag_mode"=>"any"));
$photo = $photos['photo']['0'];
?>

<!DOCTYPE html>
<html>

  <head>

    <meta charset="UTF-8">

    <title>Rethink.Gallery</title>
    <meta http-equiv="refresh" content="60" />

    <style>

      html, body {
          margin: 0;
          padding: 0;
          border: 0;
          font: inherit;
          font-size: 100%;
          vertical-align: baseline;
      }

      body {
          position: relative;
          width:100%;
          height:100vh;
          overflow: hidden;
          background: black;
      }

      #title {
          background: #000;
          color:#fff;
          text-align: center;
          padding:10px;
          font-size: 1.2em;
          font-weight: bold;
      }

      img {
          display: block;
          margin:0 auto;
      }

    </style>

  </head>

  <body>

    <div id="title">Rethink.Gallery - <?php print $searchterms?></div>
    <img src='https://farm<?php print $photo['farm']?>.staticflickr.com/<?php print $photo['server'] ?>/<?php print $photo['id'] ?>_<?php print $photo['secret']?>_b.jpg' />

  </body>

</html>
