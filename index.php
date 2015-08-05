<?php

$api_key      = "bff39f27613538aeff88aea2c42dbf2d";
$api_secret   = "60c80664ac8703f6";

require_once("phpFlickr.php");

$f = new phpFlickr($api_key, $api_secret);
$now = new DateTime('now', new DateTimeZone('Europe/London'));


if(isset($_GET['search'])){

  $searchterms = $_GET['search'];

} else {

  $searchterms = $now->format('H:i');

}

//photo search
$photos = $f->photos_search(array("tags"=> $searchterms, "tag_mode"=>"any", "content_type"=>1, "safe_search"=>1, "media"=>"photos", "extras"=>"url_l"));

// pull an image at random
$rand = rand(1,count($photos['photo']));
$i=1;

foreach ($photos['photo'] as $photo) {

  if($i == $rand){

    $displayphoto = $photo;

  }
  $i++;

}


// grab the refresh if set
if(isset($_GET['refresh'])){

  $refresh = $_GET['refresh'];

} else {

  $refresh = 60;

}
?>

<!DOCTYPE html>
<html>

  <head>

    <meta charset="UTF-8">

    <title>Rethink.Gallery</title>
    <meta http-equiv="refresh" content="<?php print $refresh ?>" />

    <style>

      html, body {
          margin: 0;
          padding: 0;
          border: 0;
          font: inherit;
          font-size: 100%;
          vertical-align: baseline;
      }

      img {
        /* Set rules to fill background */
        min-height: 100%;
        min-width: 1024px;

        /* Set up proportionate scaling */
        width: 100%;
        height: auto;

        /* Set up positioning */
        position: fixed;
        top: 0;
        left: 0;
      }

      @media screen and (max-width: 1024px) { /* Specific to this particular image */
        img {
          left: 50%;
          margin-left: -512px;   /* 50% */
        }
      }

    </style>

  </head>

  <body>

    <img src='<?php print $displayphoto['url_l']?>' />

  </body>

</html>
