<?php
require_once '../Model/Foto.php';
require_once '../Model/Like.php';
require_once '../Model/Usuario.php';
$metodo = $_SERVER['REQUEST_METHOD'];
$codEstado=200;
$mensaje='OK';
if ($metodo == 'GET') {
  if (isset($_REQUEST['nombre'])) {
    $usuario=Usuario::getUsuarioByNombre($_REQUEST['nombre']);
    if (!$usuario) {
        $mensaje = "No existe un usuario con el nombre aportado";
        $codEstado=404;  
    } else {
        $fotos=Foto::getFotosByUsu($usuario->getId());
        if (count($fotos) == 0) {
          $mensaje = "No existen fotos del usuario";
          $codEstado = 404;
        } else {
          foreach ($fotos as $foto) {
            $likes=Like::getLikesByFoto($foto->getId());
            $devolver[] = ['nombre' => substr($foto->getImagen(),0,-4), 
            'url' => 'http://localhost//Curso%20Actual/Examenes/Examen3/View/imagen/'.$foto->getImagen(), 
            'likes' => $likes];
          }
        }
    }
  }else{
    $mensaje = "Falta nombre del usuario en la petición";
    $codEstado= 400;
  }
}else if ($metodo == 'PUT') {
  //Para los métodos GET y POST existe $_REQUEST, pero para PUT y DELETE no, así que tenemos que parsear el php://input
    parse_str(file_get_contents("php://input"),$parametros);
    if (isset($parametros['id_foto']) && isset($parametros['id_usuario'])) {
      $foto = Foto::getFotoById($parametros['id_foto']);
      $usuario = Usuario::getUsuarioById($parametros['id_usuario']);
      if (!$foto) {
          $mensaje = "No existe una foto con el codigo aportado";
          $codEstado=404;  
      } else if (!$usuario){
          $mensaje = "No existe un usuario con el codigo aportado";
          $codEstado=404;  
      }else {
        $foto->setId_usuario($parametros['id_usuario']);
        $foto->update();
      }
    } else {
      $mensaje = "Falta id de usuario o id de la foto";
      $codEstado= 400;
    }    
  }
  setCabecera($codEstado,$mensaje); 
  if ($codEstado==200 && $metodo == 'GET') {
    echo json_encode($devolver);
  }
  
function setCabecera($codEstado, $mensaje) {  
  //Si usamos la funcion setCabecera y establecemos en header un codigo distinto de 200 (status OK) provocará un error en el cliente, 
  //por eso es mejor tratar el error en la respuesta devuelta en el array $devolver y el cliente pueda analizar el mensaje
  header("HTTP/1.1 $codEstado $mensaje");  
  header("Content-Type: application/json;charset=utf-8");  
}  