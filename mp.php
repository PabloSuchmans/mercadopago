<?php
  include_once('utilidades.php');
  $date = new DateTime();
  $a = $date->format('Ymd-His');
  if (isset($_POST)) {
    $p = $a . "-post.json";
    $file = fopen($p, "w");
    if ($file) {
      $f = obtenerDatosPOST('cadena');
      echo $f;
      fwrite($file, $f);
    } else {
      echo 'no se pudo crear '.$p;
    }
  
    fclose($file);
  }
  echo '<br>';

  if (isset($_GET)) {
    $p = $a .  "-get.json";
    $file = fopen($p, "w");
    if ($file) {
      $f = json_encode($_GET);
      echo $f;
      fwrite($file, $f);
    } else {
      echo 'no se pudo crear '.$p;
    }
    fclose($file);
  }
?>