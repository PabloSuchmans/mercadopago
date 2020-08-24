<?php
  if (isset($_SERVER['HTTP_ORIGIN'])) {  
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");  
    header('Access-Control-Allow-Credentials: true');  
    header('Access-Control-Max-Age: 86400');   
  }  

  if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {  
  
      if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))  
          header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");  
  
      if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))  
          header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");  
  } 

  function obtenerDatosPOST($ComoCadena = NULL) {
      if ($ComoCadena != NULL) {
        return file_get_contents('php://input');  //uso esto en vez de $_POST
      } else {
        return json_decode(file_get_contents('php://input'), TRUE);  //uso esto en vez de $_POST
      }
  }

  function _slugify($string, $replace = array(), $delimiter = '-') {
  // https://github.com/phalcon/incubator/blob/master/Library/Phalcon/Utils/Slug.php
  // if (!extension_loaded('iconv')) {
  //     throw new Exception('iconv module not loaded');
  // }
  // Save the old locale and set the new locale to UTF-8
      $oldLocale = setlocale(LC_ALL, '0');
      setlocale(LC_ALL, 'en_US.UTF-8');
      $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $string);
      if (!empty($replace)) {
          $clean = str_replace((array) $replace, ' ', $clean);
      }
      $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
      $clean = strtolower($clean);
      $clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);
      $clean = trim($clean, $delimiter);
      // Revert back to the old locale
      setlocale(LC_ALL, $oldLocale);
      return $clean;
  }

  function funcEjecucionLocal() {
    return strtoupper($_SERVER['HTTP_HOST']) === 'LOCALHOST';
  }

  function funcConexionPermitida() {
    // if (isset($_GET['slug'])) {
    //   $slug = 'V2FybmluZzwvYj46IG15c3FsaV9lcnJvcigpIGV4cGVjdHMgcGFyYW1ldGVyIDEgdG8gYmUgbXlzcWxpLCBib29sZWFuIGdpdmVuIGlu';
    //   //idea, mandar por GET el usuario y algun dato mas para poder constatar si la conexion esta permitida
    //   //tambien aca podria chequearse que el ultimo acceso sea en los ultimos X segundos / minutos / horas
    //   if ($slug === $_GET['slug']) {
        return TRUE;
    //   } else {
    //     return FALSE;
    //   }
    // } else {
    //   return FALSE;
    // }
  }

  function funcEmpaquetarCadena($cadena) {
    // $cadena = 'ewoiZW1haWwiOiAiam9hcXVpbmRhbmVyaUBnbWFpbC5jb20iLAoiY2xhdmUiOiAiMSIsCiJub21icmVfYmQiOiAiY2hhbm5lbF9tYW5hZ2VyXzQyIgp9'; //test
    if ($cadena[0] === 'E') {
      $resultado = '';
      for($i = 1; $i < strlen($cadena); $i++) {
        switch ($cadena[$i]) {
          case '0': $resultado = '1' . $resultado; break;
          case '1': $resultado = '2' . $resultado; break;
          case '2': $resultado = '3' . $resultado; break;
          case '3': $resultado = '4' . $resultado; break;
          case '4': $resultado = '5' . $resultado; break;
          case '5': $resultado = '6' . $resultado; break;
          case '6': $resultado = '7' . $resultado; break;
          case '7': $resultado = '8' . $resultado; break;
          case '8': $resultado = '9' . $resultado; break;
          case '9': $resultado = '0' . $resultado; break;
          default: $resultado = $cadena[$i] . $resultado; 
        }
      }      
    // echo 'antes:   ' . $cadena . '<br>';     //test
    // echo 'despues: ' . $resultado . '<br>';   //test
    }
    if ($cadena[0] === 'D') {
      $resultado = '';
      for($i = 1; $i < strlen($cadena); $i++) {
        switch ($cadena[$i]) {
          case '1': $resultado = '0' . $resultado; break;
          case '2': $resultado = '1' . $resultado; break;
          case '3': $resultado = '2' . $resultado; break;
          case '4': $resultado = '3' . $resultado; break;
          case '5': $resultado = '4' . $resultado; break;
          case '6': $resultado = '5' . $resultado; break;
          case '7': $resultado = '6' . $resultado; break;
          case '8': $resultado = '7' . $resultado; break;
          case '9': $resultado = '8' . $resultado; break;
          case '0': $resultado = '9' . $resultado; break;
          default: $resultado = $cadena[$i] . $resultado; 
        }
      }    
    // echo 'antes:   ' . $cadena . '<br>';    //test
    }      
    return $resultado;
  }

  function funcLeerArchivoTexto($archivo = '') {
    return implode('', file($archivo));
  }

  function funcRespuesta($respuesta) {
    return json_encode($respuesta, JSON_UNESCAPED_UNICODE);
  }

  function funcRestarFechas($fechaDesde, $fechaHasta) {
    $fechaDesde = strtotime($fechaDesde); 
    $fechaHasta = strtotime($fechaHasta); 
    return ($fechaHasta - $fechaDesde)/60/60/24;   
  }

  function funcOrdenarArray(&$array, $key) {
    $orden = array_column($array, $key);
    array_multisort($orden, SORT_ASC, $array);
  }
  
  function funcControlarParametros(&$parametro, $nombresParametros = array()) {
    $resultado = FALSE;
    if (!isset($parametro)) {
      $resultado = 'no hay parametros';
    } else {
      foreach($nombresParametros as $par) {
        if (!isset($parametro[$par])) {
          $resultado = 'el parametro \'' . $par . '\' no existe';
        }
      }
    }
    if ($resultado) {
      throw new Exception($resultado);
    }
  }

  function funcCoalesce(&$variable, $valorDefecto) {
    if (!isset($variable)) {
      return $valorDefecto;
    } else {
      return $variable;
    }
  }
    
?>
